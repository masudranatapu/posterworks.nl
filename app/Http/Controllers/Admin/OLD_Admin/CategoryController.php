<?php
namespace App\Http\Controllers\Admin;
use DB;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    public function Index()
    {
    	$settings = Setting::where('status', 1)->first();
    	$category = Category::latest()->get();
    	return view('admin.category.index', compact('settings', 'category'));
    }

    public function Create()
    {
    	$settings = Setting::where('status', 1)->first();
    	return view('admin.category.create', compact('settings'));
    }

    public function Store(Request $request )
    {
    	$request->validate([
    		 'category_name' => 'required|unique:categories'
    	]);

    	$category = new Category;
    	$category->category_name = $request->category_name;
    	$category->category_slug = Str::slug($request->category_name, '-');
        $category->save();

        Toastr::success(trans('Category Created Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.category.index');
    }

    public function Edit($id)
    {
    	 $category = Category::find($id);
    	 $settings = Setting::where('status', 1)->first();
    	 return view('admin.category.edit', compact('settings','category'));
    }

    public function Update(Request $request, $id)
    {
        $request->validate([
             // 'category_name' => 'required|unique:categories';
             'category_name' => 'unique:categories,category_name,'.$id
        ]);

		$category = Category::find($id);
		$category->category_name = $request->category_name;
		$category->category_slug = Str::slug($request->category_name, '-');
		$category->update();

        Toastr::success(trans('Category Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
    	return redirect()->route('admin.category.index');
    }

    public function Delete(Request $request)
    {
    	 $category = DB::table('categories')->where('id', $request->query('id'))->delete();

         Toastr::success(trans('Category Deleted Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
         return redirect()->route('admin.category.index');
    }
}

