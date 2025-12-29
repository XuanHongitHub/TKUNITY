<?php
require __DIR__ . '/vendor/autoload.php';

function inspect($class) {
    echo "Reflecting $class\n";
    try {
        $r = new ReflectionClass($class);
        foreach ($r->getMethods() as $m) {
            echo "Method: " . $m->getName() . "\n";
            foreach ($m->getParameters() as $p) {
                if ($p->hasType()) {
                    $t = $p->getType();
                    if ($t instanceof ReflectionNamedType) {
                        $type = $t->getName();
                    } else {
                        $type = (string)$t;
                    }
                } else {
                    $type = 'no-type';
                }
                echo "  Param: $type $" . $p->getName() . "\n";
            }
            if ($m->hasReturnType()) {
                $t = $m->getReturnType();
                $ret = ($t instanceof ReflectionNamedType) ? $t->getName() : (string)$t;
            } else {
                $ret = 'no-return';
            }
            echo "  Return: $ret\n";
            echo "---\n";
        }
    } catch (Throwable $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
}

inspect('Filament\Schemas\Contracts\HasSchemas');
