<?php
namespace App\Http\Controllers\Admin;
use App\Models\Plan;
use PayPal\Api\Patch;
use App\Models\Setting;
use PayPal\Api\Currency;
use Stripe\StripeClient;
use Illuminate\Support\Str;
use PayPal\Api\ChargeModel;
use PayPal\Rest\ApiContext;
use Illuminate\Http\Request;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;
use PayPal\Api\PaymentDefinition;
use Illuminate\Support\Facades\DB;
use PayPal\Api\Plan as PayPalPlan;
use Illuminate\Support\Facades\URL;
use PayPal\Api\MerchantPreferences;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        /** PayPal api context **/

        // $paypal_configuration = DB::table('config')->get();

        // $this->apiContext = new ApiContext(new OAuthTokenCredential($paypal_configuration[4]->config_value, $paypal_configuration[5]->config_value));
        // $this->apiContext->setConfig(array(
        //     'mode' => $paypal_configuration[3]->config_value,
        //     'http.ConnectionTimeOut' => 30,
        //     'log.LogEnabled' => true,
        //     'log.FileName' => storage_path() . '/logs/paypal.log',
        //     'log.LogLevel' => 'DEBUG',
        // ));
    }
    // All Plans
    public function plans()
    {
        $plans = Plan::get();
        $currencies = Setting::where('status', 1)->get();
        $settings = Setting::where('status', 1)->first();
        $config = DB::table('config')->get();
        // $gateway = DB::table('gateways')->pluck('id','status');
        $gateway = DB::table('gateways')->where('status',1)->get();
        return view('admin.plans.plans', compact('plans', 'currencies', 'settings', 'config','gateway'));
    }


    // Add Plan
    public function addPlan()
    {
        $config = DB::table('config')->get();
        $settings = Setting::where('status', 1)->first();
        return view('admin.plans.add-plan', compact('settings', 'config'));
    }

    // Save Plan
    public function savePlan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_name' => 'required',
            'plan_description' => 'required',
            // 'plan_type'=> 'required',
            // 'plan_price' => 'required',
            'is_free'=>'required',
            'plan_price_monthly'=>'required',
            'plan_price_yearly'=>'required',
            'no_of_vcards' => 'required'
        ]);

          if ($validator->fails())
          {
            return redirect()->back()->withErrors($validator)->with('toast_error', $validator->messages()->all()[0])->withInput();
          }

        DB::beginTransaction();
        try {

        if ($request->validity >= 360) {
            $interval = 'year';
        } else {
            $interval = 'month';
        }

        // $config = DB::table('config')->get();
        // $stripe = new StripeClient($config[10]->config_value);
        // $product = $stripe->products->create([
        //     'name' => $request->plan_name
        // ]);

        // $stripe_plan = $stripe->plans->create([
        //     'amount' => $request->plan_price * 100,
        //     'currency' => 'usd',
        //     'interval' => $interval,
        //     'product' => $product->id,
        // ]);
//
////            $planStripeData['plan_id'] = $plan->id;
////            $plan_details->stripe_data = json_encode($planStripeData);
////            $plan_details->stripe_plan = $plan->id;
////            $plan_details->name = $plan_details->plan_name;
////            $plan_details->slug = Str::slug($plan_details->plan_name);
////            $plan_details->save();
//
//        return $stripe_plan;

        $plan               = new Plan;
        $plan->plan_id      = uniqid();
        $plan->plan_name    = $request->plan_name;
        $plan->plan_description = $request->plan_description;
        // $plan->plan_type    = $request->plan_type;
        // if($request->recommended==1){
        //     DB::table('plans')->where('recommended',1)

        // }
        $plan->recommended  = $request->recommended=='on' ? '1':'0';
        $plan->plan_price   = $request->plan_price;
        $plan->is_free      = $request->is_free;
        $plan->plan_price_monthly = $request->plan_price_monthly;
        $plan->plan_price_yearly = $request->plan_price_yearly;
        $plan->no_of_vcards = $request->no_of_vcards;
        $plan->plans_type   = 1;
        // $plan->no_of_services = $request->no_of_services;
        // $plan->no_of_galleries = $request->no_of_galleries;
        // $plan->no_of_features = $request->no_of_features;
        // $plan->no_of_paymenno_of_servicests = $request->no_of_payments;
        $plan->personalized_link = $request->personalized_link ?? 0;
        $plan->hide_branding = $request->hide_branding=='on' ? '1':'0';
        $plan->free_setup = $request->free_setup ?? 0;
        $plan->free_support = $request->free_support ?? 0;
        $plan->is_watermark_enabled = $request->is_watermark_enabled ?? 0;
        // $plan->stripe_data = json_encode($stripe_plan);
        // $plan->stripe_plan_id = $stripe_plan->id;
        $plan->name = $plan->plan_name;
        $plan->slug = Str::slug($plan->plan_name);
        $plan->features = json_encode($request->get('feature') ?? []);
        $plan->is_vcard = $request->is_vcard ?? 1;
        $plan->is_whatsapp_store = $request->is_whatsapp_store ?? 0;
        $plan->is_email_signature = $request->is_email_signature ?? 0;
        $plan->is_qr_code = $request->is_qr_code=='on' ? '1':'0';
        $plan->save();

    } catch (\Exception $e) {
        dd($e->getMessage());
        DB::rollback();
        Toastr::error(trans('Sometning wrong ! please try again'), 'Error', ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }
        DB::commit();
        Toastr::success(trans('New Plan Created Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.plans');
    }

    // Edit Plan
    public function editPlan(Request $request, $id)
    {
        $plan_id = $request->id;
        $plan_details = Plan::where('plan_id', $plan_id)->first();
        $settings = Setting::where('status', 1)->first();
        if ($plan_details == null) {
            return view('errors.404');
        } else {
            return view('admin.plans.edit-plan', compact('plan_details', 'settings'));
        }
    }

    // Update Plan
    public function updatePlan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required',
            'plan_name' => 'required',
            'plan_description' => 'required',
            'is_free'=> 'required',
            // 'plan_type'=>'required',
            'plan_price_monthly'=>'required',
            'plan_price_yearly'=>'required',
            // 'plan_price' => 'required',
            'no_of_vcards' => 'required'
        ]);
        if ($validator->fails())
        {
          return redirect()->back()->withErrors($validator)->withInput();
        }

        // dd($request->all());

        DB::beginTransaction();
        try {

        /*
        if($request->plan_price_monthly !=  $plan->plan_price_monthly){
            $stripe_plan_id = $plan->stripe_plan_id;
            $config = DB::table('config')->get();
            $stripe = new StripeClient($config[10]->config_value);
            $stripe_plan = $stripe->plans->update(
                $stripe_plan_id,
                [
                "price" => intval($request->plan_price_monthly * 100),
                "amount_decimal" => intval($request->plan_price_monthly*100),
                ]
              );
              $updateData['stripe_data'] = json_encode($stripe_plan);
        }

        if($request->plan_price_yearly !=  $plan->plan_price_yearly){
            $config = DB::table('config')->get();
            $stripe = new StripeClient($config[10]->config_value);
            $stripe_plan_id_yearly = $plan->stripe_plan_id_yearly;
            $stripe_plan = $stripe->plans->update(
                $stripe_plan_id_yearly,
                [
                "price" =>  intval($request->plan_price_yearly * 100),
                "amount_decimal" => intval($request->plan_price_yearly*100),
                ]
              );
              $updateData['stripe_data_yearly'] = json_encode($stripe_plan);
        }
        */
        $plan = Plan::where('plan_id',$request->plan_id)->first();
        $plan->plan_name                = $request->plan_name;
        $plan->plan_description         = $request->plan_description;
        $plan->plan_type               =  $request->plan_type;
        $plan->recommended              = $request->recommended=='on' ? '1':'0';
        $plan->plan_price               = $request->is_free == 0 ? $request->plan_price : 0;
        $plan->is_free                  = $request->is_free;
        $plan->plan_price_monthly       = $request->is_free == 0 ? $request->plan_price_monthly : 0;
        $plan->plan_price_yearly        = $request->is_free == 0 ? $request->plan_price_yearly : 0;
        $plan->no_of_vcards             = $request->no_of_vcards;
        $plan->personalized_link        = $request->personalized_link;
        $plan->hide_branding            = $request->hide_branding=='on' ? '1':'0';
        $plan->free_setup               = $request->free_setup;
        $plan->free_support             = $request->free_support;
        $plan->is_watermark_enabled     = $request->is_watermark_enabled;
        $plan->is_vcard                 = $request->is_vcard;
        $plan->is_whatsapp_store        = $request->is_whatsapp_store;
        $plan->is_email_signature       = $request->is_email_signature;
        $plan->is_qr_code               = $request->is_qr_code=='on' ? '1':'0';
        $plan->features                 = json_encode($request->get('feature') ?? []);
        $plan->update();

        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            Toastr::error(trans('Sometning wrong ! please try again'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
            DB::commit();
            Toastr::success(trans('Plan Details Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.plans');
    }



    // Delete Plan
    public function deletePlan(Request $request)
    {
        $plan_details = Plan::where('plan_id', $request->query('id'))->first();
        if ($plan_details->status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        Plan::where('plan_id', $request->query('id'))->update(['status' => $status]);

        Toastr::success(trans('Plan Status Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.plans');
    }

    public function getstripe($id,$period){

        $plan =  Plan::where('id', $id)->first();
        $config = DB::table('config')->get();

        $stripe = new StripeClient($config[10]->config_value);

        $product = $stripe->products->create([
            'name' => $plan->plan_name .' for '.$period,
        ]);

        $plan_price = 0;

        if($period == 'month'){
            $plan_price = $plan->plan_price_monthly;
        }

        if($period == 'year'){
            $plan_price = $plan->plan_price_yearly;
        }

        $stripe_plan = $stripe->plans->create([
            'amount' => $plan_price * 100,
            'currency' => 'usd',
            'interval' => $period,
            'product' => $product->id,
        ]);

        // dd($stripe_plan);

        if($period == 'month'){
            $plan->stripe_data = json_encode($stripe_plan);
            $plan->stripe_plan_id = $stripe_plan->id;
        }

        if($period == 'year'){
            $plan->stripe_data_yearly = json_encode($stripe_plan);
            $plan->stripe_plan_id_yearly = $stripe_plan->id;
        }

        $plan->update();
        Toastr::success(trans('Stripe package created Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->back();

    }


    public function createPaypalPlan($id,$period){
        $payment_plan   =  Plan::where('id', $id)->first();
        $config         = DB::table('config')->get();
        $plan_name      = $payment_plan->plan_name .' for '.$period;
        $plan_price = 0;

        $plan = new PayPalPlan();
        $plan->setName($plan_name)
            ->setDescription($payment_plan->plan_description)
            ->setType('fixed');

            $paymentDefinition = new PaymentDefinition();
            if($period == 'month'){
                $plan_price = $payment_plan->plan_price_monthly;
                $paymentDefinition->setName('Regular Payments')
                ->setType('REGULAR')
                ->setFrequency('MONTH')
                ->setFrequencyInterval("1")
                ->setCycles("12")
                ->setAmount(new Currency(array('value' => $plan_price, 'currency' => $config[1]->config_value)));
            }

            if($period == 'year'){
                $plan_price = $payment_plan->plan_price_yearly;

                $paymentDefinition->setName('Regular Payments')
                ->setType('REGULAR')
                ->setFrequency('YEAR')
                ->setFrequencyInterval("1")
                ->setCycles("1")
                ->setAmount(new Currency(array('value' => $plan_price, 'currency' => $config[1]->config_value)));
            }


            // $paymentDefinition->setName('Regular Payments')
            //     ->setType('REGULAR')
            //     ->setFrequency(Str::ucfirst($period))
            //     ->setFrequencyInterval($interval)
            //     // ->setCycles("12")
            //     ->setCycles("12")
            //     ->setAmount(new Currency(array('value' => $plan_price, 'currency' => $config[1]->config_value)));


            // $chargeModel = new ChargeModel();
            // $chargeModel->setType('SHIPPING')->setAmount(new Currency(array('value' => 10, 'currency' => $config[1]->config_value)));
            // $paymentDefinition->setChargeModels(array($chargeModel));

            $merchantPreferences = new MerchantPreferences();
            $merchantPreferences->setReturnUrl(URL::to('execute-agreement',['success'=>true]))
                ->setCancelUrl(URL::to('execute-agreement',['success'=>false]))
                ->setAutoBillAmount("yes")
                ->setInitialFailAmountAction("CONTINUE")
                ->setMaxFailAttempts("0");
                // ->setSetupFee(new Currency(array('value' => 1, 'currency' => $config[1]->config_value)));
            $plan->setPaymentDefinitions(array($paymentDefinition));
            $plan->setMerchantPreferences($merchantPreferences);
            $request = clone $plan;

             //create the plan
        try {
            $createdPlan = $plan->create($this->apiContext);
            $actived_plan = $this->activePaypalPlan($createdPlan);
               // subscription agreement create
            // $created_agreement = $this->agreementPlan($createdPlan->getId());

            $plan_ = PayPalPlan::get($createdPlan->getId(), $this->apiContext);


            if($period == 'month'){
                $payment_plan->paypal_plan_data = json_encode($plan_);
                $payment_plan->paypal_plan_id = $plan_->id;
            }

            if($period == 'year'){
                $payment_plan->paypal_plan_data_yearly = json_encode($plan_);
                $payment_plan->paypal_plan_id_yearly = $plan_->id;
            }

            $payment_plan->update();

        } catch (Exception $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        }

    Toastr::success(trans('Paypal package created Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
    return redirect()->back();
    }


    public function activePaypalPlan($createdPlan)
    {
        $patch = new Patch();

        $value = new PayPalModel('{
	       "state":"ACTIVE"
	     }');

        $patch->setOp('replace')
            ->setPath('/')
            ->setValue($value);
        $patchRequest = new PatchRequest();
        $patchRequest->addPatch($patch);

        try {
            $createdPlan->update($patchRequest, $this->apiContext);

            $plan = PayPalPlan::get($createdPlan->getId(), $this->apiContext);

            return $plan;
        }catch (Exception $ex) {
            echo $ex->getCode();
            echo $ex->getData();
        exit(1);
        }

    }

    public function agreementPlan($id): Agreement
    {
        $startDate = date('c', time() + 3600);
        $agreement = new Agreement();

        $agreement->setName('Base Agreement')
            ->setDescription('Basic Agreement')
            ->setStartDate($startDate);

        $plan = new PayPalPlan();
        $plan->setId($id);
        $agreement->setPlan($plan);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $agreement->setPayer($payer);

        try {
            $agreement->create($this->apiContext);

            return $agreement;
        }catch (Exception $ex) {
                echo $ex->getCode();
                echo $ex->getData();
            exit(1);
        }
    }

    // public function activePaypalPlan($createdPlan,$plan_id){
    //     try {
    //         $patch = new Patch();
    //         $value = new PayPalModel('{"state":"ACTIVE"}');
    //         $patch->setOp('replace')->setPath('/')->setValue($value);
    //         $patchRequest = new PatchRequest();
    //         $patchRequest->addPatch($patch);
    //         $createdPlan->update($patchRequest, $this->apiContext);
    //         $plan = PayPalPlan::get($plan_id, $this->apiContext);
    //          // Output plan id
    //             echo 'Plan ID:' . $plan->getId();
    //         } catch (PayPal\Exception\PayPalConnectionException $ex) {
    //             echo $ex->getCode();
    //             echo $ex->getData();
    //             die($ex);
    //         } catch (Exception $ex) {
    //             die($ex);
    //     }
    // }


    public function getPlanList(){
        try {

            $params = array('page_size' => '20');
            $planList = PayPalPlan::all($params, $this->apiContext);
            dd($planList);
            } catch (Exception $ex) {

                exit(1);
            }
            return $planList;
    }


}
