<?php

namespace App\Http\Controllers;

use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurController extends Controller
{
    public function index()
    {
        $auteurs = Auteur::withCount('livres')->orderBy('nom')->paginate(20);
        return view('auteurs.index', compact('auteurs'));
    }

    public function create()
    {
        return view('auteurs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255|unique:auteurs,nom',
        ]);
        $auteur = Auteur::create($data);
        return redirect()->route('auteurs.show', $auteur)->with('success', 'Auteur créé.');
    }

    public function show(Auteur $auteur)
    {
        $livres = $auteur->livres()->orderBy('titre')->paginate(20);
        return view('auteurs.show', compact('auteur','livres'));
    }

    public function edit(Auteur $auteur)
    {
        return view('auteurs.edit', compact('auteur'));
    }

    public function update(Request $request, Auteur $auteur)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255|unique:auteurs,nom,'.$auteur->id,
        ]);
        $auteur->update($data);
        return redirect()->route('auteurs.show', $auteur)->with('success', 'Auteur mis à jour.');
    }

    public function destroy(Auteur $auteur)
    {
        // Si tu veux empêcher la suppression s'il a des livres, vérifie ici.
        $auteur->delete();
        return redirect()->route('auteurs.index')->with('success', 'Auteur supprimé.');
    }
}
