<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietBill extends Model
{
    use HasFactory;
    protected $fillable=[
            'id_user',
            'id_sp',
            'id_dh',
            'hinhanh',
            'tensanpham',
            'gia',
            'soluong'
    ];
}
