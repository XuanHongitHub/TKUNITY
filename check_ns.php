<?php
// Check if class exists
$classes = [
    'Filament\Schemas\Components\Grid',
    'Filament\Schemas\Components\Section',
    'Filament\Schemas\Grid', // Expected to be false
];

foreach ($classes as $class) {
    echo "$class: " . (class_exists($class) ? 'EXISTS' : 'MISSING') . "\n";
}
