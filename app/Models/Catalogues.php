<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogues extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cover',
        'is_active',
    ];
    //chuyển đổi ép kiểu dữ liệu
    protected $casts = [
        'is_active' => 'boolean',
        //nếu truyền vào là true, false, 0, 1 tự động chuyển về 0 hoặc 1 trong csdl

    ];

    public function products(){
        return $this->Hasmany(Product::class);
    }

    public function product(){
        return $this->hasOne(Product::class);
    }
}
