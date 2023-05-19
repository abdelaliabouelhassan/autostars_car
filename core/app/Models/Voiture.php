<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
class Voiture extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        "type",
        "titre",
        "description",
        "transmission",
        "marque",
        "modele",
        "nombre_places",
        "nombre_portes",
        "prix",
        "etat",
        "annee",
        "kilometrage",
        "couleur",
        "carburant",
        "specifications_moteur",
        "specifications_exterieures",
        "specifications_interieures",
        "specifications_capacites",
        "options_additionnelles",
    ];




    public function images(){
        return $this->hasMany(Image::class);
    }
}
