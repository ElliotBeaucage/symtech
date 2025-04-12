<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entretien extends Model
{
    //
    protected $fillable = [
        'f1', 'v1', 'v2', 'v3', 'v4', 'v5',
        'image',
        'building_id',
        'description',
    ];
    public function building()
{
    return $this->belongsTo(Building::class);
}
public function images()
{
    return $this->hasMany(EntretienImage::class);
}

}
