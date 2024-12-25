<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = 'custid';
    protected $fillable = [
        'fname',
        'lname',
        'gender',
        'contact',
        'email',
        'address',
        'city',
        'state',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class, 'custid', 'custid');
    }
}
