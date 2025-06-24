<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeederPage2 extends Seeder
{
    public function run()
    {
        // Verificar e insertar temperaturas de color solo si no existen
        $colorTemperatures = [
            '6500K',
            '3000K',
        ];
        foreach ($colorTemperatures as $ct) {
            if (!DB::table('color_temperatures')->where('value', $ct)->exists()) {
                DB::table('color_temperatures')->insert(['value' => $ct]);
            }
        }
        $colorTemp6500Id = DB::table('color_temperatures')->where('value', '6500K')->value('id');
        $colorTemp3000Id = DB::table('color_temperatures')->where('value', '3000K')->value('id');

        // Insertar usos
        $uses = [
            ['name' => 'Residencia'],
            ['name' => 'Escuela'],
            ['name' => 'Hotel'],
        ];
        foreach ($uses as $use) {
            if (!DB::table('product_uses')->where('name', $use['name'])->exists()) {
                DB::table('product_uses')->insert($use);
            }
        }
        $useIds = DB::table('product_uses')->pluck('id')->all();

        // Insertar productos
        $products = [
            [
                'name' => 'Lámpara MR16 Y GU10',
                'warranty' => '2 años',
                'power_factor' => '0.5',
                'base' => 'MR16, GU10',
                'certification' => 'NOM',
            ],
            [
                'name' => 'Lámpara Tubular',
                'warranty' => '2 años',
                'power_factor' => '0.5',
                'base' => 'E27',
                'certification' => 'NOM',
            ],
            [
                'name' => 'Foco Bala',
                'warranty' => '2 años',
                'power_factor' => '0.5',
                'base' => 'E27',
                'certification' => 'NOM',
            ],
            [
                'name' => 'Foco Bala Industrial',
                'warranty' => '3 años',
                'power_factor' => '0.5',
                'base' => 'E40',
                'certification' => 'NOM',
            ],
            [
                'name' => 'Foco Bulbo',
                'warranty' => '2 años',
                'power_factor' => '>0.5',
                'base' => 'E27',
                'certification' => 'NOM',
            ],
        ];

        foreach ($products as $product) {
            $productId = DB::table('products')->insertGetId(array_merge($product, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));

            // Vincular usos al producto
            foreach ($useIds as $useId) {
                if (!DB::table('product_use_product')->where('product_id', $productId)->where('product_use_id', $useId)->exists()) {
                    DB::table('product_use_product')->insert([
                        'product_id' => $productId,
                        'product_use_id' => $useId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Insertar variantes según el producto
            $variants = [];
            if ($product['name'] === 'Lámpara MR16 Y GU10') {
                $variants = [
                    ['DB-01V-0007-01A', 200, 'Lámpara de campaña de plástico', '50x54mm', '7W', '700lm', '110-130V', '6500K, 3000K'],
                    ['DB-02V-0007-01A', 200, 'Lámpara de campaña de aluminio revestido de plástico', '50x54mm', '7W', '700lm', '110-130V', '6500K, 3000K'],
                    ['GU10GC-05-01', 100, 'Imitación lámpara de cristal de imitación', '50x54mm', '5W', '420lm', '110-130V', '6500K, 3000K'],
                ];
            } elseif ($product['name'] === 'Lámpara Tubular') {
                $variants = [
                    ['ZP-01V-0009-01A', 100, 'Lámpara de plástico PET - Campaña PC', '38x114mm', '9W', '900lm', '110-130V', '6500K, 3000K'],
                    ['ZP-01V-0009-02A', 100, 'Aluminio revestido - Campaña PC', '38x114mm', '9W', '900lm', '110-130V', '6500K, 3000K'],
                    ['ZP-01V-0012-02A', 100, 'Aluminio revestido PET - Campaña PC', '45x138mm', '12W', '1200lm', '110-130V', '6500K, 3000K'],
                ];
            } elseif ($product['name'] === 'Foco Bala') {
                $variants = [
                    ['TP-02V-0020-01A', 50, 'Aluminio revestido - Campaña PP', '80x154.5mm', '20W', '2300lm', '100-270V', '6500K, 3000K'],
                    ['TP-02V-0040-01A', 40, 'Aluminio revestido - Campaña PP', '100x193mm', '40W', '3400lm', '100-270V', '6500K, 3000K'],
                    ['TP-02V-0050-01A', 20, 'Aluminio revestido - Campaña PP', '115x236mm', '50W', '4500lm, 6000lm', '100-270V', '6500K, 3000K'],
                ];
            } elseif ($product['name'] === 'Foco Bala Industrial') {
                $variants = [
                    ['TP-01V-0040-01A', 30, 'Fundición de aluminio - Campaña de color secado de PC', '115x236mm', '40W', '4400lm', '100-277V', '6500K'],
                ];
            } elseif ($product['name'] === 'Foco Bulbo') {
                $variants = [
                    ['QPG50-07-01YS', 120, 'Aluminio cubierto por PA - Campaña PC', '50x90mm', '7W', '700lm', '110-130V', '6500K, 3000K'],
                    ['QPG50-07-01YLC', 100, 'Aluminio cubierto por PA - Campaña PC', '50x90mm', '7W', '700lm', '110-130V', '6500K, 3000K'],
                    ['QPA60-12-01YS', 120, 'Aluminio cubierto por PA - Campaña PC', '60x110mm', '12W', '1200lm', '110-130V', '6500K, 3000K'],
                    ['QPA60-12-01YLC', 120, 'Aluminio cubierto por PA - Campaña PC', '60x110mm', '12W', '1200lm', '110-130V', '6500K, 3000K'],
                ];
            }

            foreach ($variants as $variant) {
                $colorTempIds = [];
                if (strpos($variant[7], '6500K') !== false) $colorTempIds[] = $colorTemp6500Id;
                if (strpos($variant[7], '3000K') !== false) $colorTempIds[] = $colorTemp3000Id;
                foreach ($colorTempIds as $ctId) {
                    if (!DB::table('product_variants')->where('product_id', $productId)->where('variant_id', $variant[0])->where('color_temperature_id', $ctId)->exists()) {
                        DB::table('product_variants')->insert([
                            'product_id' => $productId,
                            'variant_id' => $variant[0],
                            'pcs' => $variant[1],
                            'description' => $variant[2],
                            'size' => $variant[3],
                            'power' => $variant[4],
                            'lumen' => explode(',', str_replace(' ', '', $variant[5]))[0], // Tomar el primer valor de lúmenes
                            'voltage' => $variant[6],
                            'color_temperature_id' => $ctId,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }

            // Insertar fotos del producto (rutas ficticias como ejemplo)
            $photos = [
                ['/images/' . strtolower(str_replace(' ', '_', $product['name'])) . '_1.jpg'],
                ['/images/' . strtolower(str_replace(' ', '_', $product['name'])) . '_2.jpg'],
            ];
            foreach ($photos as $photo) {
                if (!DB::table('product_photos')->where('product_id', $productId)->where('path', $photo[0])->exists()) {
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
    }
}