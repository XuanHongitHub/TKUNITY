<?php
require __DIR__ . '/vendor/autoload.php';

use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

try {
    // Define anonymous class to test interface compliance
    $test = new class implements HasForms {
        use InteractsWithForms;

        public function form($schema) { return $schema; }
    };
    echo "Class instantiated successfully (unexpected).\n";
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
