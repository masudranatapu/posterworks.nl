<?php

namespace App\Http\Controllers\Admin;

use App\Models\Theme;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ThemeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Themes
    public function themes()
    {
        $themes = Theme::orderBy('created_at', 'desc')->get();
        $settings = Setting::where('status', 1)->first();

        return view('admin.themes.themes', compact('themes', 'settings'));
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
}
