<?php

namespace App\Http\Controllers\Admin;
use Auth;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // My account
    public function account()
    {
        $account_details = User::where('id', Auth::user()->id)->where('status', 1)->first();
        $settings = DB::table('settings')->where('status', 1)->first();
        return view('admin.account.account', compact('account_details', 'settings'));
    }


    // Edit account
    public function editAccount()
    {
        $account_details = User::where('id', Auth::user()->id)->where('status', 1)->first();
        $settings = DB::table('settings')->where('status', 1)->first();
        return view('admin.account.edit-account', compact('account_details', 'settings'));
    }

    // Update account
    public function updateAccount(Request $request)
    {
        if ($request->profile_picture == null) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required'
            ]);
            User::where('id', Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
            Toastr::success(trans('Profile Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.edit.account')->with('success', 'Profile Updated Successfully!');
        } else {
            $validator = Validator::make($request->all(), [
                'profile_picture' => 'required|mimes:jpeg,png,jpg,gif,svg',
            ]);

            if ($validator->fails()) {
                Toastr::error(trans('Invalid Image or image size is large.'), 'Success', ["positionClass" => "toast-top-center"]);
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }

            $profile_picture = '/assets/uploads/profile/' . 'IMG-' . $request->profile_picture->getClientOriginalName() . '-' . time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->move(public_path('assets/uploads/profile'), $profile_picture);

            User::where('id', Auth::user()->id)->update([
                'profile_image' => $profile_picture
            ]);
            Toastr::success(trans('Profile Image Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.edit.account')->with('success', 'Profile Image Updated Successfully!');
        }
    }

    // Change password
    public function changePassword()
    {
        $account_details = User::where('id', Auth::user()->id)->where('status', 1)->first();
        $settings = DB::table('settings')->where('status', 1)->first();
        return view('admin.account.change-password', compact('account_details', 'settings'));
    }


    public function updatePassword(Request $request)
    {

        try
        {
            $validator = Validator::make($request->all(), [
                'current_password'  => 'required',
                'new_password'      =>  'required|same:confirm_password|min:6',
                'confirm_password'  => 'required|min:8',
                ]);

            if ($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if (Hash::check($request->current_password, Auth::User()->password))
            {
                if($request->new_password == $request->confirm_password)
                {
                    $user = User::where('id', '=', Auth::User()->id)->first();
                    $user->password = bcrypt($request->new_password);
                    $user->save();
                    Toastr::success('Your password has been updated successfully.');
                }
                else
                {
                    Toastr::error('Password do not match. Try again.', 'Success');
                }
            }
            else
            {
                Toastr::error('Current password does not match our record. Try again.');
            }
            return redirect()->back();
        }
        catch(\Exception $e)
        {
            Toastr::error('Error occured in changing password. Please try again.. !');
            return redirect()->back();
        }
    }

    public function getAdminUser()
    {
        $users = User::where('user_type', 1)->where('status', 1)->get();
        $settings = DB::table('settings')->where('status', 1)->first();
        return view('admin.account.index', compact('users', 'settings'));
    }

    public function getCreate(Request $request)
    {
        $settings = DB::table('settings')->where('status', 1)->first();
        return view('admin.account.create', compact('settings'));
    }
    public function getEdit(Request $request,$id)
    {
        $user = User::where('id', $id)->where('user_type', 1)->first();
        $settings = DB::table('settings')->where('status', 1)->first();
        return view('admin.account.edit', compact('user', 'settings'));
    }

    public function postStore(Request $request)
    {
        DB::beginTransaction();
        try {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email'
        ]);

        if ($validator->fails())
        {
          return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->email = $request->email;
        $user->name = $request->full_name;
        $user->designation = $request->designation;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->phone = $request->phone;
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $name  = time() . '.' . $image->getClientOriginalExtension();
            $image->move('assets/uploads/profile/', $name);
            $user->profile_image = asset('assets/uploads/profile/' . $name);
         }
        $user->status = $request->status;
        $user->user_type = $request->user_type;
        $user->save();

    } catch (\Exception $e) {
        DB::rollback();
        Toastr::error(trans('User not Created !'), 'Error', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.admin-users');
    }
        DB::commit();
        Toastr::success(trans('User Successfully Created !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.admin-users');
    }


    public function putUpdate(Request $request,$id)
    {
        DB::beginTransaction();
        try {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'email'     => 'required'
        ]);
        if ($validator->fails())
        {
          return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->name = $request->full_name;
        $user->designation = $request->designation;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->phone = $request->phone;
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $name  = time() . '.' . $image->getClientOriginalExtension();
            $image->move('assets/uploads/profile/', $name);
            $user->profile_image = asset('assets/uploads/profile/' . $name);
         }
        $user->status = $request->status;
        $user->user_type = $request->user_type;
        $user->update();

    } catch (\Exception $e) {
        DB::rollback();
        Toastr::error(trans('User not updated!'), 'Error', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.admin-users');
    }
        DB::commit();
        Toastr::success(trans('User updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.admin-users');
    }




}
