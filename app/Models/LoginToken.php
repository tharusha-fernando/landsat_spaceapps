<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginToken extends Model
{
    use HasFactory;

    protected $fillable = ['token', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class); // Assuming User model is in the same namespace as this model
    }
}
