@extends('admin.layouts.master')

@section('title')
    Thêm mới Sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thông tin sản phẩm</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <div>
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                                {{-- Random mã sku ra 8 chữ in hoa --}}
                                <div class="mt-3">
                                    <label for="sku" class="form-label">SKU</label>
                                    <input type="text" class="form-control" name="sku" id="sku"
                                        value="{{ strtoupper(\Str::random(8)) }}">
                                </div>
                                <div class="mt-3">
                                    <label for="price_regular" class="form-label">Price Regular</label>
                                    <input type="number" value="0" class="form-control" name="price_regular"
                                        id="price_regular">
                                </div>
                                <div class="mt-3">
                                    <label for="price_sale" class="form-label">Price Sale</label>
                                    <input type="number" value="0" class="form-control" name="price_sale"
                                        id="price_sale">
                                </div>
                                <div class="mt-3">
                                    <label for="catalogue_id" class="form-label">Catalogues</label>
                                    <select type="text" class="form-select" name="catalogue_id" id="catalogue_id">
                                        @foreach ($catalogue as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="img_thumbnail" class="form-label">Img Thumbnail</label>
                                    <input type="file" value="0" class="form-control" name="img_thumbnail"
                                        id="img_thumbnail">
                                </div>
                            </div>
                            <div class="col-md-8">
                                {{-- Làm một mảng lưu tên trường và tên màu --}}
                                <div class="row">
                                    @php
                                        $is = [
                                            'is_active' => 'primary',
                                            'is_hot_deal' => 'danger',
                                            'is_good_deal' => 'warning',
                                            'is_new' => 'success',
                                            'is_show_home' => 'info',
                                        ];
                                    @endphp

                                    @foreach ($is as $key => $color)
                                        <div class="col-md-2">
                                            <div class="form-check form-switch form-switch-{{ $color }}">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    name="{{ $key }}" value="1" id="{{ $key }}"
                                                    @if ($key == 'is_active') checked @endif>
                                                <label class="form-check-label"
                                                    for="{{ $key }}">{{ \Str::convertCase($key, MB_CASE_TITLE) }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="mt-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="2"></textarea>
                                    </div>
                                    <div class="mt-3">
                                        <label for="material" class="form-label">Material</label>
                                        <textarea class="form-control" name="material" id="material" rows="2"></textarea>
                                    </div>
                                    <div class="mt-3">
                                        <label for="user_manual" class="form-label">User Manual</label>
                                        <textarea class="form-control" name="user_manual" id="user_manual" rows="2"></textarea>
                                    </div>
                                    <div class="mt-3">
                                        <label for="content" class="form-label">Content</label>
                                        <textarea class="form-control" name="content" id="content"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Biến thể</h4>
                </div><!-- end card header -->
                <div class="card-body" style="height: 450px; overflow: scroll">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr class="text-center">
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Quanlity</th>
                                        <th>Image</th>
                                    </tr>


                                    @foreach ($size as $sizeID => $sizeName)
                                        @php($flagRowspan = true)
                                        @foreach ($colors as $colorID => $colorName)
                                            <tr class="text-center">
                                                @if ($flagRowspan)
                                                    <td style="vertical-align: middle;" rowspan="{{ count($colors) }}">
                                                        <b>{{ $sizeName }}</b>
                                                    </td>
                                                @endif
                                                @php($flagRowspan = false)

                                                <td>
                                                    <div
                                                        style="width: 50px; height: 50px; background: {{ $colorName }};">
                                                    </div>
                                                </td>
                                                {{-- làm như thế này để đóng gói được dữ liệu đẩy lên theo các size và color, gom nhóm lại, những bảng ngoại nên để như thế này --}}
                                                <td>
                                                    <input type="text" class="form-control" value="0"
                                                        name="product_variants[{{ $sizeID . '-' . $colorID }}][quatity]">
                                                </td>
                                                <td>
                                                    <input type="file" class="form-control"
                                                        name="product_variants[{{ $sizeID . '-' . $colorID }}][image]">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            {{-- viết cách nào để dùng upload được nhiều file --}}
                            <div class="col-md-4">
                                <div>
                                    <label for="gallery_1" class="form-label">Gallery 1</label>
                                    <input type="file" class="form-control" name="product_galleries[]"
                                        id="gallery_1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <label for="gallery_2" class="form-label">Gallery 2</label>
                                    <input type="file" class="form-control" name="product_galleries[]"
                                        id="gallery_2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tags</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            {{-- viết cách nào để dùng upload được nhiều file --}}
                            <div class="col-md-12">
                                <div>
                                    <label for="tags" class="form-label">Tags</label>
                                    <select class="form-control" name="tags[]" id="tags" multiple aria-label="multiple select example">
                                        <option selected>Open this select menu (multiple select option)</option>
                                        @foreach($tag as $id =>$name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div><!-- end card header -->
            </div>
        </div>
        <!--end col-->
    </div>
    </form>
@endsection

@section('script-libs')
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('content');

        function addImageGallery() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
                <div class="col-md-4" id="${id}_item">
                    <label for="${id}" class="form-label">Image</label>
                    <div class="d-flex">
                        <input type="file" class="form-control" name="product_galleries[]" id="${id}">
                        <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
                            <span class="bx bx-trash"></span>
                        </button>
                    </div>
                </div>
            `;

            $('#gallery_list').append(html);
        }

        function removeImageGallery(id) {
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();
            }
        }
    </script>
@endsection
