<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use Carbon\Carbon;

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
    public function review()
    {
        return view('frontend.review');

    }

    public function reviewStore(Request $request)
    {
        $this->validate($request, [
            'details' => 'required|max:210',
        ]);

        $review = Review::where('user_id', Auth::user()->id)->get();

        if($review->count() > 0) {

            Toastr::info('You already write a review:-)','Success');
            return redirect()->back();

        }else {

            Review::insert([
                'user_id' => Auth::user()->id,
                'details' => $request->details,
                'status' => 0,
                'created_at' => Carbon::now(),
            ]);

            Toastr::success('Review successfully done. Please wait for admin approved :-)','Success');
            return redirect()->back();

        }

    }

}
