<?php
require __DIR__ . '/vendor/autoload.php';

if (class_exists('Filament\Forms\Form')) {
    echo "Form exists.\n";
} else {
    echo "Form MISSING.\n";
}

if (class_exists('Filament\Resources\Resource')) {
    echo "Resource exists.\n";
} else {
    echo "Resource MISSING.\n";
}
