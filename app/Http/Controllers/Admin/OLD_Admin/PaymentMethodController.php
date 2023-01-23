<?php
namespace App\Http\Controllers\Admin;
use App\Models\Gateway;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class PaymentMethodController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // All Payment Methods
    public function paymentMethods()
    {
        $payment_methods = Gateway::orderBy('created_at', 'desc')->get();
        $settings = Setting::where('status', 1)->first();
        return view('admin.payment-methods.payment-methods', compact('payment_methods', 'settings'));
    }

    // Delete Payment Method
    public function deletePaymentMethod(Request $request)
    {
        $payment_gateway_details = Gateway::where('id', $request->query('id'))->first();
        if ($payment_gateway_details->status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        Gateway::where('id', $request->query('id'))->update(['status' => $status]);

        Toastr::success(trans('Payment Method Status Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.payment.methods');
    }


}
