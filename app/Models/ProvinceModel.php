<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinceModel extends Model
{
    use HasFactory;

    protected $table = "tinh";

    public function getProvinceName($id)
    {
        return $this::find($id)->province_name;
    }
}
