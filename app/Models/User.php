<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'poste',
        'departement_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relation avec la table `absences`
    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    // Relation avec la table `departements` : un utilisateur appartient à un département
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    /**
     * Relation inverse : un utilisateur peut être le chef de plusieurs départements
     * Chaque utilisateur peut être chef de plusieurs départements via la clé `chef_id`
     */
    public function departementsAsChef()
    {
        return $this->hasMany(Departement::class, 'chef_id');
    }

    public function historiquePersonnels()
    {
    return $this->hasMany(HistoriquePersonnel::class);
    }

}
