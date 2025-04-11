<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'brand_name' => 'Cresus Casino',
                'brand_image' => '',
                'description' => 'N’attendez plus pour découvrir l’un des casinos préférés des joueurs Français ! Cresus Casino a été élu casino n°1 en France et il a tout pour vous plaire : bonus, jeux & service client, que vaut vraiment ce casino ? Découvrez notre avis et revue.',
                'rating' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_name' => 'Casombie Casino',
                'brand_image' => '',
                'rating' => rand(1, 5),
                'description' => "Plongez dans l'univers des zombies qui vous accompagneront lors de vos sessions de jeux sur Casombie casino ! Cette plateforme vous offre des fonctionnalités et services de qualité pour vivre une expérience unique ! Parcourez notre revue complète pour tout connaître en détail.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_name' => 'Jackpotbob Casino',
                'brand_image' => '',
                'rating' => rand(1, 5),
                'description' => "Découvrez le Moyen-Orient sous un nouveau jour grâce à Wild Sultan ! Ce casino en ligne aux couleurs des 1001 Nuits ne cesse d'impressionner les joueurs français. Vous souhaitez en savoir plus ? Nous avons testé le casino pour vous ! ",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand_name' => 'Wild-Sultan',
                'brand_image' => '"',
                'rating' => rand(1, 5),
                'description' => "Découvrez le Moyen-Orient sous un nouveau jour grâce à Wild Sultan ! Ce casino en ligne aux couleurs des 1001 Nuits ne cesse d'impressionner les joueurs français. Vous souhaitez en savoir plus ? Nous avons testé le casino pour vous !",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'brand_name' => 'vegasplus-casino',
                'brand_image' => '',
                'rating' => rand(1, 5),
                'description' => 'Voici un casino aux couleurs de Las Vegas qui a su faire ses preuves. Bonus, paiements rapides & service client disponible 24/7, vous êtes entre de bonnes mains pour vous amuser sur une ludothèque bien remplie !',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('brands')->insert($brands);
    }
}
