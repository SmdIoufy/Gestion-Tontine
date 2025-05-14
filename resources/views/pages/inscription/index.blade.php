@extends('layouts.app')
@section('contenu')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card shadow-lg border-0 rounded-lg mt-5 overflow-hidden">
                <div class="card-header bg-gradient-primary text-white py-4">
                    <h3 class="text-center mb-0 display-6 fw-bold" style="color: #4e73df;">
                        <i class="fas fa-user-plus me-2"></i><span style="color: #4e73df; font-weight: bold;">Création de compte</span>
                    </h3>
                </div>

                <div class="card-body p-5 bg-light">
                    <div class="text-center mb-5">
                        <h4 class="h4 text-muted mb-3">Rejoignez notre plateforme en 2 minutes</h4>
                        <div class="divider mx-auto bg-primary"></div>
                    </div>

                    <form class="user" method="POST" action="{{ route('inscription.register') }}">
                        @csrf
                        <div class="row g-4">
                            <!-- Prénom et Nom -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="prenom"
                                           class="form-control form-control-lg border-3 rounded-pill @error('prenom') is-invalid @enderror"
                                           placeholder="Prénom" value="{{ old('prenom') }}">
                                    <label class="ms-3 text-muted">
                                        <i class="fas fa-user me-2 text-primary"></i>Prénom
                                    </label>
                                    @error('prenom')
                                        <div class="invalid-feedback ps-4">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="nom"
                                           class="form-control form-control-lg border-3 rounded-pill @error('nom') is-invalid @enderror"
                                           placeholder="Nom" value="{{ old('nom') }}">
                                    <label class="ms-3 text-muted">
                                        <i class="fas fa-signature me-2 text-primary"></i>Nom
                                    </label>
                                    @error('nom')
                                        <div class="invalid-feedback ps-4">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email et Téléphone -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email"
                                           class="form-control form-control-lg border-3 rounded-pill @error('email') is-invalid @enderror"
                                           placeholder="Email" value="{{ old('email') }}">
                                    <label class="ms-3 text-muted">
                                        <i class="fas fa-envelope me-2 text-primary"></i>Email
                                    </label>
                                    @error('email')
                                        <div class="invalid-feedback ps-4">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" name="telephone"
                                           class="form-control form-control-lg border-3 rounded-pill @error('telephone') is-invalid @enderror"
                                           placeholder="Téléphone" value="{{ old('telephone') }}">
                                    <label class="ms-3 text-muted">
                                        <i class="fas fa-mobile-alt me-2 text-primary"></i>Téléphone
                                    </label>
                                    @error('telephone')
                                        <div class="invalid-feedback ps-4">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Date de naissance et Adresse -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" name="dateNaissance"
                                           class="form-control form-control-lg border-3 rounded-pill @error('dateNaissance') is-invalid @enderror"
                                           value="{{ old('dateNaissance') }}">
                                    <label class="ms-3 text-muted">
                                        <i class="fas fa-calendar-day me-2 text-primary"></i>Date de naissance
                                    </label>
                                    @error('dateNaissance')
                                        <div class="invalid-feedback ps-4">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="adresse"
                                           class="form-control form-control-lg border-3 rounded-pill @error('adresse') is-invalid @enderror"
                                           placeholder="Adresse" value="{{ old('adresse') }}">
                                    <label class="ms-3 text-muted">
                                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>Adresse
                                    </label>
                                    @error('adresse')
                                        <div class="invalid-feedback ps-4">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- CNI -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="cni"
                                           class="form-control form-control-lg border-3 rounded-pill @error('cni') is-invalid @enderror"
                                           placeholder="CNI" value="{{ old('cni') }}">
                                    <label class="ms-3 text-muted">
                                        <i class="fas fa-id-card me-2 text-primary"></i>Numéro CNI
                                    </label>
                                    @error('cni')
                                        <div class="invalid-feedback ps-4">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Mot de passe -->
                            <div class="col-md-6">
                                <div class="form-floating position-relative">
                                    <input type="password" name="password"
                                           class="form-control form-control-lg border-3 rounded-pill @error('password') is-invalid @enderror"
                                           placeholder="Mot de passe">
                                    <label class="ms-3 text-muted">
                                        <i class="fas fa-lock me-2 text-primary"></i>Mot de passe
                                    </label>
                                    <span class="position-absolute end-0 top-50 translate-middle-y me-3">
                                        <i class="fas fa-eye-slash toggle-password text-muted" style="cursor: pointer;"></i>
                                    </span>
                                    @error('password')
                                        <div class="invalid-feedback ps-4">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" name="password_confirmation"
                                           class="form-control form-control-lg border-3 rounded-pill"
                                           placeholder="Confirmation">
                                    <label class="ms-3 text-muted">
                                        <i class="fas fa-redo-alt me-2 text-primary"></i>Confirmez le mot de passe
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3 fw-bold shadow">
                                <i class="fas fa-user-check me-2"></i>Finaliser l'inscription
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('inscription.index') }}" class="text-decoration-none text-muted">
                                <i class="fas fa-sign-in-alt me-2"></i>Déjà un compte ? Connectez-vous
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 1.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 2rem rgba(0,0,0,0.15)!important;
    }

    .form-control {
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
    }

    .divider {
        width: 80px;
        height: 3px;
        opacity: 0.8;
    }

    .rounded-pill {
        padding: 1rem 1.5rem;
    }

    .invalid-feedback {
        font-size: 0.85em;
    }
</style>

<script>
    document.querySelectorAll('.toggle-password').forEach(item => {
        item.addEventListener('click', function(e) {
            const input = this.closest('.form-floating').querySelector('input');
            input.type = input.type === 'password' ? 'text' : 'password';
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>

@endsection
