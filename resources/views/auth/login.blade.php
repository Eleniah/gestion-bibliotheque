@extends('base')

@section('main')
<div class="row justify-content-center">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="glass-card p-4">
            <div class="text-center mb-4">
                <div class="metric-title mb-1">
                    Connexion
                </div>
                <div class="metric-sub">
                    Accès à l’interface de gestion
                </div>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-control"
                        required
                    >
                </div>

                <button class="btn-dashboard-primary w-100">
                    Se connecter
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
