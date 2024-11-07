<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'chef_id',
    ];

    /**
     * Relation avec la table `users` pour le chef du département.
     * Un département appartient à un utilisateur (chef).
     */
    public function chef()
    {
        return $this->belongsTo(User::class, 'chef_id');
    }

    /**
     * Relation inverse : un département peut avoir plusieurs utilisateurs (membres du département).
     * Ici, un département a plusieurs utilisateurs associés à lui via `departement_id`.
     */
    public function utilisateurs()
    {
        return $this->hasMany(User::class, 'departement_id');
    }

    /**
     * Relation avec la table `absences` : un département peut avoir plusieurs absences enregistrées.
     */
    public function absences()
    {
        return $this->hasMany(Absence::class);
    }
}
