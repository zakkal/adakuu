<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'slug', 'badge', 'description', 'logo', 'logo_image', 'theme_color', 'is_active', 'has_warranty', 'warranty_days', 'warranty_terms'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
