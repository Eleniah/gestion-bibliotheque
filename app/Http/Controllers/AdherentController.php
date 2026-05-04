<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Adherent;

class AdherentController extends Controller
{
    public function index()
    {
        $adherents = Adherent::orderByDesc('id')->get();
        return view('adherents.index', compact('adherents'));
    }

    public function create()
    {
        return view('adherents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'           => 'required|string|max:255',
            'prenom'        => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:adherents,email',
            'mot_de_passe'  => 'required|string|min:8',
        ]);

        Adherent::create([
            'nom'          => $request->nom,
            'prenom'       => $request->prenom,
            'email'        => $request->email,
            'mot_de_passe' => Hash::make($request->mot_de_passe),
        ]);

        return redirect()->route('adherents.index')->with('success', 'Adhérent ajouté avec succès.');
    }

    /** Afficher un adhérent */
    public function show(Adherent $adherent)
    {
        return view('adherents.show', compact('adherent'));
    }

    /** Formulaire d’édition */
    public function edit(Adherent $adherent)
    {
        return view('adherents.edit', compact('adherent'));
    }

    /** Mettre à jour un adhérent */
    public function update(Request $request, Adherent $adherent)
    {
        $request->validate([
            'nom'           => 'required|string|max:255',
            'prenom'        => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:adherents,email,' . $adherent->id,
            'mot_de_passe'  => 'nullable|string|min:8', // facultatif en édition
        ]);

        $adherent->nom    = $request->nom;
        $adherent->prenom = $request->prenom;
        $adherent->email  = $request->email;

        if ($request->filled('mot_de_passe')) {
            $adherent->mot_de_passe = Hash::make($request->mot_de_passe);
        }

        $adherent->save();

        return redirect()->route('adherents.index')->with('success', 'Adhérent mis à jour.');
    }

    /** Supprimer un adhérent */
    public function destroy(Adherent $adherent)
    {
        $adherent->delete();
        return redirect()->route('adherents.index')->with('success', 'Adhérent supprimé.');
    }
}
