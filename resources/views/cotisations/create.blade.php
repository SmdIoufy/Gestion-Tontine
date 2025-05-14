@extends('layouts.app')

@section('contenu')
<div class="payment-container">
    <h1 class="payment-title">Paiement de Cotisation</h1>

    @if(Session::has('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ Session::get('success') }}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="payment-form-wrapper">
        <form action="{{ route('cotisations.store') }}" method="POST" class="payment-form">
            @csrf
            <div class="form-content">
                <!-- Champ Montant -->
                <div class="form-group">
                    <label for="montant" class="form-label">
                        <i class="form-icon fas fa-coins"></i>
                        Montant (FCFA)
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-wrapper">
                        <input
                            type="number"
                            id="montant"
                            name="montant"
                            required
                            min="1000"
                            class="form-input"
                            placeholder="Entrez le montant en FCFA"
                        >
                        <i class="input-icon fas fa-money-bill-wave"></i>
                    </div>
                </div>

                <!-- Sélection moyen de paiement -->
                <div class="form-group">
                    <label for="moyen_paiement" class="form-label">
                        <i class="form-icon fas fa-credit-card"></i>
                        Moyen de paiement
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-wrapper">
                        <select
                            id="moyen_paiement"
                            name="moyen_paiement"
                            required
                            class="form-select"
                        >
                            <option value="" disabled selected>Sélectionnez un moyen</option>
                            <option value="ESPECES">ESPÈCES</option>
                            <option value="WAVE">WAVE</option>
                            <option value="OM">Orange Money</option>
                        </select>
                        <i class="input-icon fas fa-mobile-alt"></i>
                    </div>
                </div>

                <!-- Sélection de la tontine -->
                <div class="form-group">
                    <label for="idTontine" class="form-label">
                        <i class="form-icon fas fa-hand-holding-usd"></i>
                        Tontine
                        <span class="required-star">*</span>
                    </label>
                    <div class="input-wrapper">
                        <select
                            id="idTontine"
                            name="idTontine"
                            required
                            class="form-select"
                        >
                            <option value="" disabled selected>Sélectionnez une tontine</option>
                            @foreach($tontines as $tontine)
                                <option value="{{ $tontine->id }}">{{ $tontine->nom }}</option>
                            @endforeach
                        </select>
                        <i class="input-icon fas fa-money-check-alt"></i>
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <button type="submit" class="submit-button">
                    <i class="button-icon fas fa-check-circle"></i>
                    <span>Effectuer le Paiement</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    :root {
        --primary-500: #3b82f6;
        --primary-600: #2563eb;
        --primary-50: #f0f4ff;
        --primary-100: #d6e4ff;
        --primary-200: #bfdbfe;
        --gray-800: #1f2937;
        --red-500: #ef4444;
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .payment-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .payment-title {
        text-align: center;
        font-size: 2.5rem;
        margin: 4rem 0;
        background: linear-gradient(45deg, var(--primary-500), var(--primary-600));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        animation: gradientShift 3s ease infinite;
    }

    .payment-form-wrapper {
        max-width: 42rem;
        margin: 0 auto;
    }

    .payment-form {
        background: linear-gradient(145deg, #ffffff, var(--primary-50));
        padding: 2.5rem;
        border-radius: 1.5rem;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--primary-100);
        transition: transform 0.3s ease;
    }

    .payment-form:hover {
        transform: translateY(-3px);
    }

    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }

    .form-label {
        display: flex;
        align-items: center;
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 0.75rem;
    }

    .form-icon {
        color: var(--primary-600);
        margin-right: 0.75rem;
        font-size: 1.25rem;
    }

    .input-wrapper {
        position: relative;
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        font-size: 1rem;
        border: 2px solid var(--primary-200);
        border-radius: 0.75rem;
        background: white;
        transition: all 0.3s ease;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--primary-500);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary-600);
        font-size: 1.25rem;
        pointer-events: none;
    }

    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%233b82f6' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1.25rem;
    }

    .submit-button {
        width: 100%;
        padding: 1.25rem;
        background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
        color: white;
        border: none;
        border-radius: 0.75rem;
        font-size: 1.125rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        margin-top: 2.5rem;
    }

    .submit-button:hover {
        background: linear-gradient(135deg, var(--primary-600), #1d4ed8);
        transform: scale(1.02);
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
    }

    .button-icon {
        font-size: 1.5rem;
    }

    .required-star {
        color: var(--red-500);
        margin-left: 0.25rem;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    @media (max-width: 768px) {
        .payment-title {
            font-size: 2rem;
            margin: 2rem 0;
        }

        .payment-form {
            padding: 1.5rem;
        }
    }
</style>
@endsection