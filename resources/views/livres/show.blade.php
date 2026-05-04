@extends('base')

@section('main')

    <style>
        .livre-show-card {
            border-radius: 18px;
            padding: 1.8rem 2rem;
            background: radial-gradient(circle at top left, rgba(148, 163, 184, .22), transparent 60%),
                rgba(15, 23, 42, 0.96);
            border: 1px solid rgba(148, 163, 184, .5);
            box-shadow: 0 18px 40px rgba(15, 23, 42, .8);
        }

        .livre-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #f9fafb;
        }

        .livre-subtitle {
            font-size: .9rem;
            color: #e5e7eb;
            opacity: .9;
        }

        .livre-show-row {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            padding: .6rem 0;
            border-bottom: 1px solid rgba(148, 163, 184, .35);
        }

        .livre-show-row:last-of-type {
            border-bottom: none;
        }

        .livre-show-label {
            font-size: .85rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #9ca3af;
        }

        .livre-show-value {
            font-size: .95rem;
            color: #e5e7eb;
            text-align: right;
            white-space: nowrap;
        }

        .livre-barcode-block {
            margin-top: 1.2rem;
            padding-top: 1rem;
            border-top: 1px dashed rgba(148, 163, 184, .45);
            text-align: center;
        }

        .livre-barcode-label {
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .14em;
            color: #9ca3af;
            margin-bottom: .4rem;
        }

        .livre-barcode-code {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: .9rem;
            color: #e5e7eb;
            margin-bottom: .4rem;
        }

        .livre-barcode-img {
            background: #ffffff;
            padding: .35rem .6rem;
            border-radius: 10px;
            display: inline-block;
        }

        .btn-livre-edit {
            border-radius: 999px;
            padding: .45rem 1.3rem;
            font-weight: 500;
            background: linear-gradient(90deg, #d0ac85ff, #f97316);
            border: none;
            color: #ffffff;
            box-shadow: 0 10px 25px rgba(236, 72, 153, .45);
            transition: transform .15s ease,
                box-shadow .15s ease,
                filter .15s ease;
            text-decoration: none !important;
            white-space: nowrap;
        }

        .btn-livre-edit:hover {
            filter: brightness(1.05);
            transform: translateY(-2px);
            box-shadow: 0 14px 35px rgba(236, 72, 153, .6);
            color: #ffffff;
            text-decoration: none !important;
        }

        .btn-livre-back {
            border-radius: 999px;
            padding: .5rem 1.6rem;
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

        /* Nouveau bouton : faire un emprunt */
        .btn-livre-emprunt {
            border-radius: 999px;
            padding: .45rem 1.3rem;
            font-weight: 500;
            background: #16a34a;
            /* vert */
            border: 1px solid #15803d;
            color: #f9fafb;
            box-shadow: 0 10px 25px rgba(22, 163, 74, .45);
            transition: transform .15s ease,
                box-shadow .15s ease,
                border-color .15s ease,
                filter .15s ease;
            text-decoration: none !important;
            white-space: nowrap;
        }

        .btn-livre-emprunt:hover {
            filter: brightness(1.05);
            transform: translateY(-2px);
            background: #15803d;
            border-color: #f97316;
            box-shadow: 0 14px 35px rgba(22, 163, 74, .65);
            color: #f9fafb;
            text-decoration: none !important;
        }

        @media (max-width: 768px) {
            .livre-show-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .livre-show-value {
                text-align: left;
                white-space: normal;
            }
        }
    </style>

    {{-- Titre de section --}}
    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="metric-title">
                Fiche du livre
            </div>
        </div>
    </div>

    {{-- Carte principale --}}
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="livre-show-card">

                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                    <div>
                        <h1 class="livre-title">{{ $livre->titre }}</h1>
                        <div class="livre-subtitle">
                            {{ optional($livre->author)->nom ?? ($livre->auteur ?? 'Auteur inconnu') }}
                        </div>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <a href="{{ route('livres.edit', $livre) }}" class="btn-livre-edit">
                            Modifier le livre
                        </a>

                        {{-- Bouton pour créer directement un emprunt pour ce livre --}}
                        <a href="{{ route('emprunts.create', ['livre_id' => $livre->id]) }}" class="btn-livre-emprunt">
                            Faire un emprunt
                        </a>
                    </div>
                </div>

                <div class="livre-show-row">
                    <span class="livre-show-label">Genre</span>
                    <span class="livre-show-value">{{ $livre->genre ?? '—' }}</span>
                </div>

                <div class="livre-show-row">
                    <span class="livre-show-label">Éditeur</span>
                    <span class="livre-show-value">{{ $livre->editeur ?? '—' }}</span>
                </div>

                <div class="livre-show-row">
                    <span class="livre-show-label">ISBN</span>
                    <span class="livre-show-value">{{ $livre->isbn ?? '—' }}</span>
                </div>

                <div class="livre-show-row">
                    <span class="livre-show-label">Exemplaires</span>
                    <span class="livre-show-value">
                        @if(method_exists($livre, 'disponibles'))
                            {{ $livre->disponibles() }}/{{ $livre->nb_exemplaires }}
                        @else
                            {{ $livre->nb_exemplaires }}
                        @endif
                    </span>
                </div>

                <div class="livre-barcode-block">
                    <div class="livre-barcode-label">Code-barres</div>
                    <div class="livre-barcode-code">{{ $livre->code_barres }}</div>
                    <div class="livre-barcode-img">
                        <img alt="Code-barres du livre" src="{{ route('livres.barcode', $livre) }}">
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Bouton retour --}}
    <div class="row mt-3">
        <div class="col-12 d-flex justify-content-center">
            <a class="btn-livre-back" href="{{ route('livres.index') }}">
                ← Retour à la liste des livres
            </a>
        </div>
    </div>

@endsection