<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Brands: " . App\Models\Brand::count() . PHP_EOL;
$brands = App\Models\Brand::all();
foreach($brands as $brand) {
    echo "Brand: " . $brand->name . " - Images: " . $brand->activeImages()->count() . PHP_EOL;
}

echo "Sliders: " . App\Models\Slider::count() . PHP_EOL;
echo "BrandImages: " . App\Models\BrandImage::count() . PHP_EOL;
