<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    public function building() {
        return $this->hasMany(Building::class);
    }
}
