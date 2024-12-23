<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $table = 'userinfo';  
    protected $primaryKey = 'uinfoid';  

    public $incrementing = true;  

    public function users()
    {
        return $this->belongsTo(Users::class, 'uid');
    }

    protected $fillable = [
        'uid', 'name', 'image', 'gender', 'contact', 'dob'
    ];
}
