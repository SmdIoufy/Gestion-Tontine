<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;
use App\Models\Tontine;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assurez-vous qu'il y a au moins 5 tontines dans la base de données
        $tontines = Tontine::all();

        if ($tontines->count() < 5) {
            $this->command->info('Veuillez ajouter au moins 5 tontines avant de lancer ce seeder.');
            return;
        }

        $images = [
            ['nomImage' => 'cuisiniere1.jpg'],
            ['nomImage' => 'ustensile-cuilliere1.jpg'],
            ['nomImage' => 'voiture1.jpg'],
            ['nomImage' => 'ustensile1.jpg'],
            ['nomImage' => 'voiture2.jpg'],
        ];

        foreach ($images as $index => $image) {
            // Associer chaque image à une tontine
            Image::create([
                'idTontine' => $tontines[$index]->id,
                'nomImage' => $image['nomImage'],
            ]);
        }
    }
}
