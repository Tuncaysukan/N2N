<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Brand count: " . App\Models\Brand::count() . PHP_EOL;
echo "BrandImages count: " . App\Models\BrandImage::count() . PHP_EOL;

$brand = App\Models\Brand::where('slug', 'havaianas')->first();
if ($brand) {
    echo "Havaianas ID: " . $brand->id . PHP_EOL;
    echo "Havaianas Images: " . $brand->activeImages()->count() . PHP_EOL;
} else {
    echo "Havaianas not found" . PHP_EOL;
}
