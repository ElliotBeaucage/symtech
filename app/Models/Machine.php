<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    //
    public function filtre() {
        return $this->hasMany(filtre::class);
    }

        public function images()
    {
        return $this->hasMany(MachineImage::class);
    }
}
