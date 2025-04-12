<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntretienImage extends Model
{
    //
    protected $fillable = ['entretien_id', 'image_path'];

    public function entretien()
{
    return $this->belongsTo(Entretien::class);
}
}
