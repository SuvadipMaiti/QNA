<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public  function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getAvatarAttribute($avatar)
    {
        return asset('uploads/images/'.$avatar);
    }
}
