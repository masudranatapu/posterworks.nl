<?php
namespace App\Http\Controllers\Admin;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;


class FaqController extends Controller
{
    protected $faq;
    public function __construct(
        Faq $faq
    )
    {
        $this->faq     = $faq;
    }

    public function getIndex(Request $request){
        $this->resp = $this->faq->getPaginatedList($request);
        return view('admin.faq.index')->withData($this->resp->data);
    }

     public function getCreate(){
        $data = [];
        return view('admin.faq.create')->withData($data);
    }

    public function postStore(Request $request)
    {
        $this->resp = $this->faq->postStore($request);
        if (!$this->resp->status) {
            return redirect()->back()->with($this->resp->redirect_class, $this->resp->msg);
            Toastr::error(trans($this->resp->msg), 'Error', ["positionClass" => "toast-top-center"]);
        }
        Toastr::success(trans($this->resp->msg), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route($this->resp->redirect_to)->with($this->resp->redirect_class, $this->resp->msg);
    }


    public function getEdit(Request $request, $id)
    {
          $this->resp = $this->faq->getShow($id);
          if (!$this->resp->status) {
            return redirect()->back()->with($this->resp->redirect_class, $this->resp->msg);
        }
        return view('admin.faq.edit')->withData($this->resp->data);
    }

    public function putUpdate (Request $request, $id)
    {
        $this->resp = $this->faq->putUpdate ($request, $id);
        if (!$this->resp->status) {
            return redirect()->back()->with($this->resp->redirect_class, $this->resp->msg);
            Toastr::error(trans($this->resp->msg), 'Error', ["positionClass" => "toast-top-center"]);
        }
        Toastr::success(trans($this->resp->msg), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route($this->resp->redirect_to)->with($this->resp->redirect_class, $this->resp->msg);
    }

    public function getDelete($id)
    {
        $this->resp = $this->faq->getDelete($id);
        return redirect()->route($this->resp->redirect_to)->with($this->resp->redirect_class, $this->resp->msg);
    }



}
