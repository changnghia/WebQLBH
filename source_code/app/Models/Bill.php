<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_user',
        'tenkhachhang',
        'sdt',
        'diachi',
        'soluong',
        'loinhan',
        'loai',
        'tong',
        'trangthai',
    ];
}
