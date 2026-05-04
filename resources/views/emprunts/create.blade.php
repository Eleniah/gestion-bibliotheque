@extends('base')

@section('main')

    {{-- Styles spécifiques à la page "Nouvel emprunt" --}}
    <style>
        .emprunt-form-label {
            font-weight: 500;
            color: #e5e7eb;
        }

        .emprunt-form-control {
            background-color: rgba(15, 23, 42, 0.85);
            border: 1px solid rgba(148, 163, 184, .6);
            color: #e5e7eb;
        }

        .emprunt-form-control:focus {
            background-color: rgba(15, 23, 42, 0.95);
            border-color: #f97316;
            box-shadow: 0 0 0 0.15rem rgba(249, 115, 22, .35);
            color: #e5e7eb;
        }

        .btn-emprunt-submit {
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

        .btn-emprunt-submit:hover {
            filter: brightness(1.05);
            transform: translateY(-2px);
            box-shadow: 0 14px 35px rgba(236, 72, 153, .6);
            color: #ffffff;
            text-decoration: none !important;
        }

        .btn-emprunt-back {
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

        .btn-emprunt-back:hover {
            transform: translateY(-2px);
            background-color: rgba(35, 45, 82, 0.18);
            border-color: #f97316;
            box-shadow: 0 10px 25px rgba(15, 23, 42, .7);
            color: #f9fafb;
            text-decoration: none !important;
        }

        .emprunt-help-text {
            font-size: .8rem;
            color: #9ca3af;
        }
    </style>

    {{-- Titre centré --}}
    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="metric-title">
                Nouvel emprunt
            </div>
        </div>
    </div>

    {{-- Formulaire centré --}}
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="glass-card p-4 p-md-5">

                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('emprunts.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="emprunt-form-label" for="adherent_id">Adhérent</label>
                        <select class="form-select emprunt-form-control" name="adherent_id" id="adherent_id" required>
                            @foreach($adherents as $a)
                                <option value="{{ $a->id }}" {{ old('adherent_id') == $a->id ? 'selected' : '' }}>
                                    {{ $a->prenom }} {{ $a->nom }} ({{ $a->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="emprunt-form-label" for="livre_id">Livre</label>
                        <select class="form-select emprunt-form-control" name="livre_id" id="livre_id" required>
                            @foreach($livres as $l)
                                <option value="{{ $l->id }}" {{ old('livre_id', request('livre_id')) == $l->id ? 'selected' : '' }}>
                                    {{ $l->titre }} — dispo: {{ $l->disponibles() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="emprunt-form-label" for="date_retour_prevue">
                            Date de retour prévue (optionnel)
                        </label>
                        <input type="date" class="form-control emprunt-form-control" name="date_retour_prevue"
                            id="date_retour_prevue" value="{{ old('date_retour_prevue') }}">
                        <div class="emprunt-help-text mt-1">
                            Vous pouvez laisser vide si la date sera précisée plus tard.
                        </div>
                    </div>

                    <button class="btn-emprunt-submit w-100">
                        Enregistrer le prêt
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Bouton retour centré --}}
    <div class="row mt-3">
        <div class="col-12 d-flex justify-content-center">
            <a href="{{ route('emprunts.index') }}" class="btn-emprunt-back">
                ← Retour à la liste des emprunts
            </a>
        </div>
    </div>
@endsection