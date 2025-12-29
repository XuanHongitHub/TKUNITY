<?php
require __DIR__ . '/vendor/autoload.php';

try {
    $reflection = new ReflectionClass('Filament\Schemas\Schema');
    echo "Class: " . $reflection->getName() . "\n";
    if ($reflection->hasMethod('components')) echo "Has components()\n";
    if ($reflection->hasMethod('schema')) echo "Has schema()\n";
} catch (ReflectionException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
