<?php
require __DIR__ . '/vendor/autoload.php';

try {
    $reflection = new ReflectionClass('Filament\Resources\Resource');
    $method = $reflection->getMethod('form');
    echo "Method: " . $method->getName() . "\n";
    foreach ($method->getParameters() as $param) {
        echo "Param: " . $param->getName() . " Type: " . $param->getType() . "\n";
    }
    echo "Return Type: " . $method->getReturnType() . "\n";
} catch (ReflectionException $e) {
    echo "Reflection Error: " . $e->getMessage() . "\n";
}
