<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = "sanpham";

    public function getProductAll()
    {
        return $this::all();
    }

    public function getProductById($id)
    {
        return $this::where('id', $id)->first();
    }

    public function getProductByCategoryId($danhmuc_id, $id)
    {
        return $this::where('danhmuc_id', $danhmuc_id)->where('id', '!=', $id)->limit(8)->get();
    }
}