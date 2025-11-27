<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['tracking_code', 'customer_name', 'customer_phone', 'customer_address', 'type', 'table_number', 'note', 'status', 'total'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
