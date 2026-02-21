<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Solo crear admin si no existe en la base remota
        $adminExists = User::on('mysql_remote')->where('email', 'admin@admin.com')->exists();
        if (!$adminExists) {
            User::factory()->create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
            ]);
        }

        $this->call([
              //ProductSeeder::class,
              //ProductSeederPage2::class,
              //MigrateToRemoteSeeder::class, //migra de local al vps
              //MigrateFromPostgresToRemoteSeeder::class, //migra de laravel cloud al vps
        ]);
    }
}
