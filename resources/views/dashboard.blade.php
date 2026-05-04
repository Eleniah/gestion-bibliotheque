@extends('base')

@section('main')
    <div class="row g-4">

        {{-- Carte 1: Adhérents --}}
        <div class="col-12 col-md-4">
            <div class="glass-card p-4 h-100">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div>
                        <div class="metric-title">ADHÉRENTS</div>
                        <div class="metric-sub">Total des utilisateurs enregistrés.</div>
                    </div>
                    <span class="pulse-dot"></span>
                </div>

                <div class="metric mb-2">{{ number_format($stats['adherents'], 0, ',', ' ') }}</div>

                <a href="{{ route('adherents.index') }}" class="btn-dashboard-ghost mt-2">
                    Gérer les adhérents
                </a>
            </div>
        </div>

        {{-- Carte 2: Livres --}}
        <div class="col-12 col-md-4">
            <div class="glass-card p-4 h-100">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div>
                        <div class="metric-title">LIVRES</div>
                        <div class="metric-sub">Catalogue total disponible.</div>
                    </div>
                    <span class="pulse-dot"></span>
                </div>

                <div class="metric mb-2">{{ number_format($stats['livres'], 0, ',', ' ') }}</div>

                <a href="{{ route('livres.index') }}" class="btn-dashboard-ghost mt-2">
                    Gérer les livres
                </a>
            </div>
        </div>

        {{-- Carte 3: Emprunts actifs --}}
        <div class="col-12 col-md-4">
            <div class="glass-card p-4 h-100">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div>
                        <div class="metric-title">EMPRUNTS ACTIFS</div>
                        <div class="metric-sub">Documents sortis non rendus.</div>
                    </div>
                    <span class="pulse-dot"></span>
                </div>

                <div class="metric mb-2">{{ number_format($stats['emprunts_actifs'], 0, ',', ' ') }}</div>

                <a href="{{ route('emprunts.index') }}" class="btn-dashboard-ghost mt-2">
                    Voir les emprunts
                </a>
            </div>
        </div>

        {{-- section actions rapides --}}
        <div class="row g-4 mt-4">
            <div class="col-12">
                <div class="glass-card p-4">
                    <div class="metric-title text-center mb-3">
                        Actions rapides
                    </div>


                    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-3">

                        <div class="col">
                            <a class="quick-action" href="{{ route('adherents.create') }}">
                                <span class="quick-action-icon">👤</span>
                                <span class="quick-action-label">Nouvel adhérent</span>
                            </a>
                        </div>

                        <div class="col">
                            <a class="quick-action" href="{{ route('livres.create') }}">
                                <span class="quick-action-icon">📗</span>
                                <span class="quick-action-label">Nouveau livre</span>
                            </a>
                        </div>

                        <div class="col">
                            <a class="quick-action" href="{{ route('emprunts.create') }}">
                                <span class="quick-action-icon">📝</span>
                                <span class="quick-action-label">Nouvel emprunt</span>
                            </a>
                        </div>

                        <div class="col">
                            <a class="quick-action" href="{{ route('livres.scan.form') }}">
                                <span class="quick-action-icon">🔍</span>
                                <span class="quick-action-label">Scan code-barres</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection