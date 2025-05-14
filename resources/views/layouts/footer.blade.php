<!-- Footer -->
<footer class="bg-gradient-to-t from-blue-900 to-purple-900 text-gray-200 mt-24">
    <div class="max-w-8xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12">
            <!-- Section Logo + Description -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-white p-2 rounded-lg shadow">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-white">Tontine<span class="text-purple-400">Pro</span></span>
                </div>
                <p class="text-sm leading-relaxed">
                    Plateforme de gestion collaborative de tontines. Simplifiez vos épargnes collectives avec des outils modernes et sécurisés.
                </p>
                <div class="flex space-x-3 pt-4">
                    <button class="bg-white/10 hover:bg-white/20 p-2 rounded-full transition-all">
                        <span class="sr-only">Télécharger sur l'App Store</span>
                        <i class="fab fa-apple text-xl"></i>
                    </button>
                    <button class="bg-white/10 hover:bg-white/20 p-2 rounded-full transition-all">
                        <span class="sr-only">Télécharger sur Google Play</span>
                        <i class="fab fa-google-play text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Liens rapides -->
            <div>
                <h3 class="text-white font-semibold mb-4 text-lg">Navigation</h3>
                <nav class="space-y-3">
                    <a href="#" class="flex items-center group">
                        <span class="w-2 h-2 bg-purple-500 rounded-full mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span class="hover:text-purple-300 transition-colors">Comment ça marche ?</span>
                    </a>
                    <a href="#" class="flex items-center group">
                        <span class="w-2 h-2 bg-purple-500 rounded-full mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span class="hover:text-purple-300 transition-colors">Tutoriels vidéo</span>
                    </a>
                    <a href="#" class="flex items-center group">
                        <span class="w-2 h-2 bg-purple-500 rounded-full mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span class="hover:text-purple-300 transition-colors">Centre d'aide</span>
                    </a>
                    <a href="#" class="flex items-center group">
                        <span class="w-2 h-2 bg-purple-500 rounded-full mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        <span class="hover:text-purple-300 transition-colors">Blog</span>
                    </a>
                </nav>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-white font-semibold mb-4 text-lg">Contact rapide</h3>
                <form class="space-y-4">
                    <div>
                        <input
                            type="email"
                            class="w-full px-4 py-2 bg-white/10 border border-white/20 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-300 placeholder-gray-400"
                            placeholder="Votre email"
                        >
                    </div>
                    <div>
                        <textarea
                            class="w-full px-4 py-2 bg-white/10 border border-white/20 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-300 placeholder-gray-400"
                            rows="3"
                            placeholder="Votre message"
                        ></textarea>
                    </div>
                    <button class="bg-purple-600 hover:bg-purple-700 px-6 py-2 rounded-lg transition-colors flex items-center">
                        <i class="far fa-paper-plane mr-2"></i> Envoyer
                    </button>
                </form>
            </div>

            <!-- Réseaux sociaux -->
            <div>
                <h3 class="text-white font-semibold mb-4 text-lg">Nous suivre</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="#" class="p-3 bg-white/10 hover:bg-white/20 rounded-lg transition-colors flex items-center space-x-3">
                        <i class="fab fa-facebook text-blue-400 text-xl"></i>
                        <span>Facebook</span>
                    </a>
                    <a href="#" class="p-3 bg-white/10 hover:bg-white/20 rounded-lg transition-colors flex items-center space-x-3">
                        <i class="fab fa-twitter text-blue-400 text-xl"></i>
                        <span>Twitter</span>
                    </a>
                    <a href="#" class="p-3 bg-white/10 hover:bg-white/20 rounded-lg transition-colors flex items-center space-x-3">
                        <i class="fab fa-linkedin text-blue-400 text-xl"></i>
                        <span>LinkedIn</span>
                    </a>
                    <a href="#" class="p-3 bg-white/10 hover:bg-white/20 rounded-lg transition-colors flex items-center space-x-3">
                        <i class="fab fa-instagram text-pink-400 text-xl"></i>
                        <span>Instagram</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Copyright + Mentions légales -->
        <div class="border-t border-white/10 mt-12 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="text-center md:text-left">
                    <p class="text-sm">
                        © {{ date('Y') }} TontinePro. Tous droits réservés.
                    </p>
                    <div class="flex justify-center md:justify-start space-x-4 mt-2">
                        <a href="#" class="text-sm hover:text-purple-300">Confidentialité</a>
                        <a href="#" class="text-sm hover:text-purple-300">Conditions</a>
                        <a href="#" class="text-sm hover:text-purple-300">Cookies</a>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <img src="/payment-visa.png" class="h-8 opacity-75 hover:opacity-100 transition-opacity" alt="Visa">
                    <img src="/payment-mastercard.png" class="h-8 opacity-75 hover:opacity-100 transition-opacity" alt="Mastercard">
                    <img src="/payment-mtn.png" class="h-8 opacity-75 hover:opacity-100 transition-opacity" alt="Mobile Money">
                </div>
            </div>
        </div>
    </div>
</footer>
