<?php
require __DIR__ . '/vendor/autoload.php';

try {
    $reflection = new ReflectionClass('Filament\Schemas\Schema');
    if ($reflection->hasMethod('columns')) {
        echo "Has columns() method.\n";
    } else {
        echo "MISSING columns() method.\n";
    }
} catch (ReflectionException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
