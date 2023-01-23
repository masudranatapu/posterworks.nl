<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Http\Controllers\Controller;
use App\Models\MarketingMaterials;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MarketingMaterialsController extends Controller
{
    public function index()
    {
        $marketing_materials = MarketingMaterials::orderBy('order_id', 'asc')->paginate(6);
        return view('admin.marketing-materials.index', compact('marketing_materials'));
    }

    public function create()
    {
        return view('admin.marketing-materials.create');
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $this->validate($request, [
                'title'         => 'required|max:100',
                'order_id'      => 'required',
                'image'         => 'required|mimes:jpeg,png,jpg,gif,svg',
                'file'          => 'required|mimes:pdf',
                'status'        => 'required',
                'author_name'   => 'required',
                'description'   => 'required',


            ]);

            $marketing_material = new MarketingMaterials();
            $marketing_material->title  = $request->title;
            $marketing_material->order_id  = $request->order_id;
            $marketing_material->status  = $request->status;
            $marketing_material->author_name  = $request->author_name;
            $marketing_material->description  = $request->description;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name  = time() . '.' . $image->getClientOriginalExtension();
                $image->move('assets/uploads/marketing-materials/', $name);
                $marketing_material->image = asset('assets/uploads/marketing-materials/' . $name);
            }
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $name  = time() . '.' . $image->getClientOriginalExtension();
                $image->move('assets/uploads/marketing-materials/', $name);
                $marketing_material->file = asset('assets/uploads/marketing-materials/' . $name);
            }

            $marketing_material->save();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('Data not Created !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.marketing.material.create');
        }
        DB::commit();
        Toastr::success(trans('Data Successfully Created !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.marketing.materials');
    }

    public function edit($id)
    {
        $marketingMetarial = MarketingMaterials::find($id);
        return view('admin.marketing-materials.edit', compact('marketingMetarial'));
    }

    public function update(Request $request, $id)
    {

        DB::beginTransaction();
        try {
            $this->validate($request, [
                'title'         => 'required|max:100',
                'order_id'      => 'required',
                'image'         => 'required|mimes:jpeg,png,jpg,gif,svg',
                'file'          => 'required|mimes:pdf',
                'status'        => 'required',
                'author_name'   => 'required',
                'description'   => 'required',


            ]);

            $marketing_material = MarketingMaterials::find($id);
            $marketing_material->title  = $request->title;
            $marketing_material->order_id  = $request->order_id;
            $marketing_material->status  = $request->status;
            $marketing_material->author_name  = $request->author_name;
            $marketing_material->description  = $request->description;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name  = time() . '.' . $image->getClientOriginalExtension();
                $image->move('assets/uploads/marketing-materials/', $name);
                $marketing_material->image = asset('assets/uploads/marketing-materials/' . $name);
            }
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $name  = time() . '.' . $image->getClientOriginalExtension();
                $image->move('assets/uploads/marketing-materials/', $name);
                $marketing_material->file = asset('assets/uploads/marketing-materials/' . $name);
            }

            $marketing_material->save();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('Data not Updated !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.marketing.material.edit');
        }
        DB::commit();
        Toastr::success(trans('Data Successfully Updated !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.marketing.materials');
    }

    public function delete($id)
    {


        $marketingMetarial =   MarketingMaterials::find($id);

        $image_path = app_path("assets/uploads/marketing-materials/{$marketingMetarial->image}");
        $image_path_file = app_path("assets/uploads/marketing-materials/{$marketingMetarial->file}");

        if (File::exists($image_path, $image_path_file)) {
            File::delete($image_path, $image_path_file);
            unlink($image_path, $image_path_file);
        }
        $marketingMetarial->delete();

        Toastr::success(trans('Data Successfully Deleted !'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.marketing.materials');
    }

    public function updateStatus($id, $status)
    {
        $reviews = DB::table('reviews')->where('id', $id)->update(['status' => $status]);
        Toastr::success(trans('Review updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.review.index');
    }

    public function status($id, $status)
    {
        $marketingMetarial =  DB::table('marketing_materials')->where('id', $id)->update(['status' => $status]);
        Toastr::success(trans('Status updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }
}
