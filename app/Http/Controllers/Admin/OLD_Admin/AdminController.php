<?php

namespace App\Http\Controllers\Admin;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ContactMsg()
    {
        $settings = Setting::where('status', 1)->first();
        $contact = DB::table('contacts')->orderBy('id', 'DESC')->get();
        return view('admin.contact.index', compact('settings', 'contact'));
    }


    public function ContactDestroy(Request $request)
    {
       $contact = DB::table('contacts')->where('id', $request->query('id'))->delete();

       Toastr::success(trans('Deleted Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
       return redirect()->back();
    }

    public function SubscriberList()
    {
         $settings = Setting::where('status', 1)->first();
         $subscriber = DB::table('subscribers')->orderBy('id', 'DESC')->get();
         return view('admin.subscriber.index', compact('settings','subscriber'));
    }

    public function userGuide()
    {
         $settings = Setting::where('status', 1)->first();
         $data     = DB::table('tutorials')->orderBy('id', 'DESC')->get();
         return view('admin.userguide.index', compact('settings', 'data'));
    }

    public function userGuideCreate()
    {
        $settings = Setting::where('status', 1)->first();
         return view('admin.userguide.create', compact('settings'));
    }

    public function userGuideStore(Request $request)
    {
        $request->validate([
            'title'         => 'required|unique:tutorials',
            'description'   => 'required'
        ]);
        $data = array();
        $data['title']          = $request->title;
        $data['description']    = $request->description;
        DB::table('tutorials')->insert($data);
        Toastr::success(trans('Created Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.user.guide');
    }

    public function userGuideView($id)
    {
         $data     = DB::table('tutorials')->where('id', $id)->first();
         $settings = Setting::where('status', 1)->first();
         return view('admin.userguide.view', compact('settings', 'data'));

    }

    public function userGuideEdit($id)
    {
         $data = DB::table('tutorials')->where('id', $id)->first();
         $settings = Setting::where('status', 1)->first();
         return view('admin.userguide.edit', compact('settings', 'data'));
    }

    public function userGuideUpdate(Request $request, $id)
    {
        $request->validate([
            'title'         => 'unique:tutorials,title,'.$id,
            'description'   => 'required'
        ]);
        $data = array();
        $data['title']          = $request->title;
        $data['description']    = $request->description;
        DB::table('tutorials')->where('id', $id)->update($data);
        Toastr::success(trans('Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.user.guide');
    }

    public function DeleteUserGuide(Request $request)
    {
       $blog = DB::table('tutorials')->where('id', $request->query('id'))->delete();

       Toastr::success(trans('Deleted Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
       return redirect()->back();
    }

}
