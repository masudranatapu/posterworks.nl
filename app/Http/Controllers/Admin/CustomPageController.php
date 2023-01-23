<?php
namespace App\Http\Controllers\Admin;
use App\Models\CustomPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
class CustomPageController extends Controller
{
    protected $page;
    public function __construct(
        CustomPage $page
    )
    {
        $this->page     = $page;
    }

    public function getIndex(Request $request){
        $this->resp = $this->page->getPaginatedList($request);


        return view('admin.custom-page.index')->withData($this->resp->data);
    }

     public function getCreate(){
        $data = [];
        return view('admin.custom-page.create')->withData($data);
    }

    public function postStore(Request $request)
    {
        $this->resp = $this->page->postStore($request);
        if (!$this->resp->status) {
            return redirect()->back()->with($this->resp->redirect_class, $this->resp->msg);
            Toastr::error(trans($this->resp->msg), 'Error', ["positionClass" => "toast-top-center"]);
        }
        Toastr::success(trans($this->resp->msg), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route($this->resp->redirect_to)->with($this->resp->redirect_class, $this->resp->msg);
    }


    public function getEdit(Request $request, $id)
    {
          $this->resp = $this->page->getShow($id);
          if (!$this->resp->status) {
            return redirect()->back()->with($this->resp->redirect_class, $this->resp->msg);
        }
        return view('admin.custom-page.edit')->withData($this->resp->data);
    }

    public function putUpdate (Request $request, $id)
    {
        $this->resp = $this->page->putUpdate ($request, $id);
        if (!$this->resp->status) {
            return redirect()->back()->with($this->resp->redirect_class, $this->resp->msg);
            Toastr::error(trans($this->resp->msg), 'Error', ["positionClass" => "toast-top-center"]);
        }
        Toastr::success(trans($this->resp->msg), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route($this->resp->redirect_to)->with($this->resp->redirect_class, $this->resp->msg);
    }



    public function postEditorImageUpload(Request $request)
    {
        if (!is_null($request->file('image')))
        {
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $file_path = 'assets/uploads/page';
        $base_name = preg_replace('/\..+$/', '', $image->getClientOriginalName());
        $base_name = explode(' ', $base_name);
        $base_name = implode('-', $base_name);
        $img = Image::make($image->getRealPath());
        $feature_image = $base_name . "-" . uniqid().'.webp';
        Image::make($img)->save($file_path.'/'.$feature_image);
        $image_name = $file_path .'/'. $feature_image;
            return   url('/').'/'.$image_name;
        }
    }

    public function getDelete($id)
    {
        $this->resp = $this->page->getDelete($id);
        return redirect()->route($this->resp->redirect_to)->with($this->resp->redirect_class, $this->resp->msg);
    }
    public function changeActiveStatus(Request $request){

        $id                     = $request->id;
        $article                = Page::findOrFail($id);
        $page->is_active        = !$page->is_active;
        $page->updated_by   = Auth::user()->PK_NO;
        $page->update();
        return response()->json($article);
    }




}
