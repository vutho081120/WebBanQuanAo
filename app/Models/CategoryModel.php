<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
   use HasFactory;

   protected $table = "danhmuc";


   public function getCategoryAll()
   {
      return $this::all();
   }

   public function children()
   {
      return $this->hasMany(CategoryModel::class, 'parent_id');
   }

   public function getCategory()
   {
      return $this::with('children')->where('parent_id', 0)->get();
   }

   public function getCategoryType($slug)
   {
      return $this::where('slug', $slug)->first();
   }

   public function getParentId($id)
   {
      return $this::where('id', $id)->first()->parent_id;
   }
}
