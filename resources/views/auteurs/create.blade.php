@extends('base')

@section('main')

    {{-- Styles spécifiques à la page "Nouvel auteur" --}}
    <style>
        .auteur-form-label {
            font-weight: 500;
            color: #e5e7eb;
        }

        .auteur-form-control {
            background-color: rgba(15, 23, 42, 0.85);
            border: 1px solid rgba(148, 163, 184, .6);
            color: #e5e7eb;
        }

        .auteur-form-control:focus {
            background-color: rgba(15, 23, 42, 0.95);
            border-color: #f97316;
            box-shadow: 0 0 0 0.15rem rgba(249, 115, 22, .35);
            color: #e5e7eb;
        }

        .btn-auteur-submit {
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

        .btn-auteur-submit:hover {
            filter: brightness(1.05);
            transform: translateY(-2px);
            box-shadow: 0 14px 35px rgba(236, 72, 153, .6);
            color: #ffffff;
            text-decoration: none !important;
        }

        .btn-auteur-back {
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

        .btn-auteur-back:hover {
            transform: translateY(-2px);
            background-color: rgba(35, 45, 82, 0.18);
            border-color: #f97316;
            box-shadow: 0 10px 25px rgba(15, 23, 42, .7);
            color: #f9fafb;
            text-decoration: none !important;
        }
    </style>

    {{-- Titre centré --}}
    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="metric-title">
                Nouvel auteur
            </div>
        </div>
    </div>

    {{-- Formulaire centré --}}
    <div class="row justify-content-center">
        <div class="col-12 col-md-7 col-lg-5">
            <div class="glass-card p-4 p-md-5">
                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('auteurs.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label auteur-form-label" for="nom">Nom de l’auteur *</label>
                        <input id="nom" name="nom" type="text" class="form-control auteur-form-control"
                            value="{{ old('nom') }}" required>
                        @error('nom')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn-auteur-submit w-100">
                        Créer l’auteur
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Bouton retour centré sous le formulaire --}}
    <div class="row mt-3">
        <div class="col-12 d-flex justify-content-center">
            <a href="{{ url()->previous() }}" class="btn-auteur-back">
                ← Retour
            </a>
        </div>
    </div>
@endsection