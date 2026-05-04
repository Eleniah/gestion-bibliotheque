@extends('base')

@section('main')

    {{-- Styles spécifiques à la page Adhérents --}}
    <style>
        .adherents-header {
            margin-bottom: 1.5rem;
        }

        .btn-adherent-add {
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

        .btn-adherent-add:hover {
            filter: brightness(1.05);
            transform: translateY(-2px);
            box-shadow: 0 14px 35px rgba(236, 72, 153, .6);
            color: #ffffff;
            text-decoration: none !important;
        }

        /* Conteneur global de la "liste" */
        .adherents-list {
            border-radius: 18px;
            padding: 1rem 1rem 0.75rem;
            background: rgba(34, 46, 74, 0.86);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(148, 163, 184, .4);
            box-shadow: 0 16px 35px rgba(15, 23, 42, .4);
        }

        /* Ligne d'en-têtes  */
        .adherents-list-header {
            display: grid;
            grid-template-columns: 70px minmax(0, 1.5fr) minmax(0, 2.7fr) auto;
            column-gap: 2.5rem;
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #e5e7eb;
            padding: 0 .25rem 0.5rem;
            border-bottom: 1px solid rgba(148, 163, 184, .4);
            margin-bottom: .5rem;
        }

        .adherents-list-header span {
            opacity: .85;
        }

        /* Une "ligne" d'adhérent */
        .adherents-row {
            display: grid;
            grid-template-columns: 70px minmax(0, 1.6fr) minmax(0, 2fr) auto;
            column-gap: 1.5rem;
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

        .adherents-row:hover {
            transform: translateY(-2px);
            background: rgba(91, 99, 127, 0.85);
            border-color: #f97316;
            box-shadow: 0 14px 30px rgba(15, 23, 42, .7);
        }

        .adherents-row-id {
            font-size: .85rem;
            color: #cbd5f5;
        }

        .adherents-row-name {
            font-weight: 600;
            color: #f9fafb;
        }

        .adherents-row-email {
            font-size: .9rem;
            color: #e5e7eb;
            opacity: .9;
        }

        .adherents-row-actions {
            text-align: right;
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: .35rem;
        }

        .adherent-action-btn {
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
        .adherent-action-btn--view {
            background: rgba(248, 250, 252, 0.95);
            /* quasi blanc */
            color: #111827;
            border-color: rgba(148, 163, 184, .8);
        }

        .adherent-action-btn--view:hover {
            transform: translateY(-1px);
            background: #e5e7eb;
            border-color: #f97316;
            box-shadow: 0 8px 18px rgba(15, 23, 42, .65);
            color: #111827;
        }

        /* Modifier : bleu */
        .adherent-action-btn--edit {
            background: #2563eb;
            color: #f9fafb;
            border-color: #1d4ed8;
        }

        .adherent-action-btn--edit:hover {
            transform: translateY(-1px);
            background: #1d4ed8;
            border-color: #f97316;
            box-shadow: 0 8px 18px rgba(15, 23, 42, .65);
            color: #f9fafb;
        }

        /* Supprimer : rouge */
        .adherent-action-btn--danger {
            background: #b91c1c;
            color: #fee2e2;
            border-color: #7f1d1d;
        }

        .adherent-action-btn--danger:hover {
            transform: translateY(-1px);
            background: #991b1b;
            border-color: #f97316;
            box-shadow: 0 8px 18px rgba(15, 23, 42, .7);
            color: #fee2e2;
        }



        /* Adaptation mobile : on "pile" les colonnes */
        @media (max-width: 768px) {
            .adherents-list-header {
                display: none;
            }

            .adherents-row {
                grid-template-columns: 1fr;
                row-gap: .25rem;
            }

            .adherents-row-actions {
                justify-content: flex-start;
            }
        }
    </style>

    {{-- En-tête + bouton --}}
    <div class="row adherents-header">
        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <div class="metric-title">
                    Gestion des adhérents
                </div>
            </div>

            <a href="{{ route('adherents.create') }}" class="btn-adherent-add">
                + Ajouter un adhérent
            </a>
        </div>
    </div>

    {{-- "Tableau" moderne des adhérents --}}
    <div class="row">
        <div class="col-12">
            <div class="adherents-list">

                {{-- En-tête des colonnes (desktop) --}}
                <div class="adherents-list-header d-none d-md-grid">
                    <span>ID</span>
                    <span>Nom</span>
                    <span>Email</span>
                    <span class="text-end">Actions</span>
                </div>

                @forelse ($adherents as $adherent)
                    <div class="adherents-row">
                        <div class="adherents-row-id">
                            #{{ $adherent->id }}
                        </div>

                        <div class="adherents-row-name">
                            {{ $adherent->prenom }} {{ $adherent->nom }}
                        </div>

                        <div class="adherents-row-email">
                            {{ $adherent->email }}
                        </div>

                        <div class="adherents-row-actions">
                            <a href="{{ route('adherents.show', $adherent) }}"
                                class="adherent-action-btn adherent-action-btn--view">
                                Voir
                            </a>

                            <a href="{{ route('adherents.edit', $adherent) }}"
                                class="adherent-action-btn adherent-action-btn--edit">
                                Modifier
                            </a>

                            <form action="{{ route('adherents.destroy', $adherent) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="adherent-action-btn adherent-action-btn--danger"
                                    onclick="return confirm('Supprimer cet adhérent ?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>

                    </div>
                @empty
                    <div class="text-center text-muted py-4">
                        Aucun adhérent pour le moment.
                    </div>
                @endforelse

            </div>
        </div>
    </div>
@endsection