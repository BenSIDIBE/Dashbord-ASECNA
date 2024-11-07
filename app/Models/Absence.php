<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    // La table associée au modèle
    protected $table = 'absences';

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'user_id',
        'type',
        'date_debut',
        'date_fin',
    ];

    // Relation avec le modèle `User`
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
