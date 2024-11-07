<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriquePersonnel extends Model
{
    use HasFactory;

    /**
     * Attributs qui peuvent être assignés en masse
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'changement',
        'date_changement',
        'type_changement',
    ];

    /**
     * Relation avec la table `users` : Un historique appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
