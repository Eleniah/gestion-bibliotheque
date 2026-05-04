<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    protected $fillable = [
        'titre','auteur_id','genre','editeur','isbn','nb_exemplaires','code_barres'
    ];

    public function emprunts()
    {
        return $this->hasMany(Emprunt::class);
    }

    // disponible = nb_exemplaires - exemplaires en cours d'emprunt
    public function disponibles(): int
    {
        $enCours = $this->emprunts()->whereNull('date_retour_reelle')->count();
        return max(0, $this->nb_exemplaires - $enCours);
    }

    public function author()   // nom "author" pour éviter le conflit avec la colonne string "auteur"
    {
        return $this->belongsTo(Auteur::class, 'auteur_id');
    }
}

