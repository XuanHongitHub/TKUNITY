<?php
require __DIR__ . '/vendor/autoload.php';


function checkProps($class) {
    echo "Props of $class:\n";
    $r = new ReflectionClass($class);
    foreach ($r->getProperties() as $p) {
       echo "  " . implode(' ', Reflection::getModifierNames($p->getModifiers())) . " $" . $p->getName() . "\n";
    }
}
checkProps('Filament\Pages\BasePage');
