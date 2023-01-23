<?php
namespace App\Http\Controllers\Admin;
use DB;
use App\Models\Blog;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
    	 $blog =DB::table('blogs')
                ->leftjoin('categories', 'blogs.category_id', 'categories.id')
                ->select('blogs.*', 'categories.category_name')
                ->orderBy('order_id', 'DESC')->get();
    	 $settings = Setting::where('status', 1)->first();
    	 return view('admin.blog.index', compact('settings', 'blog'));
    }

    public function Create()
    {
    	 $settings = Setting::where('status', 1)->first();
         $category = Category::latest()->get();
    	 return view('admin.blog.create', compact('settings', 'category'));
    }

    public function Store(Request $request)
    {
        //  dd($request->all());
    	 $request->validate([
    	 	'title' 		=> 'required|unique:blogs',
    	 	'category_id' 	=> 'required',
    	 	'image' 		=> 'required',
    	 	'details' 		=> 'required'
    	 ]);

    	 $blog = new Blog;
    	 $blog->title  	     = $request->title;
    	 $blog->slug  	     = Str::slug($request->title, '-');
    	 $blog->category_id  = $request->category_id;
    	 $blog->details  	 = $request->details;
    	 $blog->tag  	 	 = $request->tag;
    	 $blog->author  	 = $request->author;
         $blog->is_active       = $request->is_active;
         $blog->summary       = $request->summary;
         $blog->meta_description       = $request->meta_description;
         $blog->created_by      = Auth::user()->id;
         $blog->order_id        = Blog::max('order_id')+1;
         $blog->created_at      = Carbon::now();
    	 $blog->date  	     = date('d-m-Y');
         if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $base_name = preg_replace('/\..+$/', '', $photo->getClientOriginalName());
            $image_name = $base_name . "-" . uniqid() . "." . 'webp';
            $file_path = 'assets/uploads/blog';
            $photo->move($file_path, $image_name);
            $blog->image ='/'.$file_path.'/'.$image_name;
         }
        $blog->save();

        Toastr::success(trans('Post Created Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.blog');
    }

    public function Edit($id)
    {
    	 $blog = Blog::find($id);
    	 $settings = Setting::where('status', 1)->first();
         $category = Category::latest()->get();
    	 return view('admin.blog.edit', compact('settings','blog', 'category'));
    }

    public function Update(Request $request, $id)
    {

    	 $blog =Blog::find($id);
    	 $blog->title  	     = $request->title;
    	 $blog->slug  	     = Str::slug($request->title, '-');;
    	 $blog->category_id  = $request->category_id;
    	 $blog->details  	 = $request->details;
    	 $blog->tag  	 	 = $request->tag;
    	 $blog->author  	 = $request->author;
         $blog->is_active       = $request->is_active;
         $blog->summary       = $request->summary;
         $blog->meta_description       = $request->meta_description;
         $blog->order_id       = $request->order_id;
         $blog->updated_at      = Carbon::now();
         $blog->updated_by      = Auth::user()->id;
    	 $blog->date  	     = date('d-m-Y');
         if ($request->hasFile('image')) {
         	// delete old image
            $imagePath = $blog->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $photo = $request->file('image');
            $base_name = preg_replace('/\..+$/', '', $photo->getClientOriginalName());
            $image_name = $base_name . "-" . uniqid() . "." . 'webp';
            $file_path = 'assets/uploads/blog';
            $photo->move($file_path, $image_name);
            $blog->image ='/'.$file_path.'/'.$image_name;
         }
        $blog->update();

        Toastr::success(trans('Post Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.blog');
    }

  public function Delete(Request $request)
    {
       $blog = DB::table('blogs')->where('id', $request->query('id'))->first();
       if (file_exists($blog->image)) {
            unlink($blog->image);
        };
       $blog = DB::table('blogs')->where('id', $request->query('id'))->delete();

       Toastr::success(trans('Post Deleted Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
       return redirect()->route('admin.blog');
    }

    public function textEditorImageUpload(Request $request)
    {
        if (!is_null($request->file('image')))
        {
            $photo = $request->file('image');
            $base_name = preg_replace('/\..+$/', '', $photo->getClientOriginalName());
            $image_name = $base_name . "-" . uniqid() . "." . 'webp';
            $file_path = 'assets/uploads/blog';
            $photo->move($file_path, $image_name);
            return url('/').'/' . $file_path . '/' . $image_name;
        }
    }

}
