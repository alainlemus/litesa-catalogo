<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrateFromPostgresToRemoteSeeder extends Seeder
{
    /**
     * Copia todos los datos de la base Postgres a la remota MySQL.
     */
    public function run(): void
    {
        echo "Seeder iniciado para migrar datos de Postgres a MySQL remoto\n";
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
        ];

        foreach ($tables as $table) {
            echo "Iniciando migración de $table...\n";
            $rows = DB::connection('pgsql')->table($table)->get();
            $count = 0;
            foreach ($rows as $row) {
                $data = (array) $row;
                $uniqueFields = [];
                if ($table === 'users') {
                    $uniqueFields = ['email'];
                }
                try {
                    if (!empty($uniqueFields)) {
                        DB::connection('mysql_remote')->table($table)->upsert([$data], $uniqueFields);
                        echo "Upsert en $table: " . json_encode($data) . "\n";
                    } else {
                        DB::connection('mysql_remote')->table($table)->insert($data);
                        echo "Insert en $table: " . json_encode($data) . "\n";
                    }
                    $count++;
                } catch (\Illuminate\Database\QueryException $e) {
                    echo "Error en $table: " . $e->getMessage() . "\n";
                }
            }
            echo "Migrados $count registros de $table desde Postgres a MySQL remoto\n";
        }
    }
}
