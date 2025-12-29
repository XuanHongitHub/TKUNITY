<?php
require __DIR__ . '/vendor/autoload.php';

use App\Filament\Resources\Categories\CategoryResource;
use App\Filament\Resources\StaticPages\StaticPageResource;

function inspect($class) {
    try {
        $r = new ReflectionClass($class);
        $m = $r->getMethod('form');
        echo "$class form:\n";
        foreach ($m->getParameters() as $p) {
            echo "  Param: " . $p->getType() . "\n";
        }
        echo "  Return: " . $m->getReturnType() . "\n";
    } catch (Exception $e) {
        echo "$class Error: " . $e->getMessage() . "\n";
    }
}

inspect(CategoryResource::class);
inspect(StaticPageResource::class);
