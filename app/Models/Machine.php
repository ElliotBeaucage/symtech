<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    //
    protected $fillable = ['nom','bureau', 'type', 'marque', 'modele', 'serie', 'courroie', 'filtres', 'freon', 'description', 'buildings_id', 'image'];

    public function filtre() {
        return $this->hasMany(filtre::class);
    }

        public function images()
    {
        return $this->hasMany(MachineImage::class);
    }
}
