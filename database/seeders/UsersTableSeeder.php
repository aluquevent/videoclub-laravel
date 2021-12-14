<?php
//creado con ># php artisan make:seeder UsersTableSeeder
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private static function seedUsers() {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'name' => 'Asier',
            'is_admin' => 1,
            'email' => 'asierluque@gmail.com',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'Invitado',
            'is_admin' => 0,
            'email' => 'invitado@gmail.com',
            'password' => Hash::make('password'),
        ]);

    }
    public function run()
    {
        self::seedUsers();
        $this->command->info('Tabla usuarios inicializada con datos!');
    }
}
