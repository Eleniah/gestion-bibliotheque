<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdherentController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\AuteurController;

use App\Models\Adherent;
use App\Models\Livre;
use App\Models\Emprunt;

/*
|--------------------------------------------------------------------------
| Routes d'authentification
|--------------------------------------------------------------------------
*/

// Formulaire de connexion (accessible seulement si NON connecté)
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login')
    ->middleware('guest');

// Traitement du login
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest');

// Déconnexion
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


/*
|--------------------------------------------------------------------------
| Routes protégées (interface de gestion)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/', function () {
        $stats = [
            'adherents'       => Adherent::count(),
            'livres'          => Livre::count(),
            'emprunts_actifs' => Emprunt::whereNull('date_retour_reelle')->count(),
        ];
        return view('dashboard', compact('stats'));
    })->name('dashboard');

    // Ressources
    Route::resource('adherents', AdherentController::class);

    Route::resource('livres', LivreController::class)
        ->parameters(['livres' => 'livre']);

    Route::resource('emprunts', EmpruntController::class)
        ->only(['index', 'create', 'store']);

    Route::post('retours/{emprunt}', [EmpruntController::class, 'retour'])
        ->name('emprunts.retour');

    // Scan rapide (champ texte qui reçoit le code-barres scanné)
    Route::get('scan', [LivreController::class, 'scanForm'])
        ->name('livres.scan.form');

    Route::post('scan', [LivreController::class, 'scanHandle'])
        ->name('livres.scan.handle');

    // Code-barres image (PNG) pour un livre
    Route::get('livres/{livre}/barcode', [LivreController::class, 'barcode'])
        ->name('livres.barcode');

    // Auteurs (utilisés par le select dans les livres, mais pas dans la navbar)
    Route::resource('auteurs', AuteurController::class);
});
