<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';  
      protected $primaryKey = 'oid';
    protected $fillable = ['custid', 'status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class ,'custid','custid');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'oid', 'oid');  // Foreign key: 'oid', Local key: 'oid'
    }
}
