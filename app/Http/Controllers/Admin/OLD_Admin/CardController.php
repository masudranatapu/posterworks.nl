<?php
namespace App\Http\Controllers\Admin;
use App\Models\Theme;
use App\Models\Setting;
use App\Models\BusinessCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $cards = DB::table('business_cards as c')
        ->select('c.id','c.title','c.title2','c.phone_number','c.card_email','c.logo','c.card_url',
        'c.profile','c.created_at','p.plan_name','c.user_id','c.status','u.username','u.active_card_id'
        )
        // ->leftJoin('business_fields as cf','cf.card_id','c.id')
        ->leftJoin('users as u','c.user_id','u.id')
        ->leftJoin('plans as p','u.plan_id','p.id')
        ->orderBy('c.created_at', 'desc')
        ->where('c.status', '!=' , 2)
        ->get();
        $settings = Setting::where('status', 1)->first();
        return view('admin.cards.index', compact('cards', 'settings'));
    }


    public function update(Request $request,$id){

        $request->validate([
            'theme_name'  => 'required',
            'theme_description' => 'required',
            // 'theme_thumbnail' => 'required',
            'theme_price' => 'required',
            'status' => 'required',
        ]);


        $themes = Theme::find($id);
        $themes->theme_name     = $request->theme_name;
        $themes->theme_description    = $request->theme_description;
        $themes->theme_price     = $request->theme_price;
        $themes->status     = $request->status;

        if ($request->hasFile('theme_thumbnail')) {
            // __delete old image
            $imagePath = public_path($themes->theme_thumbnail);
            if(File::exists($imagePath)){
                File::delete($imagePath);
            }
            // __add new image
            $theme_thumbnail = $request->file('theme_thumbnail');
            $name  = time() . '.' . $theme_thumbnail->getClientOriginalExtension();
            Image::make($theme_thumbnail)->save('assets/uploads/theme/' . $name);
            $themes->theme_thumbnail = 'assets/uploads/theme/' . $name;
        }

     $themes->update();
     Toastr::success(trans('Theme updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
     return redirect()->route('admin.themes');

    }

    public function delete(Request $request,$id){
        DB::beginTransaction();
        try {
            $card_status = DB::table('business_cards')->where('id',$id)->first();
            if($card_status->status==1 || $card_status->status==0){
                DB::table('business_fields')->where('card_id',$id)->update([
                    'status'=> 0
                ]);
                DB::table('business_cards')->where('id',$id)->update([
                    'status'=> 2,
                    'deleted_at' => date('Y-m-d H:i:s'),
                    'deleted_by' => Auth::user()->id
                ]);

            }else{
                DB::table('business_fields')->where('card_id',$id)->delete();
                DB::table('business_cards')->where('id',$id)->delete();
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            Toastr::error(trans('Card not updated!'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
        DB::commit();
        Toastr::success(trans('Card Successfully removed!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }



    public function getTrashList(Request $request,$paginate=20)
    {
        $cards = DB::table('business_cards as c')
        ->select('c.id','c.title','c.title2','c.phone_number','c.card_email','c.logo','c.card_url',
        'c.profile','c.created_at','p.plan_name','c.user_id','c.status'
        )
        // ->leftJoin('business_fields as cf','cf.card_id','c.id')
        ->leftJoin('users as u','c.user_id','u.id')
        ->leftJoin('plans as p','u.plan_id','p.id')
        ->orderBy('c.created_at', 'desc')
        ->where('c.status',2)
        ->whereNotNull('c.deleted_at')
        ->groupBy('c.id')
        ->paginate($paginate);
        $settings = Setting::where('status', 1)->first();
        return view('admin.cards.trash-list', compact('cards', 'settings'));
    }

        // Update status
        public function changeStatus(Request $request,$id)
        {
            $user_details = BusinessCard::where('id', $id)->first();
            if ($user_details->status == 0) {
                $status = 1;
            }else {
                $status = 0;
            }
            BusinessCard::where('id', $id)->update(['status' => $status]);
            Toastr::success(trans('Card Status Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.cards');
        }

        // Update status
        public function activeCard(Request $request,$id)
        {
            BusinessCard::where('id', $id)->update([
                'status' => 1,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'is_deleted' => 0,
                'updated_at' =>  date('Y-m-d H:i:s'),
            ]);
            Toastr::success(trans('Card Status Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.cards');
        }

        public function checkPerLink(Request $request,$link_text){
            $reserve_word = config('app.reserve_word');
            $data['status'] = false;
            $data['message'] = 'This link is not available';
            if(!in_array($link_text,$reserve_word)){
                //check in database business_cards card_url
                $card_url = BusinessCard::where('card_url',$link_text)->first();
                if($card_url == null){
                    $data['status'] = true;
                    $data['message'] = 'This link is available';
                }
            }
            return response()->json($data);
        }


}
