<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrateToRemoteSeeder extends Seeder
{
    /**
     * Copia todos los datos de la base local a la remota.
     */
    public function run(): void
    {
        $tables = [
            'users',
            'about_page_settings',
            'categories',
            'color_temperatures',
            'contact_messages',
            'lighting_pages',
            'media_files',
            'posts',
            'products',
            'product_photos',
            'product_uses',
            'product_variants',
            'site_settings',
            'suscribers',
            'testimonials',
            // Agrega aquí otras tablas si es necesario
        ];

        foreach ($tables as $table) {
            $rows = DB::connection('mysql')->table($table)->get();
            $count = 0;
            foreach ($rows as $row) {
                $data = (array) $row;
                $uniqueFields = [];
                if ($table === 'users') {
                    $uniqueFields = ['email'];
                }
                if (!empty($uniqueFields)) {
                    DB::connection('mysql_remote')->table($table)->upsert([$data], $uniqueFields);
                } else {
                    try {
                        DB::connection('mysql_remote')->table($table)->insert($data);
                    } catch (\Illuminate\Database\QueryException $e) {
                        // Ignora duplicados
                    }
                }
                $count++;
            }
            echo "Migrados $count registros en la tabla $table\n";
        }
    }
}
