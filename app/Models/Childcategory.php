<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Childcategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subcategory() {
        return $this->belongsTo(Subcategory::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getIsActiveAttribute() {
        return $this->status === 1 ? 'Active' : 'Inactive';
    }
}
