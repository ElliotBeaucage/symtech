<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MachineImage extends Model
{
    public function entretien()
    {
        return $this->belongsTo(Entretien::class);
    }

}
