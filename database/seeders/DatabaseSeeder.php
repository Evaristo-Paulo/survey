<?php

namespace Database\Seeders;

use App\Models\Mes;
use App\Models\User;
use App\Models\Modelo;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role' => 'admin',
        ]);

        $owner = Role::create([
            'role' => 'owner',
        ]);

        User::create([
            'name' => 'John Doe',
            'email' => 'admin@gmail.com',
            'role_id' => $owner->id,
            'password' => Hash::make('admin'),
        ]);

        Modelo::create([
            'nome' => 'Escolha Única',
            'alternativa_permitida' => 1,
        ]);

        Modelo::create([
            'nome' => 'Escolha Múltipla',
            'alternativa_permitida' => 2,
        ]);


        Mes::create([
            'mes' => 'Janeiro'
        ]);

        Mes::create([
            'mes' => 'Fevereiro'
        ]);

        Mes::create([
            'mes' => 'Março'
        ]);

        Mes::create([
            'mes' => 'Abril'
        ]);

        Mes::create([
            'mes' => 'Maio'
        ]);

        Mes::create([
            'mes' => 'Junho'
        ]);

        Mes::create([
            'mes' => 'Julho'
        ]);

        Mes::create([
            'mes' => 'Agosto'
        ]);

        Mes::create([
            'mes' => 'Setembro'
        ]);

        Mes::create([
            'mes' => 'Outubro'
        ]);

        Mes::create([
            'mes' => 'Novembro'
        ]);

        Mes::create([
            'mes' => 'Dezembro'
        ]);
    }
}
