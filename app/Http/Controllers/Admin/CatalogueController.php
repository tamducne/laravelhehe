<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatalogueController extends Controller
{
    const PATH_VIEW = 'admin.catalogues.';
    const PATH_UPLOAD = 'catalogues';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Catalogues::query()->latest('id')->get();
        return view(self::PATH_VIEW.__FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW.__FUNCTION__);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //truwongf dang la file khi lay du lieu data gan except
        $data = $request->except('cover');
        //neu ton tai thì không gán còn không tồn tại thì gán = 0
        $data['is_active'] ??= 0;
        //cách xử lyws có isActive, upload file lên laravel
        if($request->hasFile('cover')){
            $data['cover'] = Storage::put(self::PATH_UPLOAD, $request->file('cover'));
        }
        //dungf querybuilder cung duoc, ma eloquent cung duoc
        Catalogues::query()->create($data);
        return redirect()->route('admin.catalogues.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Catalogues::query()->findOrFail($id);
        return view(self::PATH_VIEW.__FUNCTION__, compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Catalogues::query()->findOrFail($id);
        return view(self::PATH_VIEW.__FUNCTION__, compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = Catalogues::query()->findOrFail($id);
        //truwongf dang la file khi lay du lieu data gan except
        $data = $request->except('cover');
        //neu ton tai thì không gán còn không tồn tại thì gán = 0
        $data['is_active'] ??= 0;
        //cách xử lyws có isActive, upload file lên laravel
        if($request->hasFile('cover')){
            $data['cover'] = Storage::put(self::PATH_UPLOAD, $request->file('cover'));
        }
        //dungf querybuilder cung duoc, ma eloquent cung duoc
        //tôi ghi đè 1 cái ảnh mới lên thì tôi xóa ảnh cũ đi
        //lưu lại giá trị hiện tại của nó trước khi update
        $currentCover = $model->cover;

        $model->update($data);
        //return dữ liệu mới database về model nên thao tác lưu giá trị cũ
        //kiểm tra xem có file trong thư mục hay không, check xem có giá trị curentCover
        if ($request->hasFile('cover') && $currentCover && Storage::exists($currentCover)) {
            Storage::delete($currentCover);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $model = Catalogues::query()->findOrFail($id);
        //hàm xóa đang thực thi trong csdl, model không mất dữ liệu đi
        $model->delete($id);
        $currentCover = $model->cover;
        //kiểm tra xem có file trong thư mục hay không, check xem có giá trị curentCover
        if ($request->hasFile('cover') && $currentCover && Storage::exists($currentCover)) {
            Storage::delete($currentCover);
        }

        return back();
    }
}
