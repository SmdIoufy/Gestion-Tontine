<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Participant;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('fr_FR');

        $nomsSenegalais = ['Diop', 'Ba', 'Faye', 'Ndiaye', 'Sow', 'Gueye', 'Fall', 'Diallo', 'Sarr', 'Cissé'];
        $prenomsSenegalais = ['Ousmane', 'Fatou', 'Aissatou', 'Mamadou', 'Cheikh', 'Khadija', 'Ibrahima', 'Seynabou', 'Aliou', 'Adama'];

        $prefixes = ['77', '76', '78', '75', '70'];

        $regionsSenegal = ['Dakar', 'Thiès', 'Saint-Louis', 'Ziguinchor', 'Kaolack', 'Diourbel', 'Kolda', 'Fatick', 'Matam', 'Tambacounda', 'Kaffrine', 'Sédhiou'];

        for ($i = 1; $i <= 30; $i++) {
            $prenom = $faker->randomElement($prenomsSenegalais);
            $nom = $faker->randomElement($nomsSenegalais);
            $telephone = $faker->randomElement($prefixes) . $faker->numerify('### ## ##');

            $email = strtolower("$prenom.$nom" . $faker->unique()->randomNumber(3) . "@uadb-tontine.sn");
            $password = Hash::make('password123');

            $region = $faker->randomElement($regionsSenegal);
            $adresse = "$faker->streetName, $region, Sénégal";

            // Création de l'utilisateur
            $user = User::create([
                'prenom' => $prenom,
                'nom' => $nom,
                'telephone' => $telephone,
                'email' => $email,
                'password' => $password,
                'profil' => 'PARTICIPANT'
            ]);

            // Création du participant lié
            Participant::create([
                'idUser' => $user->id,
                'dateNaissance' => $faker->date(),
                'cni' => $faker->numerify('#############'), // 13 chiffres
                'adresse' => $adresse,
                'imageCni' => 'default.png'
            ]);
        }
    }
}
