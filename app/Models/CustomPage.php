<?php
namespace App\Models;
use Illuminate\Support\Str;
use App\Traits\RepoResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use File;

class CustomPage extends Model
{
    use RepoResponse;
    protected $table        = 'custom_pages';
    public $timestamps      = false;


    public function getPaginatedList($request, int $per_page = 20)
    {
        $data = $this->orderBy('order_id','DESC')->paginate($per_page);
        return $this->formatResponse(true, '', 'admin.custom-page.list', $data);
    }
    public function getShow(int $id)
    {
        $data =  CustomPage::find($id);
        if (!empty($data)) {
            return $this->formatResponse(true, 'Data found', 'admin.custom-page.edit', $data);
        }
        return $this->formatResponse(false, 'Did not found data !', 'admin.custom-page.list', null);
    }

    public function postStore($request)
    {
        DB::beginTransaction();
        try {
            $page                   = new CustomPage();
            $page->title            = $request->title;
            if(!empty($request->url_slug)){
                $str                = strtolower($request->url_slug);
                $page->url_slug     = Str::slug($str);
            }
            else{
                $str                = strtolower($request->title);
                $page->url_slug     = Str::slug($str);
            }
            $page->display_in       = $request->display_in;
            $page->body             = $request->body;
            $page->position         = $request->position;
            $page->is_active        = $request->is_active;
            $page->order_id         = CustomPage::max('order_id')+1;
            $page->meta_keywords    = $request->meta_keywords;
            $page->meta_description = $request->meta_description;
            $page->created_by       = Auth::user()->id;
            $page->created_at       = date('Y-m-d H:i:s');
            $page->save();
        } catch (\Exception $e) {
              DB::rollback();
            return $this->formatResponse(false, 'Unable to create page !', 'admin.custom-page.create');
        }
        DB::commit();
        return $this->formatResponse(true, 'page has been created successfully !', 'admin.custom-page.list',$page->PK_NO);
    }

     public function putUpdate($request)
    {
        DB::beginTransaction();
        try {
            $page                   = CustomPage::findOrFail($request->id);
            $page->title            = $request->title;

            // if(!empty($request->url_slug)){
            //     $str                = strtolower($request->url_slug);
            //     $page->url_slug     = Str::slug($str);
            // }
            // else{
            //     $str                = strtolower($request->title);
            //     $page->url_slug     = Str::slug($str);
            // }

            $page->display_in       = $request->display_in ?? null;
            $page->body             = $request->body;
            $page->position         = $request->position ??  null;
            $page->is_active        = $request->is_active ?? 1;
            $page->order_id         = $request->order_id ?? 1;
            $page->meta_keywords    = $request->meta_keywords;
            $page->meta_description = $request->meta_description;
            $page->updated_by       = Auth::user()->id;
            $page->updated_at       = date('Y-m-d H:i:s');
            $page->save();
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            return $this->formatResponse(false, 'Unable to create page !', 'admin.custom-page.edit',$request->id);
        }
        DB::commit();
        return $this->formatResponse(true, 'page has been updated !', 'admin.custom-page.list',$page->PK_NO);
    }

    public function getDelete(int $id)
    {
        DB::begintransaction();
        try {
            // $page = CustomPage::find($id)->delete();
            $page = CustomPage::where('id',$id)->update([
                'is_active' => 0
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());

            DB::rollback();
            return $this->formatResponse(false, 'Unable to delete page !', 'admin.custom-page.list');
        }
        DB::commit();
        return $this->formatResponse(true, 'Successfully delete page !', 'admin.custom-page.list');
    }


}
