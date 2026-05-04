@extends('base')

@section('main')

  {{-- Styles spécifiques à la page "Nouveau livre" --}}
  <style>
    .livre-form-label {
      font-weight: 500;
      color: #e5e7eb;
    }

    .livre-form-control {
      background-color: rgba(15, 23, 42, 0.85);
      border: 1px solid rgba(148, 163, 184, .6);
      color: #e5e7eb;
    }

    .livre-form-control:focus {
      background-color: rgba(15, 23, 42, 0.95);
      border-color: #f97316;
      box-shadow: 0 0 0 0.15rem rgba(249, 115, 22, .35);
      color: #e5e7eb;
    }

    .btn-livre-submit {
      border-radius: 999px;
      padding: .6rem 1.4rem;
      font-weight: 500;
      background: linear-gradient(90deg, #d0ac85ff, #f97316);
      border: none;
      color: #ffffff;
      box-shadow: 0 10px 25px rgba(236, 72, 153, .45);
      transition: transform .15s ease,
        box-shadow .15s ease,
        filter .15s ease;
      text-decoration: none !important;
    }

    .btn-livre-submit:hover {
      filter: brightness(1.05);
      transform: translateY(-2px);
      box-shadow: 0 14px 35px rgba(236, 72, 153, .6);
      color: #ffffff;
      text-decoration: none !important;
    }

    .btn-livre-back {
      border-radius: 999px;
      padding: .5rem 1.4rem;
      font-weight: 500;
      border: 1px solid rgba(248, 250, 252, .85);
      background: rgba(15, 23, 42, 0.7);
      color: #f9fafb;
      text-decoration: none !important;
      transition: transform .15s ease,
        box-shadow .15s ease,
        border-color .15s ease,
        background-color .15s ease;
    }

    .btn-livre-back:hover {
      transform: translateY(-2px);
      background-color: rgba(35, 45, 82, 0.18);
      border-color: #f97316;
      box-shadow: 0 10px 25px rgba(15, 23, 42, .7);
      color: #f9fafb;
      text-decoration: none !important;
    }

    .livre-help-text {
      font-size: .8rem;
      color: #9ca3af;
    }

    .btn-auteur-add {
      border-radius: 999px;
      padding: .4rem .85rem;
      font-weight: 600;
      border: 1px solid rgba(248, 250, 252, .85);
      background: rgba(15, 23, 42, 0.8);
      color: #f9fafb;
      text-decoration: none !important;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: transform .12s ease,
        box-shadow .12s ease,
        border-color .12s ease,
        background-color .12s ease;
    }

    .btn-auteur-add:hover {
      transform: translateY(-1px);
      border-color: #f97316;
      background-color: rgba(35, 45, 82, 0.95);
      box-shadow: 0 10px 22px rgba(15, 23, 42, .8);
      color: #f9fafb;
    }
  </style>

  {{-- Titre centré --}}
  <div class="row mb-4">
    <div class="col-12 text-center">
      <div class="metric-title">
        Nouveau livre
      </div>
    </div>
  </div>

  {{-- Formulaire centré --}}
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
      <div class="glass-card p-4 p-md-5">
        <form method="POST" action="{{ route('livres.store') }}">
          @csrf

          <div class="mb-3">
            <label class="form-label livre-form-label" for="titre">Titre *</label>
            <input id="titre" name="titre" type="text" class="form-control livre-form-control" value="{{ old('titre') }}"
              required autofocus>
            @error('titre')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label livre-form-label" for="auteur_id">Auteur *</label>
            <div class="d-flex gap-2">
              <select id="auteur_id" name="auteur_id" class="form-select livre-form-control" required>
                <option value="">— Sélectionner —</option>
                @foreach($auteurs as $a)
                  <option value="{{ $a->id }}" {{ old('auteur_id') == $a->id ? 'selected' : '' }}>
                    {{ $a->nom }}
                  </option>
                @endforeach
              </select>

              <a class="btn-auteur-add" href="{{ route('auteurs.create') }}" title="Ajouter un auteur">
                +
              </a>
            </div>
            @error('auteur_id')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label livre-form-label" for="genre">Genre</label>
            <input id="genre" name="genre" type="text" class="form-control livre-form-control" value="{{ old('genre') }}">
          </div>

          <div class="mb-3">
            <label class="form-label livre-form-label" for="editeur">Éditeur</label>
            <input id="editeur" name="editeur" type="text" class="form-control livre-form-control"
              value="{{ old('editeur') }}">
          </div>

          <div class="mb-3">
            <label class="form-label livre-form-label" for="isbn">ISBN (optionnel)</label>
            <input id="isbn" name="isbn" type="text" class="form-control livre-form-control" value="{{ old('isbn') }}">
            <div class="livre-help-text mt-1">
              S’il est vide, un code-barres interne sera généré.
            </div>
          </div>

          <div class="mb-4">
            <label class="form-label livre-form-label" for="nb_exemplaires">
              Nombre d’exemplaires *
            </label>
            <input id="nb_exemplaires" name="nb_exemplaires" type="number" min="1" class="form-control livre-form-control"
              value="{{ old('nb_exemplaires', 1) }}" required>
            @error('nb_exemplaires')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <button class="btn-livre-submit w-100">
            Enregistrer le livre
          </button>
        </form>
      </div>
    </div>
  </div>

  {{-- Bouton retour centré sous le formulaire --}}
  <div class="row mt-3">
    <div class="col-12 d-flex justify-content-center">
      <a href="{{ route('livres.index') }}" class="btn-livre-back">
        ← Retour à la liste des livres
      </a>
    </div>
  </div>
@endsection