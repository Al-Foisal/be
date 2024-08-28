<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sizes() {
        return $this->belongsToMany(Size::class);
    }

    public function colors() {
        return $this->belongsToMany(Color::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function subcategory() {
        return $this->belongsTo(Subcategory::class);
    }

    public function childcategory() {
        return $this->belongsTo(Childcategory::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function ratingReviews() {
        return $this->hasMany(RatingReview::class);
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getIsActiveAttribute() {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}
