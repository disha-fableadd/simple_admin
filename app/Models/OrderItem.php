<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
  
    use HasFactory;
    protected $primaryKey = 'oitemid';
    protected $table = 'orderitem';  
    protected $fillable = ['oid', 'pid', 'qty', 'price', 'totalprice', 'image'];

    public $timestamps = true; 
    public function order()
    {
        return $this->belongsTo(Order::class, 'oid','oid');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'pid','pid');
    }
}
