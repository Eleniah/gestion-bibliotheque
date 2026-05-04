@extends('base')

@section('main')

    {{-- Styles spécifiques à la page Livres --}}
    <style>
        .livres-header {
            margin-bottom: 1.5rem;
        }

        .btn-livre-add {
            border-radius: 999px;
            padding: .55rem 1.4rem;
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

        .btn-livre-add:hover {
            filter: brightness(1.05);
            transform: translateY(-2px);
            box-shadow: 0 14px 35px rgba(236, 72, 153, .6);
            color: #ffffff;
            text-decoration: none !important;
        }

        /* Conteneur global de la "liste" */
        .livres-list {
            border-radius: 18px;
            padding: 1rem 1rem 0.75rem;
            background: rgba(34, 46, 74, 0.86);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(148, 163, 184, .4);
            box-shadow: 0 16px 35px rgba(15, 23, 42, .4);
            margin-top: 1rem;
        }

        /* Ligne d'en-têtes */
        .livres-list-header {
            display: grid;
            grid-template-columns: 60px minmax(0, 2.1fr) minmax(0, 1.6fr) minmax(0, 1.1fr) minmax(0, 1.9fr);
            column-gap: 1.6rem;
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #e5e7eb;
            padding: 0 .25rem 0.5rem;
            border-bottom: 1px solid rgba(148, 163, 184, .4);
            margin-bottom: .5rem;
        }

        .livres-list-header span {
            opacity: .85;
        }

        /* Une "ligne" de livre */
        .livres-row {
            display: grid;
            grid-template-columns: 60px minmax(0, 2.1fr) minmax(0, 1.6fr) minmax(0, 1.1fr) minmax(0, 1.9fr);
            column-gap: 1.6rem;
            align-items: center;

            padding: .7rem .9rem;
            margin-bottom: .5rem;
            border-radius: 12px;
            background: rgba(66, 82, 122, 0.8);
            border: 1px solid rgba(148, 163, 184, .35);
            transition: transform .15s ease,
                box-shadow .15s ease,
                border-color .15s ease,
                background-color .15s ease;
        }

        .livres-row:hover {
            transform: translateY(-2px);
            background: rgba(91, 99, 127, 0.85);
            border-color: #f97316;
            box-shadow: 0 14px 30px rgba(15, 23, 42, .7);
        }

        .livres-row-id {
            font-size: .85rem;
            color: #cbd5f5;
        }

        .livres-row-title {
            font-weight: 600;
            color: #f9fafb;
        }

        .livres-row-author {
            font-size: .9rem;
            color: #e5e7eb;
        }

        .livres-row-dispo {
            font-size: .9rem;
            color: #e5e7eb;
        }

        .livres-row-actions {
            text-align: right;
            display: flex;
            justify-content: flex-end;
            flex-wrap: nowrap;
            /* <--- au lieu de wrap */
            gap: .35rem;
        }

        /* Boutons actions (mêmes codes couleur que pour les adhérents) */
        .livre-action-btn {
            border-radius: 999px;
            padding: .25rem .9rem;
            font-size: .8rem;
            font-weight: 500;
            border: 1px solid transparent;
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            gap: .25rem;
            transition: transform .12s ease,
                box-shadow .12s ease,
                border-color .12s ease,
                background-color .12s ease,
                color .12s ease;
        }

        /* Voir : neutre (fond clair) */
        .livre-action-btn--view {
            background: rgba(248, 250, 252, 0.95);
            color: #111827;
            border-color: rgba(148, 163, 184, .8);
        }

        .livre-action-btn--view:hover {
            transform: translateY(-1px);
            background: #e5e7eb;
            border-color: #f97316;
            box-shadow: 0 8px 18px rgba(15, 23, 42, .65);
            color: #111827;
        }

        /* Modifier : bleu */
        .livre-action-btn--edit {
            background: #2563eb;
            color: #f9fafb;
            border-color: #1d4ed8;
        }

        .livre-action-btn--edit:hover {
            transform: translateY(-1px);
            background: #1d4ed8;
            border-color: #f97316;
            box-shadow: 0 8px 18px rgba(15, 23, 42, .65);
            color: #f9fafb;
        }

        /* Supprimer : rouge */
        .livre-action-btn--danger {
            background: #b91c1c;
            color: #fee2e2;
            border-color: #7f1d1d;
        }

        .livre-action-btn--danger:hover {
            transform: translateY(-1px);
            background: #991b1b;
            border-color: #f97316;
            box-shadow: 0 8px 18px rgba(15, 23, 42, .7);
            color: #fee2e2;
        }

        /* Adaptation mobile */
        @media (max-width: 768px) {
            .livres-list-header {
                display: none;
            }

            .livres-row {
                grid-template-columns: 1fr;
                row-gap: .25rem;
            }

            .livres-row-actions {
                justify-content: flex-start;
            }
        }
    </style>

    {{-- En-tête + bouton --}}
    <div class="row livres-header">
        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <div class="metric-title">
                    Gestion des livres
                </div>
            </div>

            <a class="btn-livre-add" href="{{ route('livres.create') }}">
                + Ajouter un livre
            </a>
        </div>
    </div>

    {{-- Filtre auteur --}}
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <form method="GET" action="{{ route('livres.index') }}" class="mb-2">
                <label for="auteur_id" class="form-label">Filtrer par auteur</label>
                <select class="form-select" name="auteur_id" id="auteur_id" onchange="this.form.submit()">
                    <option value="">— Tous les auteurs —</option>
                    @foreach($auteurs as $auteur)
                        <option value="{{ $auteur->id }}" {{ ($selectedAuteur == $auteur->id) ? 'selected' : '' }}>
                            {{ $auteur->nom }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    {{-- Liste des livres --}}
    <div class="row">
        <div class="col-12">
            <div class="livres-list">

                {{-- En-tête des colonnes (desktop) --}}
                <div class="livres-list-header d-none d-md-grid">
                    <span>ID</span>
                    <span>Titre</span>
                    <span>Auteur</span>
                    <span>Dispo</span>
                    <span class="text-end">Actions</span>
                </div>

                @forelse($livres as $livre)
                    <div class="livres-row">
                        <div class="livres-row-id">
                            #{{ $livre->id }}
                        </div>

                        <div class="livres-row-title">
                            {{ $livre->titre }}
                        </div>

                        <div class="livres-row-author">
                            {{ optional($livre->author)->nom ?? ($livre->auteur ?? '—') }}
                        </div>

                        <div class="livres-row-dispo">
                            {{ method_exists($livre, 'disponibles') ? $livre->disponibles() : '—' }}/{{ $livre->nb_exemplaires }}
                        </div>

                        <div class="livres-row-actions">
                            <a class="livre-action-btn livre-action-btn--view" href="{{ route('livres.show', $livre) }}">
                                Voir
                            </a>
                            <a class="livre-action-btn livre-action-btn--edit" href="{{ route('livres.edit', $livre) }}">
                                Modifier
                            </a>
                            <form method="POST" action="{{ route('livres.destroy', $livre) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="livre-action-btn livre-action-btn--danger"
                                    onclick="return confirm('Supprimer ce livre ?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">
                        Aucun livre.
                    </div>
                @endforelse

            </div>

            <div class="mt-3">
                {{ $livres->appends(['auteur_id' => $selectedAuteur])->links() }}
            </div>
        </div>
    </div>
@endsection