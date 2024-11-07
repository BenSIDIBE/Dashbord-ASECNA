<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiche extends Model
{
    use HasFactory;

    // Définir les champs modifiables via "mass assignment"
    protected $fillable = ['user_id', 'description', 'date', 'type'];

    // Liste des valeurs autorisées pour le champ `type`
    const TYPES = [
        'rapport_individuel',
        'rapport_collectif',
        'rapport_trimestriel',
        'rapport_semestriel'
    ];

    // Attribuer une valeur par défaut pour le `type` lors de la création
    public static function boot()
    {
        parent::boot();

        static::creating(function ($fiche) {
            // Si le `type` n'est pas défini, le mettre par défaut à 'rapport_individuel'
            if (!$fiche->type) {
                $fiche->type = 'rapport_individuel';
            }
        });
    }

    /**
     * Définir le type de manière sécurisée
     */
    public function setTypeAttribute($value)
    {
        // Vérifier si la valeur fournie est valide
        if (in_array($value, self::TYPES)) {
            $this->attributes['type'] = $value;
        } else {
            throw new \InvalidArgumentException("Type invalide");
        }
    }

    /**
     * Relation avec la table `users` : Une fiche appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
