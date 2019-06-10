<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    // pour savoir qui a posté une annonce, on peut utilise user_id qu'on va rajouter dans nos migrations/database
    //une annonce est detenu par un seul utilisateur
    public function user(){
        return $this->belongTo('App\User');
    }
}
