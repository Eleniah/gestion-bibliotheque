<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Auteur;
use App\Models\Emprunt;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorPNG;

class LivreController extends Controller
{
    /**
     * Display a listing of the resource.
     * Filtre optionnel par auteur_id.
     */
    public function index(Request $request)
    {
        $query = Livre::with('author')->orderBy('id', 'desc'); // charge l'auteur

        $auteurs = Auteur::orderBy('nom')->get();
        $selectedAuteur = $request->input('auteur_id');

        if ($selectedAuteur) {
            $query->where('auteur_id', $selectedAuteur);
        }

        $livres = $query->paginate(15);

        return view('livres.index', compact('livres', 'auteurs', 'selectedAuteur'));
    }

    /**
     * Show the form for creating a new resource.
     * -> on envoie la liste des auteurs pour le <select>.
     */
    public function create()
    {
        $auteurs = \App\Models\Auteur::orderBy('nom')->get();
        return view('livres.create', compact('auteurs'));
    }

    /**
     * Store a newly created resource in storage.
     * -> on valide auteur_id (FK) au lieu de 'auteur' (string).
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur_id' => 'required|exists:auteurs,id',   // ✅
            'genre' => 'nullable|string|max:255',
            'editeur' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:50|unique:livres,isbn',
            'nb_exemplaires' => 'required|integer|min:1',
        ]);

        // code-barres: ISBN si présent, sinon un code interne
        $data['code_barres'] = $request->isbn
            ? $request->isbn
            : ('LIV' . str_pad((string) (Livre::max('id') + 1), 8, '0', STR_PAD_LEFT));

        $livre = Livre::create($data);

        return redirect()->route('livres.show', $livre)->with('success', 'Livre créé.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Livre $livre)
    {
        $livre->load('author');
        return view('livres.show', compact('livre'));
    }

    /**
     * Show the form for editing the specified resource.
     * -> on envoie la liste des auteurs pour le <select>.
     */
    public function edit(Livre $livre)
    {
        $auteurs = Auteur::orderBy('nom')->get();
        return view('livres.edit', compact('livre', 'auteurs'));
    }

    /**
     * Update the specified resource in storage.
     * -> on valide auteur_id (FK).
     */
    public function update(Request $request, Livre $livre)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur_id' => 'required|exists:auteurs,id',   // ✅
            'genre' => 'nullable|string|max:255',
            'editeur' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:50|unique:livres,isbn,' . $livre->id,
            'nb_exemplaires' => 'required|integer|min:1',
        ]);

        // Si jamais pas de code_barres et pas d'ISBN, on en génère un
        if (!$livre->code_barres && empty($data['isbn'])) {
            $data['code_barres'] = 'LIV' . str_pad((string) $livre->id, 8, '0', STR_PAD_LEFT);
        }

        $livre->update($data);

        return redirect()->route('livres.index')->with('success', 'Livre mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livre $livre)
    {
        $livre->delete();
        return back()->with('success', 'Livre supprimé.');
    }

    // Générer l'image PNG du code-barres
    public function barcode(Livre $livre)
    {
        $generator = new BarcodeGeneratorPNG();
        $png = $generator->getBarcode($livre->code_barres, $generator::TYPE_CODE_128, 2, 60);
        return response($png)->header('Content-Type', 'image/png');
    }

    // Formulaire de scan (lecteur USB -> input text)
    public function scanForm()
    {
        return view('livres.scan');
    }

    // Scan: recherche par code_barres OU ISBN
    public function scanHandle(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        $code = trim($request->code);

        $livre = Livre::where('code_barres', $code)
            ->orWhere('isbn', $code)
            ->first();

        return $livre
            ? redirect()->route('livres.show', $livre)
            : back()->withErrors(['code' => 'Code-barres/ISBN inconnu.'])->withInput();
    }
}
