<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::create([
            'name' => 'Havaianas',
            'slug' => 'havaianas',
            'description_tr' => "Brezilya'nın efsanevi terlik markası. 1962'den beri dünyanın en sevilen sandaletleri.",
            'description_en' => "Brazil's legendary flip-flop brand. The world's most beloved sandals since 1962.",
            'short_desc_tr' => 'Brezilya\'nın efsanevi terlik markası',
            'short_desc_en' => 'Brazil\'s legendary flip-flop brand',
            'is_active' => true,
            'order' => 1,
        ]);

        Brand::create([
            'name' => 'New Era',
            'slug' => 'new-era',
            'description_tr' => 'MLB, NBA, NFL resmi şapka tedarikçisi. Sokak modasının temel markası.',
            'description_en' => 'Official cap supplier for MLB, NBA, NFL. The essential brand of street fashion.',
            'short_desc_tr' => 'Sokak modasının lideri',
            'short_desc_en' => 'Leader of street fashion',
            'is_active' => true,
            'order' => 2,
        ]);

        Brand::create([
            'name' => 'Nike Swim',
            'slug' => 'nike-swim',
            'description_tr' => 'Profesyonel yüzücüler için tasarlanmış yenilikçi yüzme ekipmanları.',
            'description_en' => 'innovative swimming equipment designed for professional swimmers.',
            'short_desc_tr' => 'Profesyonel yüzme ekipmanları',
            'short_desc_en' => 'Professional swimming equipment',
            'is_active' => true,
            'order' => 3,
        ]);
    }
}
