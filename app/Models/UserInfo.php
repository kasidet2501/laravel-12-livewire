<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'users_info';
    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'birthdate',
        'age',
        'profile_image',
    ];

     /**
     * Get the user's transactions
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

}
