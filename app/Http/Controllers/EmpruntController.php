<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Adherent;
use App\Models\Livre;
use Illuminate\Http\Request;

class EmpruntController extends Controller
{
    public function index() {
        $emprunts = Emprunt::with(['adherent','livre'])->orderByDesc('id')->paginate(20);
        return view('emprunts.index', compact('emprunts'));
    }

    public function create() {
        return view('emprunts.create', [
            'adherents' => Adherent::orderBy('prenom')->get(),
            'livres'    => Livre::orderBy('titre')->get(),
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'adherent_id' => 'required|exists:adherents,id',
            'livre_id'    => 'required|exists:livres,id',
            'date_retour_prevue' => 'nullable|date',
        ]);

        $livre = Livre::findOrFail($data['livre_id']);
        if ($livre->disponibles() < 1) {
            return back()->withErrors(['livre_id' => 'Aucun exemplaire disponible.'])->withInput();
        }

        Emprunt::create([
            'adherent_id' => $data['adherent_id'],
            'livre_id'    => $livre->id,
            'date_emprunt' => now()->toDateString(),
            'date_retour_prevue' => $data['date_retour_prevue'] ?? null,
        ]);

        return redirect()->route('emprunts.index')->with('success','Emprunt enregistré.');
    }

    // Marquer un retour
    public function retour(Emprunt $emprunt) {
        if (is_null($emprunt->date_retour_reelle)) {
            $emprunt->update(['date_retour_reelle' => now()->toDateString()]);
        }
        return back()->with('success','Retour enregistré.');
    }
}

