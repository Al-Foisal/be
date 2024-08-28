<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orderProducts() {
        return $this->hasMany(OrderProduct::class);
    }

    public function getOrderStatusAttribute() {
        $status = $this->status;

        if ($status == 0) {
            return 'Cancel';
        } elseif ($status == 1) {
            return 'Pending';
        } elseif ($status = 2) {
            return 'Confirm';
        } else {
            return 'Shiped';
        }

    }
}
