<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','description'];
    protected $primaryKey = 'cid'; 
    public function products()
    {
        return $this->hasMany(Product::class, 'cid', 'cid');
    }
}
