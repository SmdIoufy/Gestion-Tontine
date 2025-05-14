@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-50 to-primary-100">
    <div class="w-full max-w-md px-4 py-8">
        <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-10">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Content de vous revoir !</h1>
                <p class="text-gray-500">Connectez-vous à votre compte</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse Email</label>
                    <div class="relative">
                        <input
                            type="email"
                            name="email"
                            id="email"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 placeholder-gray-400 transition"
                            placeholder="exemple@email.com"
                        >
                        <div class="absolute inset-y-0 right-3 flex items-center">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                    <div class="relative">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 placeholder-gray-400 transition"
                            placeholder="••••••••"
                        >
                        <div class="absolute inset-y-0 right-3 flex items-center">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-600">Se souvenir de moi</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm text-primary-600 hover:text-primary-700">
                        Mot de passe oublié ?
                    </a>
                </div>

                <button type="submit"
                        class="w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white py-3 px-4 rounded-lg hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-2"></i> Se connecter
                </button>

                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Ou continuer avec</span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fab fa-google text-red-600 mr-2"></i>
                            <span class="text-sm font-medium text-gray-700">Google</span>
                        </a>
                        <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fab fa-facebook text-blue-600 mr-2"></i>
                            <span class="text-sm font-medium text-gray-700">Facebook</span>
                        </a>
                    </div>
                </div>

                <p class="mt-8 text-center text-gray-600">
                    Pas encore membre ?
                    <a href="{{ route('inscription.index') }}" class="text-primary-600 hover:text-primary-700 font-medium">
                        Créer un compte
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
