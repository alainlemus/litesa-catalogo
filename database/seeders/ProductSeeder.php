<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Insertar temperaturas de color
        $colorTemperatures = [
            ['value' => '6500K'],
            ['value' => '3000K'],
        ];
        foreach ($colorTemperatures as $ct) {
            DB::table('color_temperatures')->insert($ct);
        }
        $colorTemp6500Id = DB::table('color_temperatures')->where('value', '6500K')->value('id');

        // Insertar usos
        $uses = [
            ['name' => 'Residencia'],
            ['name' => 'Escuela'],
            ['name' => 'Hotel'],
        ];
        foreach ($uses as $use) {
            DB::table('product_uses')->insert($use);
        }
        $useIds = DB::table('product_uses')->pluck('id')->all();

        // Insertar el producto
        $productId = DB::table('products')->insertGetId([
            'name' => 'Foco Bulbo',
            'warranty' => '2 años',
            'power_factor' => '>0.5',
            'base' => 'E27',
            'certification' => 'NOM',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Vincular usos al producto
        foreach ($useIds as $useId) {
            DB::table('product_use_product')->insert([
                'product_id' => $productId,
                'product_use_id' => $useId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insertar las variantes
        $variants = [
            ['AP-03V-0005-01A', 100, 'Aluminio revestido plástico de PCA', '50*88mm', '10W', '850LM', '110-130V', '6500K'],
            ['AP-03V-0010-01A', 100, 'Aluminio revestido plástico de PCA', '60*107mm', '15W', '1650LM', '110-130V', '6500K'],
            ['AP-03V-0015-01A', 100, 'Aluminio revestido plástico de PCA', '65*110mm', '17W', '1800LM', '110-130V', '6500K'],
            ['AP-03V-0020-01A', 100, 'Aluminio revestido plástico de PCA', '70*113mm', '20W', '2100LM', '110-130V', '6500K'],
        ];

        foreach ($variants as $variant) {
            $colorTempId = DB::table('color_temperatures')->where('value', $variant[7])->value('id');
            DB::table('product_variants')->insert([
                'product_id' => $productId,
                'variant_id' => $variant[0],
                'pcs' => $variant[1],
                'description' => $variant[2],
                'size' => $variant[3],
                'power' => $variant[4],
                'lumen' => $variant[5],
                'voltage' => $variant[6],
                'color_temperature_id' => $colorTempId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insertar fotos del producto (ejemplo con rutas ficticias)
        $photos = [
            ['/images/foco_bulbo_1.jpg'],
            ['/images/foco_bulbo_2.jpg'],
        ];
        foreach ($photos as $photo) {
            DB::table('product_photos')->insert([
                'product_id' => $productId,
                'path' => $photo[0],
                'description' => 'Foto del producto ' . $photo[0],
                'alt_text' => 'imagen para ceo ' . $photo[0],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}