<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamesOffline extends Model
{
    use HasFactory;
    protected $table = 'games_offline';

    public function pokemon(){
        return $this->belongsTo(Pokemon::class,"poke_id","id");
    }
    //

}
