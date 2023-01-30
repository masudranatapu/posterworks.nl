<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\CustomPage;
use Illuminate\Http\Request;

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

}
