<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\User;
use App\Models\CustomPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function index()
    {
        $data['title'] = 'Home';
        $data['row'] = '';
        return view('frontend.index',compact('data'));
    }

    public function privacyPolicy()
    {
        $data['title'] = 'Privacy Policy';
        $data['row'] = CustomPage::where('url_slug','privacy-policy')->first();
        return view('frontend.pages.custom_page',compact('data'));
    }

    public function termsCondition()
    {
        $data['title'] = 'Terms Condition';
        $data['row'] = CustomPage::where('url_slug','terms-and-conditions')->first();
        return view('frontend.pages.custom_page',compact('data'));

    }

    public function faq()
    {
        $data['title'] = 'FAQ';
        $data['faqs'] = Faq::get();

        return view('frontend.pages.faq',compact('data'));

    }

    public function buyGiftCard()
    {
        return view('frontend.buygiftcard');

    }
    public function framePhoto()
    {
        return view('frontend.framephoto');

    }
    public function checkout()
    {
        return view('frontend.checkout');

    }

    public function userRegister(Request $request)
    {
        $setting = getSetting();

        $request->validate([
            'name' => "required",
            'email' => "required|email|unique:users,email",
            'password' => "required|confirmed|min:8|max:50",
        ]);

        $created = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($created) {
            Auth::guard('user')->logout();
            Auth::guard('admin')->logout();
            Auth::guard('user')->login($created);
            if ($setting->customer_email_verification) {
                return redirect()->route('verification.notice');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

    }




}
