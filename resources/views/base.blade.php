<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bibliothèque — Laravel</title>

    {{-- Ton CSS compilé (si tu en as) --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Style global (thème + dashboard) --}}
    <style>
        :root {
            --text-soft: #e5e7eb;
            --text-muted: #9ca3af;
        }

        /* FOND GLOBAL */
        body {
            background:
                radial-gradient(1200px 600px at 80% -20%, rgba(250, 222, 96, 0.2), transparent 60%),
                radial-gradient(1200px 600px at -20% 110%, rgba(37, 117, 252, .18), transparent 60%),
                linear-gradient(180deg, #405b9bff, #929fbbff);
            color: var(--text-soft);
            min-height: 100vh;
            padding-top: 72px; /* pour la navbar fixe */
        }

        /* NAVBAR */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            background-color: #1a253cff; /* fond uni */
            box-shadow: 0 10px 30px rgba(15, 23, 42, .5);
        }

        .navbar-brand {
            font-size: 0.95rem;
        }

        .brand-badge {
            background: rgba(255, 255, 255, .15);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 12px;
            padding: .25rem .5rem;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .nav-link {
            color: #eef2ff !important;
            opacity: .85;
            text-decoration: none !important;

            text-transform: uppercase;
            letter-spacing: .12em;
            font-size: .85rem;
            font-weight: 600;
        }

        .nav-link.active,
        .nav-link:hover {
            opacity: 1;
            text-shadow: 0 0 6px rgba(255, 255, 255, .2);
        }

        .container-page {
            padding-top: 1.5rem;
            padding-bottom: 3rem;
        }

        /* CARTES (dashboard & blocs) */
        .glass-card {
            background: radial-gradient(circle at top left, rgba(148, 163, 184, .18), transparent 55%),
                linear-gradient(180deg, rgba(36, 53, 97, 0.96), rgba(22, 34, 62, 0.92));
            border: 1px solid rgba(148, 163, 184, .35);
            border-radius: 18px;
            box-shadow: 0 16px 40px rgba(15, 23, 42, .7);
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }

        .glass-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 22px 60px rgba(15, 23, 42, .9);
            border-color: rgba(129, 140, 248, .9);
        }

        .metric {
            font-size: clamp(2.1rem, 4vw, 3.1rem);
            font-weight: 800;
            letter-spacing: .5px;
            background: linear-gradient(90deg, #ffffff, #e5e7eb);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .metric-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #f9fafb;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .metric-sub {
            font-size: .8rem;
            color: var(--text-muted);
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 0 0 rgba(34, 197, 94, .7);
            animation: pulse 1.8s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, .7);
            }

            70% {
                box-shadow: 0 0 0 14px rgba(34, 197, 94, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
            }
        }

        /* BOUTONS DASHBOARD */
        .btn-dashboard-primary,
        .btn-dashboard-ghost,
        .quick-action,
        .quick-action:hover {
            text-decoration: none !important;
        }

        .btn-dashboard-primary {
            border-radius: 999px;
            padding: .55rem 1.25rem;
            font-weight: 500;
            background-color: #3b82f6;
            border-color: #3b82f6;
            color: #ffffff;
            box-shadow: 0 10px 25px rgba(59, 130, 246, .45);
            transition: transform .15s ease, box-shadow .15s ease, background-color .15s ease, border-color .15s ease;
        }

        .btn-dashboard-primary:hover {
            background-color: #2563eb;
            border-color: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 14px 35px rgba(37, 99, 235, .55);
            color: #ffffff;
        }

        .btn-dashboard-ghost {
            border-radius: 999px;
            padding: .55rem 1.25rem;
            font-weight: 500;
            border: 1px solid #4f46e5;
            background-color: rgba(37, 99, 235, .12);
            color: #e5e7eb;
            transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease, background-color .15s ease;
        }

        .btn-dashboard-ghost:hover {
            background-color: rgba(59, 130, 246, .3);
            border-color: #818cf8;
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(37, 99, 235, .6);
            color: #f9fafb;
        }

        /* QUICK ACTIONS */
        .quick-action {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .75rem .9rem;
            border-radius: 14px;
            border: 1px solid rgba(148, 163, 184, .6);
            background: rgba(23, 36, 67, 0.9);
            color: inherit;
            transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease, background-color .15s ease;
        }

        /* icônes minimalistes, sans couleur de fond */
        .quick-action-icon {
            width: 28px;
            height: 28px;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, .9);
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            color: #e5e7eb;
        }

        .quick-action-label {
            font-size: .9rem;
            font-weight: 500;
        }

        .quick-action:hover {
            transform: translateY(-2px);
            border-color: rgba(129, 140, 248, 1);
            background-color: rgba(15, 23, 42, .98);
            box-shadow: 0 16px 40px rgba(15, 23, 42, .9);
        }

        /* TABLES */
        .table.table-striped>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: rgba(255, 255, 255, .02);
            color: inherit;
        }

        .table {
            color: #e5e7eb;
        }

        .table thead th {
            color: #cbd5e1;
            border-bottom-color: rgba(255, 255, 255, .1) !important;
        }

        .table tbody td,
        .table tbody th {
            border-top-color: rgba(255, 255, 255, .06) !important;
        }

        /* ALERTES */
        .alert {
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, .15);
            background: rgba(15, 23, 42, .9);
            color: #e2e8f0;
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand text-white fw-bold d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                <span class="brand-badge">BIBLIOTHÈQUE</span>
                <span class="d-none d-sm-inline">— GESTION</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navMain" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                           href="{{ route('dashboard') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('adherents*') ? 'active' : '' }}"
                           href="{{ route('adherents.index') }}">Adhérents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('livres*') ? 'active' : '' }}"
                           href="{{ route('livres.index') }}">Livres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('emprunts*') ? 'active' : '' }}"
                           href="{{ route('emprunts.index') }}">Emprunts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('livres.scan.form') ? 'active' : '' }}"
                           href="{{ route('livres.scan.form') }}">Scan</a>
                    </li>

                    @auth
                        <li class="nav-item d-flex align-items-center ms-lg-3">
                            <span class="text-light me-2 d-none d-sm-inline">
                                {{ Auth::user()->name }}
                            </span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-sm btn-outline-light">Déconnexion</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                               href="{{ route('login') }}">
                                Connexion
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- FLASH MESSAGES --}}
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2">
                <span class="pulse-dot"></span>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oups…</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    {{-- CONTENU --}}
    <div class="container container-page">
        @yield('main')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Hook pour scripts de page --}}
    @stack('scripts')
</body>

</html>
