<?php
require __DIR__ . '/vendor/autoload.php';

register_shutdown_function(function() {
    $error = error_get_last();
    if ($error) {
        $msg = "SHUTDOWN ERROR: " . $error['message'] . "\n" . "File: " . $error['file'] . " Line: " . $error['line'] . "\n";
        file_put_contents('error.log', $msg);
        echo $msg;
    }
});

try {
    // Manually include the file to trigger compilation/inheritance checks
    require_once __DIR__ . '/app/Filament/Pages/ManageGeneralSettings.php';
    echo "File loaded.\n";
    $page = new App\Filament\Pages\ManageGeneralSettings();
    echo "Class instantiated.\n";
} catch (Throwable $e) {
    echo "Caught: " . $e->getMessage() . "\n";
}
