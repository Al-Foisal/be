<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model {
    use HasFactory;

    protected $guarded = [];

    public function getSliderPositionAttribute() {
        $type = $this->type;

        if ($type == 1) {
            return 'Main Slider Banner';
        } else
        if ($type == 2) {
            return 'Left Mobile Banner';
        } else
        if ($type == 3) {
            return 'Right Mobile Banner';
        } else 
        if ($type == 4) {
            return 'Category Banner';
        } else
        if ($type == 5) {
            return 'BazarMall Banner';
        } else
        if ($type == 6) {
            return 'Flash Deal Banner';
        } else
        if ($type == 7) {
            return 'Fashion Banner';
        } else
        if ($type == 8) {
            return 'Every Day Low Price Banner';
        }

    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

}
