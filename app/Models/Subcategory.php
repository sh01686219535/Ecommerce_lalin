<?php

namespace App\Models;

use App\Models\Admin\Category;
use App\Models\Admin\ChildCategory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function childCategories()
    {
        return $this->hasMany(ChildCategory::class, 'subCategory_id');
    }
}
