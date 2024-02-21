<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictModel extends Model
{
    use HasFactory;

    protected $table = "huyen";

    public function getDistrict($id)
    {
        return $this::where('province_id', $this::find($id)->province_id)->get();
    }

    public function getDistrictName($id)
    {
        return $this::find($id)->district_name;
    }
}
