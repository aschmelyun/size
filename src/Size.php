<?php

namespace Aschmelyun\Size;

class Size
{
    private static int $bytes;
    
    private static $instance;
    
    private static array $sizes = [
        'B',
        'KB',
        'MB',
        'GB',
        'TB',
        'PB',
        'EB',
        'ZB',
        'YB',
    ];
    
    public static function __callStatic(string $name, array $args): self
    {
        if (!in_array($name, self::$sizes)) {
            throw new \Exception("Undefined method `${name}`. The only available methods are " . implode(', ', self::$sizes) . ".");
        }
        
        if (self::$instance === null) {
            self::$instance = new self;
        }

        $multiplier = pow(1024, array_search($name, self::$sizes));
        
        self::$bytes = $args[0] * $multiplier;

        return self::$instance;
    }
    
    public function __call(string $name, array $args): float
    {
        $size = str_replace('to', '', $name);
        
        if (!in_array($size, self::$sizes)) {
            throw new \Exception("Undefined method `${name}`. The only available methods are to" . implode(', to', self::$sizes) . ".");
        }
        
        return $this->convert($size);
    }
    
    public function __get(string $name): float
    {
        if (!in_array($name, self::$sizes)) {
            throw new \Exception("Undefined property `${name}`. The only available properties are " . implode(', ', self::$sizes) . ".");
        }
        
        return $this->convert($name);
    }
    
    public function __toString(): string
    {
        return self::$bytes;
    }

    private function convert(string $name): float
    {
        $divisor = pow(1024, array_search($name, self::$sizes));

        return self::$bytes / $divisor;
    }
}