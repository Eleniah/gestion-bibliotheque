@extends('base')

@section('main')

    {{-- Styles spécifiques à la fiche adhérent --}}
    <style>
        .adherent-show-card-row {
            display: flex;
            justify-content: space-between;
            gap: 1.5rem;
            padding: .6rem 0;
            border-bottom: 1px solid rgba(148, 163, 184, .35);
        }

        .adherent-show-card-row:last-child {
            border-bottom: none;
        }

        .adherent-show-label {
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #cbd5e1;
            white-space: nowrap;
        }

        .adherent-show-value {
            text-align: right;
            color: #f9fafb;
            word-break: break-word;
        }

        @media (max-width: 768px) {
            .adherent-show-card-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .adherent-show-value {
                text-align: left;
            }
        }

        .btn-adherent-edit {
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

        .btn-adherent-edit:hover {
            transform: translateY(-2px);
            background-color: rgba(35, 45, 82, 0.18);
            border-color: #f97316;
            box-shadow: 0 10px 25px rgba(15, 23, 42, .7);
            color: #f9fafb;
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
    </style>

    {{-- Titre centré --}}
    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="metric-title">
                Adhérent #{{ $adherent->id }}
            </div>
        </div>
    </div>

    {{-- Carte avec les infos --}}
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="glass-card p-4 p-md-5">

                <div class="adherent-show-card-row">
                    <div class="adherent-show-label">Prénom</div>
                    <div class="adherent-show-value">{{ $adherent->prenom }}</div>
                </div>

                <div class="adherent-show-card-row">
                    <div class="adherent-show-label">Nom</div>
                    <div class="adherent-show-value">{{ $adherent->nom }}</div>
                </div>

                <div class="adherent-show-card-row">
                    <div class="adherent-show-label">Email</div>
                    <div class="adherent-show-value">{{ $adherent->email }}</div>
                </div>

                <div class="adherent-show-card-row">
                    <div class="adherent-show-label">Créé le</div>
                    <div class="adherent-show-value">{{ $adherent->created_at }}</div>
                </div>

                <div class="adherent-show-card-row">
                    <div class="adherent-show-label">Mis à jour le</div>
                    <div class="adherent-show-value">{{ $adherent->updated_at }}</div>
                </div>

            </div>
        </div>
    </div>

    {{-- Boutons sous la carte --}}
    <div class="row mt-3">
        <div class="col-12 d-flex flex-wrap justify-content-center gap-2">
            <a href="{{ route('adherents.edit', $adherent) }}" class="btn-adherent-edit">
                Modifier l’adhérent
            </a>
            <a href="{{ route('adherents.index') }}" class="btn-adherent-back">
                ← Retour à la liste
            </a>
        </div>
    </div>
@endsection