<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    //
    public function machine() {
        return $this->hasMany(Machine::class);
    }
    public function client()
{
    return $this->belongsTo(Client::class);
}

}
