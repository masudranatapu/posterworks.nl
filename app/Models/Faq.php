<?php
namespace App\Models;
use Illuminate\Support\Str;
use App\Traits\RepoResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use RepoResponse;
    protected $table        = 'faqs';
    public $timestamps      = false;


    public function getPaginatedList($request, int $per_faq = 20)
    {
        $data = $this->orderBy('order_id','DESC')->paginate($per_faq);
        return $this->formatResponse(true, '', 'admin.faq.list', $data);
    }
    public function getShow(int $id)
    {
        $data =  Faq::find($id);
        if (!empty($data)) {
            return $this->formatResponse(true, 'Data found', 'admin.faq.edit', $data);
        }
        return $this->formatResponse(false, 'Did not found data !', 'admin.faq.list', null);
    }

    public function postStore($request)
    {
        DB::beginTransaction();
        try {
            $faq                   = new Faq();
            $faq->title            = $request->title;
            $faq->body             = $request->body;
            $faq->is_active        = $request->is_active;
            $faq->order_id         = Faq::max('order_id')+1;
            $faq->created_by       = Auth::user()->id;
            $faq->created_at       = date('Y-m-d H:i:s');
            $faq->save();
        } catch (\Exception $e) {
            dd($e->getMessage());

              DB::rollback();
            return $this->formatResponse(false, 'Unable to create faq !', 'admin.faq.create');
        }
        DB::commit();
        return $this->formatResponse(true, 'faq has been created successfully !', 'admin.faq.list',$faq->PK_NO);
    }

     public function putUpdate($request)
    {
        DB::beginTransaction();
        try {
            $faq                   = Faq::findOrFail($request->id);
            $faq->title            = $request->title;
            $faq->body             = $request->body;
            $faq->is_active        = $request->is_active;
            $faq->order_id         = $request->order_id;
            $faq->updated_by       = Auth::user()->id;
            $faq->updated_at       = date('Y-m-d H:i:s');
            $faq->save();
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            return $this->formatResponse(false, 'Unable to create faq !', 'admin.faq.edit',$request->id);
        }
        DB::commit();
        return $this->formatResponse(true, 'faq has been updated !', 'admin.faq.list',$faq->PK_NO);
    }

    public function getDelete(int $id)
    {
        DB::begintransaction();
        try {
            $faq = Faq::find($id)->delete();
        } catch (\Exception $e) {
            dd($e->getMessage());

            DB::rollback();
            return $this->formatResponse(false, 'Unable to delete faq !', 'admin.faq.list');
        }
        DB::commit();
        return $this->formatResponse(true, 'Successfully delete faq !', 'admin.faq.list');
    }


}
