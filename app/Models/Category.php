<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    //khai bao model truyen ten truong vao
    protected $fillable = [
        'name'
    ];
}
