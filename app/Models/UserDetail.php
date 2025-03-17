<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = "user_details";
    protected $fillable = [
        "user_id",
        'photo',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
