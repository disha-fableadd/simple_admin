<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'user';
    use HasFactory;
    protected $primaryKey = 'uid';
    public function userInfo()
    {
        return $this->hasOne(UserInfo::class, 'uid');
    }
    protected $fillable = ['email','Password'];
}
