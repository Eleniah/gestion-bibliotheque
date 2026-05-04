@extends('base')

@section('main')

    <style>
        .scan-title {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .scan-card {
            border-radius: 18px;
            padding: 1.8rem 2rem;
            background: radial-gradient(circle at top left, rgba(148, 163, 184, .22), transparent 60%),
                rgba(15, 23, 42, 0.96);
            border: 1px solid rgba(148, 163, 184, .5);
            box-shadow: 0 18px 40px rgba(15, 23, 42, .8);
        }

        .scan-input {
            background-color: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(148, 163, 184, .7);
            color: #e5e7eb;
            font-size: 1.1rem;
            padding-top: .7rem;
            padding-bottom: .7rem;
        }

        .scan-input:focus {
            background-color: rgba(15, 23, 42, 0.98);
            border-color: #f97316;
            box-shadow: 0 0 0 0.15rem rgba(249, 115, 22, .35);
            color: #e5e7eb;
        }

        .btn-scan-submit {
            border-radius: 999px;
            padding: .6rem 1.6rem;
            font-weight: 500;
            background: linear-gradient(90deg, #d0ac85ff, #f97316);
            border: none;
            color: #ffffff;
            box-shadow: 0 10px 25px rgba(236, 72, 153, .45);
            transition: transform .15s ease,
                box-shadow .15s ease,
                filter .15s ease;
            text-decoration: none !important;
            width: 100%;
        }

        .btn-scan-submit:hover {
            filter: brightness(1.05);
            transform: translateY(-2px);
            box-shadow: 0 14px 35px rgba(236, 72, 153, .6);
            color: #ffffff;
            text-decoration: none !important;
        }

    </style>

    <div class="row justify-content-center">
        <div class="col-12 text-center mb-3">
            <div class="metric-title">
                Scan d’un livre
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="scan-card">

                <div class="scan-title">
                    <h2 class="h5 mb-1">Scanner un code-barres</h2>
                </div>


                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('livres.scan.handle') }}" id="scan-form">
                    @csrf

                    <div class="mb-3">
                        <input class="form-control scan-input" name="code" id="code" autofocus
                            placeholder="Code-barres du livre">
                    </div>

                    <button type="submit" class="btn-scan-submit">
                        Rechercher
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('code');
            const form = document.getElementById('scan-form');

            if (!input || !form) return;

            // Focus auto au chargement
            input.focus();

            // Auto-submit après un petit délai sans frappe (utile si le scanner n’envoie pas "Entrée")
            let timer = null;
            input.addEventListener('input', () => {
                if (timer) clearTimeout(timer);

                const value = input.value.trim();
                if (!value.length) return;

                // déclenche la soumission 400ms après la fin du scan
                timer = setTimeout(() => {
                    form.submit();
                }, 400);
            });
        });
    </script>
@endpush