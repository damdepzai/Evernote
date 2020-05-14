<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Note extends Model
{
    protected $table='notes';
    protected $fillable=['title','content','create_by','update_by'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function shares(){
        return $this->hasMany(Share::class);
    }

}
