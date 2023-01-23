<?php
namespace App\Http\Controllers\Admin;
use App\Models\Plan;
use App\Models\User;
use App\Models\Setting;
use App\Models\Currency;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Brian2694\Toastr\Facades\Toastr;
class TransactionsController extends Controller
{
    public function indexTransactions(Request $request)
    {
        $transactions = Transaction::select('transactions.*','users.name as userName','users.id as userId')
        ->leftJoin('users','users.id','transactions.user_id')
        ->where('transactions.payment_gateway_name', '!=' ,'Offline');
            if($request->date){
                $transactions->whereDate('transactions.created_at','=',date('Y-m-d', strtotime($request->date)));
            }
            $transactions = $transactions->get();
        $settings = Setting::where('status', 1)->first();
        $currencies = Currency::get();


        return view('admin.transactions.index', compact('transactions', 'settings', 'currencies'));
    }

    public function transactionStatus(Request $request, $id, $status)
    {
        Transaction::where('gobiz_transaction_id', $id)->update([
            'payment_status' => $status
        ]);

        Toastr::success(trans('Transaction Status Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.transactions');
    }

    public function viewInvoice($id)
    {
        $transaction = Transaction::where('gobiz_transaction_id', $id)->first();
        $settings = Setting::where('status', 1)->first();
        $config = DB::table('config')->get();
        $currencies = Currency::get();
        $transaction['billing_details'] = json_decode($transaction['invoice_details'], true);
        return view('admin.transactions.view-invoice', compact('transaction', 'settings', 'config', 'currencies'));
    }

    public function offlineTransactions()
    {
        $transactions = Transaction::where('payment_gateway_name', 'Offline')->get();
        $settings = Setting::where('status', 1)->first();
        $currencies = Currency::get();

        for ($i = 0; $i < count($transactions); $i++) {
            $user_details = User::where('id', $transactions[$i]->user_id)->firstOrFail();
                $transactions[$i]['name'] = $user_details->name;
                $transactions[$i]['userId'] = $user_details->user_id;
        }

        return view('admin.transactions.offline', compact('transactions', 'settings', 'currencies'));
    }

    public function offlineTransactionStatus(Request $request, $id, $status)
    {
        if ($status == "SUCCESS") {

            $config = DB::table('config')->get();

            $transaction_details = Transaction::where('gobiz_transaction_id', $id)->where('status', 1)->first();
            $user_details = User::find($transaction_details->user_id);

            $plan_data = Plan::where('plan_id', $transaction_details->plan_id)->first();
            $term_days = $plan_data->validity;

            if ($user_details->plan_validity == "") {
                $plan_validity = Carbon::now();
                $plan_validity->addDays($term_days);

                $invoice_count = Transaction::where("invoice_prefix", $config[15]->config_value)->count();
                $invoice_number = $invoice_count + 1;

                Transaction::where('gobiz_transaction_id', $id)->update([
                    'invoice_prefix' => $config[15]->config_value,
                    'invoice_number' => $invoice_number,
                    'payment_status' => 'SUCCESS',
                ]);

                User::where('id', $user_details->id)->update([
                    'plan_id' => $transaction_details->plan_id,
                    'term' => $term_days,
                    'plan_validity' => $plan_validity,
                    'plan_activation_date' => now(),
                    'plan_details' => $plan_data
                ]);

                $encode = json_decode($transaction_details['invoice_details'], true);
                $details = [
                    'from_billing_name' => $encode['from_billing_name'],
                    'from_billing_email' => $encode['from_billing_email'],
                    'from_billing_address' => $encode['from_billing_address'],
                    'from_billing_city' => $encode['from_billing_city'],
                    'from_billing_state' => $encode['from_billing_state'],
                    'from_billing_country' => $encode['from_billing_country'],
                    'from_billing_zipcode' => $encode['from_billing_zipcode'],
                    'gobiz_transaction_id' => $transaction_details->gobiz_transaction_id,
                    'to_billing_name' => $encode['to_billing_name'],
                    'invoice_currency' => $transaction_details->transaction_currency,
                    'invoice_amount' => $encode['invoice_amount'],
                    'invoice_id' => $config[15]->config_value . $invoice_number,
                    'invoice_date' => $transaction_details->created_at,
                    'description' => $transaction_details->description,
                    'email_heading' => $config[27]->config_value,
                    'email_footer' => $config[28]->config_value,
                ];

                try {
                    Mail::to($encode['to_billing_email'])->send(new App\Mail\SendEmailInvoice($details));
                } catch (\Exception $e) {

                }

                Toastr::success(trans('Plan activation success!'), 'Success', ["positionClass" => "toast-top-center"]);
                return redirect()->route('admin.offline.transactions');
            } else {
                $message = "";
                if ($user_details->plan_id == $transaction_details->plan_id) {


                    // Check if plan validity is expired or not.
                    $plan_validity = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $user_details->plan_validity);
                    $current_date = Carbon::now();
                    $remaining_days = $current_date->diffInDays($plan_validity, false);

                    if ($remaining_days > 0) {
                        $plan_validity = Carbon::parse($user_details->plan_validity);
                        $plan_validity->addDays($term_days);
                        $message = "Plan renewed successfully!";
                    } else {
                        $plan_validity = Carbon::now();
                        $plan_validity->addDays($term_days);
                        $message = "Plan renewed successfully!";
                    }
                } else {

                    // Making all cards inactive, For Plan change
                    Card::where('user_id', $user_details->user_id)->update([
                        'card_status' => 'inactive',
                    ]);

                    $plan_validity = Carbon::now();
                    $plan_validity->addDays($term_days);
                    $message = "Plan activated successfully!";
                }

                $invoice_count = Transaction::where("invoice_prefix", $config[15]->config_value)->count();
                $invoice_number = $invoice_count + 1;

                Transaction::where('gobiz_transaction_id', $id)->update([
                    'invoice_prefix' => $config[15]->config_value,
                    'invoice_number' => $invoice_number,
                    'payment_status' => 'SUCCESS',
                ]);

                User::where('id', $user_details->id)->update([
                    'plan_id' => $transaction_details->plan_id,
                    'term' => $term_days,
                    'plan_validity' => $plan_validity,
                    'plan_activation_date' => now(),
                    'plan_details' => $plan_data
                ]);

                $encode = json_decode($transaction_details['invoice_details'], true);
                $details = [
                    'from_billing_name' => $encode['from_billing_name'],
                    'from_billing_email' => $encode['from_billing_email'],
                    'from_billing_address' => $encode['from_billing_address'],
                    'from_billing_city' => $encode['from_billing_city'],
                    'from_billing_state' => $encode['from_billing_state'],
                    'from_billing_country' => $encode['from_billing_country'],
                    'from_billing_zipcode' => $encode['from_billing_zipcode'],
                    'gobiz_transaction_id' => $transaction_details->gobiz_transaction_id,
                    'to_billing_name' => $encode['to_billing_name'],
                    'invoice_currency' => $transaction_details->transaction_currency,
                    'invoice_amount' => $encode['invoice_amount'],
                    'invoice_id' => $config[15]->config_value . $invoice_number,
                    'invoice_date' => $transaction_details->created_at,
                    'description' => $transaction_details->description,
                    'email_heading' => $config[27]->config_value,
                    'email_footer' => $config[28]->config_value,
                ];

                try {
                    Mail::to($encode['to_billing_email'])->send(new App\Mail\SendEmailInvoice($details));
                } catch (\Exception $e) {

                }


                Toastr::success(trans($message), 'Success', ["positionClass" => "toast-top-center"]);
                return redirect()->route('admin.offline.transactions');
            }
        } else {
            Transaction::where('gobiz_transaction_id', $id)->update([
                'transaction_id' => '',
                'payment_status' => 'FAILED',
            ]);


            Toastr::success(trans('Transaction updated successfully'), 'Success', ["positionClass" => "toast-top-center"]);

            return redirect()->route('admin.offline.transactions');
        }
    }
}
