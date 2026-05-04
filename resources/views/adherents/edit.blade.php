@extends('base')

@section('main')

    {{-- Styles spécifiques à la page "Modifier adhérent" --}}
    <style>
        .adherent-form-label {
            font-weight: 500;
            color: #e5e7eb;
        }

        .adherent-form-control {
            background-color: rgba(15, 23, 42, 0.85);
            border: 1px solid rgba(148, 163, 184, .6);
            color: #e5e7eb;
        }

        .adherent-form-control:focus {
            background-color: rgba(15, 23, 42, 0.95);
            border-color: #f97316;
            box-shadow: 0 0 0 0.15rem rgba(249, 115, 22, .35);
            color: #e5e7eb;
        }

        .btn-adherent-submit {
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

        .btn-adherent-submit:hover {
            filter: brightness(1.05);
            transform: translateY(-2px);
            box-shadow: 0 14px 35px rgba(236, 72, 153, .6);
            color: #ffffff;
            text-decoration: none !important;
        }

        .btn-adherent-back {
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

        .btn-adherent-back:hover {
            transform: translateY(-2px);
            background-color: rgba(35, 45, 82, 0.18);
            border-color: #f97316;
            box-shadow: 0 10px 25px rgba(15, 23, 42, .7);
            color: #f9fafb;
            text-decoration: none !important;
        }

        .adherent-help-text {
            font-size: .8rem;
            color: #9ca3af;
        }
    </style>

    {{-- Titre centré --}}
    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="metric-title">
                Modifier l’adhérent #{{ $adherent->id }}
            </div>
        </div>
    </div>

    {{-- Formulaire centré --}}
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="glass-card p-4 p-md-5">
                <form method="POST" action="{{ route('adherents.update', $adherent) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="prenom" class="form-label adherent-form-label">Prénom</label>
                        <input type="text" class="form-control adherent-form-control" id="prenom" name="prenom"
                            value="{{ old('prenom', $adherent->prenom) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nom" class="form-label adherent-form-label">Nom</label>
                        <input type="text" class="form-control adherent-form-control" id="nom" name="nom"
                            value="{{ old('nom', $adherent->nom) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label adherent-form-label">Email</label>
                        <input type="email" class="form-control adherent-form-control" id="email" name="email"
                            value="{{ old('email', $adherent->email) }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="mot_de_passe" class="form-label adherent-form-label">
                            Nouveau mot de passe (optionnel)
                        </label>
                        <input type="password" class="form-control adherent-form-control" id="mot_de_passe"
                            name="mot_de_passe">
                        <div class="adherent-help-text mt-1">
                            Laissez vide pour conserver le mot de passe actuel.
                        </div>
                    </div>

                    <button type="submit" class="btn-adherent-submit w-100">
                        Sauvegarder les modifications
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Bouton retour centré sous le formulaire --}}
    <div class="row mt-3">
        <div class="col-12 d-flex justify-content-center">
            <a href="{{ route('adherents.index') }}" class="btn-adherent-back">
                ← Retour à la liste des adhérents
            </a>
        </div>
    </div>
@endsection