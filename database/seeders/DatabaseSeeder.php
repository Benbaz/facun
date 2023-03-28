<?php

namespace Database\Seeders;

use App\Models\candidat;
use App\Models\candidats;
use App\Models\elections;
use App\Models\etablissement;
use App\Models\Etablissements;
use CreateVoteTables;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         // Création d'un utilisateur admin
         DB::table('users')->insert([
            'name' => 'Admin',
            'last_name' => 'Adminis',
            'email' => 'admin@baz.com',
            'password' => Hash::make('password'),
        ]);

        // Création de 3 établissements
        $etablissements = [
            ['nom' => 'Etablissement 1'],
            ['nom' => 'Etablissement 2'],
            ['nom' => 'Etablissement 3'],
        ];
        foreach ($etablissements as $etablissement) {
            etablissement::create($etablissement);
        }

        DB::table('elections')->insert([
            'nom' => 'Election miss 2023',
            'type' => 'miss',
            'date_debut' => '2023-02-20 00:00:00',
            'date_fin' => '2023-02-28 00:00:00',
        ]);

        $faker = Faker::create();

        // Get all elections and etablissements
        $elections = elections::all();
        $etablissements = Etablissement::all();

        // Create 6 random candidats
        for ($i = 0; $i < 6; $i++) {
            $candidat = new Candidat();
            $candidat->nom = $faker->firstName;
            $candidat->prenom = $faker->lastName;
            $candidat->tel = $faker->phoneNumber;
            $candidat->photo = $faker->imageUrl(200, 200, 'people');
            $candidat->video = $faker->url;
            $candidat->election()->associate($elections->random());
            $candidat->etablissement()->associate($etablissements->random());
            $candidat->save();
        }
        // // Création de 6 candidats répartis dans les établissements
        // $candidats = [
        //     ['nom' => 'Candidat 1', 'etablissement_id' => 1],
        //     ['nom' => 'Candidat 2', 'etablissement_id' => 1],
        //     ['nom' => 'Candidat 3', 'etablissement_id' => 2],
        //     ['nom' => 'Candidat 4', 'etablissement_id' => 2],
        //     ['nom' => 'Candidat 5', 'etablissement_id' => 3],
        //     ['nom' => 'Candidat 6', 'etablissement_id' => 3],
        // ];
        // foreach ($candidats as $candidat) {
        //     candidat::create($candidat);
        // }
    }
}
