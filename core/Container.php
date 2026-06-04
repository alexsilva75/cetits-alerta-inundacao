<?php

namespace Core;

use ReflectionClass;
use ReflectionNamedType;

class Container
{
    public function make(string $class)
    {
        $reflection = new ReflectionClass($class);

        if (!$reflection->isInstantiable()) {
            throw new \Exception(
                "Não é possível instanciar {$class}"
            );
        }

        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return new $class();
        }

        $dependencies = [];

        foreach ($constructor->getParameters() as $parameter) {

            $type = $parameter->getType();

            if (!$type instanceof ReflectionNamedType) {
                throw new \Exception(
                    "Dependência inválida em {$class}"
                );
            }

            $dependencies[] = $this->make(
                $type->getName()
            );
        }

        return $reflection->newInstanceArgs(
            $dependencies
        );
    }
}