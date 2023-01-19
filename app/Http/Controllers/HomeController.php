<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('frontend.index');
    }

    public function privacyPolicy()
    {
        return view('frontend.privacy');
    }

    public function termsCondition()
    {
        return view('frontend.terms');

    }
    public function faq()
    {
        return view('frontend.faq');

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

}
