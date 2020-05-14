<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $table='shares';
    protected $fillable=['user_from','user_to','note_id'];
}
