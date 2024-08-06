<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogues;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    const PATH_VIEW = 'admin.products.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::query()->latest('id')
        ->with(['catalogue', 'tags'])
        ->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catalogue = Catalogues::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $size = ProductSize::query()->pluck('name', 'id')->all();
        $tag = Tag::query()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('catalogue', 'colors', 'size', 'tag'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Phải làm validate ở trước
        //dữ liệu product thì bỏ qua cái variant tags và gallery
        $dataProduct = $request->except([
            'product_variants',
            'tags',
            'product_galleries',
        ]);
        $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
        $dataProduct['is_hot_deal'] = isset($dataProduct['is_hot_deal']) ? 1 : 0;
        $dataProduct['is_good_deal'] = isset($dataProduct['is_good_deal']) ? 1 : 0;
        $dataProduct['is_new'] = isset($dataProduct['is_new']) ? 1 : 0;
        $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;
        //slug là bằng tên nối với sku
        $dataProduct['slug'] = Str::slug($dataProduct['name']). '-' . $dataProduct['sku'];
        
        dd($dataProduct);
        $dataProductVariantsTmp = $request->product_variants; 
        $dataProductVariants = [];
        foreach($dataProductVariantsTmp as $key => $item){
        
        }
        $dataTags = $request->tags;
        $dataProductGalleries = $request->product_galleries;
        //trycatch để làm việc với transaction, cùng 1 lúc tạo nhiều đối tượng đảm bảo tính nhất quán toàn vẹn thì dùng transaction, đảm bảo dữ liệu kh bị sai sót, 
        //1 câu truy vấn bị lỗi như chưa hề có câu nào thực thi rollback

        try{
        }catch(Exception $exception){
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
