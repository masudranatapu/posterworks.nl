<?php

namespace App\Http\Controllers\Admin;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Request $request){
        $reviews = DB::table('reviews')
        ->select('reviews.*','users.name as user_name')
        ->leftJoin('users', 'users.id', '=', 'reviews.user_id')
        ->latest()->get();
        return view('admin.review.index', compact('reviews'));
    }
    public function getCreate(Request $request){

        return view('admin.review.create');
    }

    public function postStore(Request $request)
    {
        DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(), [
                'display_name' => 'required|string|max:50',
                'display_title' => 'required|string|max:50',
                'details' => 'required|string|min:10|max:250',
              ]);

              if ($validator->fails())
              {
                return redirect()->back()->withErrors($validator)->withInput();
              }

        DB::table('reviews')->insert([
            'user_id' => Auth::user()->id,
            'order_id' => DB::table('reviews')->max('order_id')+1,
            'display_title' => $request->display_title,
            'display_name' => $request->display_name,
            'details' => $request->details,
            'status' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'created_by' => Auth::user()->id,
        ]);

    } catch (\Exception $e) {
        dd($e->getMessage());
        DB::rollback();
        Toastr::error('Something wrong! Please try again', 'Error', ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }
    DB::commit();
    Toastr::success(trans('Review submitted successfully'), 'Success', ["positionClass" => "toast-top-center"]);
    return redirect()->route('admin.review.index');
    }




    public function getEdit(Request $request,$id){
        $review = DB::table('reviews')->where('id',$id)->first();
        return view('admin.review.edit',compact('review'));
    }


    public function putUpdate(Request $request,$id)
    {
        DB::beginTransaction();
        try {
        $validator = Validator::make($request->all(), [
            'display_name' => 'required|string|max:50',
            'display_title' => 'required|string|max:50',
            'details' => 'required|string|min:10|max:250',
          ]);

          if ($validator->fails())
          {
            return redirect()->back()->withErrors($validator)->withInput();
          }

        DB::table('reviews')
            ->where('id',$id)
            ->update([
                'order_id' => $request->order_id,
                'display_title' => $request->display_title,
                'display_name' => $request->display_name,
                'details' => $request->details,
                'status' => $request->status,
                // 'updated_at' => \Carbon\Carbon::now(),
                // 'updated_by' => Auth::user()->id,
            ]);

    } catch (\Exception $e) {

        dd($e->getmessage());
        DB::rollback();
        Toastr::error('Something wrong! Please try again', 'Error', ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }
    DB::commit();
    Toastr::success(trans('Review submitted successfully'), 'Success', ["positionClass" => "toast-top-center"]);
    return redirect()->route('admin.review.index');
}



    public function updateStatus($id,$status){
        $reviews = DB::table('reviews')->where('id',$id)->update(['status' => $status]);
        Toastr::success(trans('Review updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.review.index');
    }

    public function getDelete($id){
        DB::beginTransaction();
        try {
        $reviews = DB::table('reviews')->where('id',$id)->delete();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Something wrong! Please try again', 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
    DB::commit();
    Toastr::success(trans('Review deleted Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
    return redirect()->route('admin.review.index');
    }





}
