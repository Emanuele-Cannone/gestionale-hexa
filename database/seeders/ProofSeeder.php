<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProofSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proofs = [
            [
                'name' => 'Allattamento',
                'user_manage' => 0,
            ],
            [
                'name' => 'Aspettativa',
                'user_manage' => 0,
            ],
            [
                'name' => 'Assistenza Familiare Con Grave Patologia',
                'user_manage' => 1,
            ],
            [
                'name' => 'Cambio Turno',
                'user_manage' => 1,
            ],
            [
                'name' => 'Congedo Matrimoniale',
                'user_manage' => 1,
            ],
            [
                'name' => 'Congedo Parentale',
                'user_manage' => 1,
            ],
            [
                'name' => 'Donazione Sangue',
                'user_manage' => 1,
            ],
            [
                'name' => 'Ferie',
                'user_manage' => 1,
            ],
            [
                'name' => 'Infortuno',
                'user_manage' => 0,
            ],
            [
                'name' => 'Lavoro Fuori Sede',
                'user_manage' => 1,
            ],
            [
                'name' => 'Lutto',
                'user_manage' => 1,
            ],
            [
                'name' => 'Malattia',
                'user_manage' => 0,
            ],
            [
                'name' => 'Maternità',
                'user_manage' => 0,
            ],
            [
                'name' => 'Paternità',
                'user_manage' => 0,
            ],
            [
                'name' => 'Permesso',
                'user_manage' => 1,
            ],
            [
                'name' => 'Permesso Sindacale',
                'user_manage' => 1,
            ],
            [
                'name' => 'Permesso 104',
                'user_manage' => 1,
            ],
            [
                'name' => 'Riposo',
                'user_manage' => 0,
            ],
            [
                'name' => 'SmartWorking',
                'user_manage' => 1,
            ],
            [
                'name' => 'Seggio Elettorale',
                'user_manage' => 1,
            ],
            [
                'name' => 'Studio',
                'user_manage' => 1,
            ],
            [
                'name' => 'Ufficio',
                'user_manage' => 1,
            ],
            [
                'name' => 'Visite Prenatali',
                'user_manage' => 1,
            ],

        ];

        DB::table('proofs')->insert($proofs);

    }
}
