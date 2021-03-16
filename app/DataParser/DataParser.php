<?php
namespace  App\DataParser;

abstract class DataParser
{
    public function getConstList(): array
    {
        $reflected =get_class(new static(null));
        $refl = new \ReflectionClass($reflected);
        return array_flip($refl->getConstants());
    }

}
