@extends('base')

@section('main')

    {{-- Styles spécifiques à la page Emprunts --}}
    <style>
        .emprunts-header {
            margin-bottom: 1.5rem;
        }

        .btn-emprunt-add {
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

        .btn-emprunt-add:hover {
            filter: brightness(1.05);
            transform: translateY(-2px);
            box-shadow: 0 14px 35px rgba(236, 72, 153, .6);
            color: #ffffff;
            text-decoration: none !important;
        }

        /* Conteneur global de la "liste" */
        .emprunts-list {
            border-radius: 18px;
            padding: 1rem 1rem 0.75rem;
            background: rgba(34, 46, 74, 0.86);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(148, 163, 184, .4);
            box-shadow: 0 16px 35px rgba(15, 23, 42, .4);
        }

        /* Ligne d'en-têtes */
        .emprunts-list-header {
            display: grid;
            grid-template-columns: 60px minmax(0, 1.5fr) minmax(0, 2fr) minmax(0, 1.1fr) minmax(0, 1.1fr) minmax(0, 1.1fr) minmax(0, 1.4fr);
            column-gap: 1.4rem;
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #e5e7eb;
            padding: 0 .25rem 0.5rem;
            border-bottom: 1px solid rgba(148, 163, 184, .4);
            margin-bottom: .5rem;
        }

        .emprunts-list-header span {
            opacity: .85;
        }

        /* Une "ligne" d'emprunt */
        .emprunts-row {
            display: grid;
            grid-template-columns: 60px minmax(0, 1.5fr) minmax(0, 2fr) minmax(0, 1.1fr) minmax(0, 1.1fr) minmax(0, 1.1fr) minmax(0, 1.4fr);
            column-gap: 1.4rem;
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

        .emprunts-row:hover {
            transform: translateY(-2px);
            background: rgba(91, 99, 127, 0.85);
            border-color: #f97316;
            box-shadow: 0 14px 30px rgba(15, 23, 42, .7);
        }

        .emprunts-row-id {
            font-size: .85rem;
            color: #cbd5f5;
        }

        .emprunts-row-adherent {
            font-weight: 600;
            color: #f9fafb;
        }

        .emprunts-row-livre {
            font-size: .9rem;
            color: #e5e7eb;
        }

        .emprunts-row-date {
            font-size: .85rem;
            color: #e5e7eb;
        }

        .emprunts-row-actions {
            text-align: right;
            display: flex;
            justify-content: flex-end;
            flex-wrap: nowrap;
            gap: .35rem;
        }

        /* Bouton "Enregistrer le retour" */
        .emprunt-action-btn-return {
            border-radius: 999px;
            padding: .25rem .9rem;
            font-size: .8rem;
            font-weight: 500;
            border: 1px solid #16a34a;
            background: #16a34a;
            color: #f9fafb;
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform .12s ease,
                box-shadow .12s ease,
                border-color .12s ease,
                background-color .12s ease,
                color .12s ease;
            white-space: nowrap;
        }

        .emprunt-action-btn-return:hover {
            transform: translateY(-1px);
            background: #15803d;
            border-color: #f97316;
            box-shadow: 0 8px 18px rgba(15, 23, 42, .75);
            color: #f9fafb;
        }

        /* Tag "Terminé" */
        .emprunt-tag-termine {
            border-radius: 999px;
            padding: .25rem .8rem;
            font-size: .8rem;
            background: rgba(22, 163, 74, 0.12);
            border: 1px solid rgba(22, 163, 74, .8);
            color: #bbf7d0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
        }

        /* Adaptation mobile */
        @media (max-width: 768px) {
            .emprunts-list-header {
                display: none;
            }

            .emprunts-row {
                grid-template-columns: 1fr;
                row-gap: .25rem;
            }

            .emprunts-row-actions {
                justify-content: flex-start;
            }
        }
    </style>

    {{-- En-tête + bouton --}}
    <div class="row emprunts-header">
        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <div class="metric-title">
                    Gestion des emprunts
                </div>
            </div>

            <a class="btn-emprunt-add" href="{{ route('emprunts.create') }}">
                + Nouvel emprunt
            </a>
        </div>
    </div>

    {{-- Liste des emprunts --}}
    <div class="row">
        <div class="col-12">
            <div class="emprunts-list">

                {{-- En-tête des colonnes (desktop) --}}
                <div class="emprunts-list-header d-none d-md-grid">
                    <span>#</span>
                    <span>Adhérent</span>
                    <span>Livre</span>
                    <span>Sortie</span>
                    <span>Retour prévu</span>
                    <span>Retour</span>
                    <span class="text-end">Actions</span>
                </div>

                @forelse($emprunts as $e)
                    <div class="emprunts-row">
                        <div class="emprunts-row-id">
                            #{{ $e->id }}
                        </div>

                        <div class="emprunts-row-adherent">
                            {{ $e->adherent->prenom }} {{ $e->adherent->nom }}
                        </div>

                        <div class="emprunts-row-livre">
                            {{ $e->livre->titre }}
                        </div>

                        <div class="emprunts-row-date">
                            {{ $e->date_emprunt }}
                        </div>

                        <div class="emprunts-row-date">
                            {{ $e->date_retour_prevue ?? '—' }}
                        </div>

                        <div class="emprunts-row-date">
                            {{ $e->date_retour_reelle ?? '—' }}
                        </div>

                        <div class="emprunts-row-actions">
                            @if(!$e->date_retour_reelle)
                                <form method="POST" action="{{ route('emprunts.retour', $e) }}">
                                    @csrf
                                    <button class="emprunt-action-btn-return">
                                        Enregistrer le retour
                                    </button>
                                </form>
                            @else
                                <span class="emprunt-tag-termine">
                                    Terminé
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">
                        Aucun emprunt pour le moment.
                    </div>
                @endforelse

            </div>

            <div class="mt-3">
                {{ $emprunts->links() }}
            </div>
        </div>
    </div>
@endsection