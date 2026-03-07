<?php
namespace App\Models\Admin;

use App\Models\Admin\ChildCategory as AdminChildCategory;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    // Category -> Subcategory
    public function subCategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }

    // Category -> ChildCategory
    public function childCategories()
    {
        return $this->hasMany(AdminChildCategory::class, 'category_id');
    }
}