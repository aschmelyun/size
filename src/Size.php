<?php

namespace Aschmelyun\Size;

/**
 * @method static self B(int $size)
 * @method static self KB(int $size)
 * @method static self MB(int $size)
 * @method static self GB(int $size)
 * @method static self TB(int $size)
 * @method static self PB(int $size)
 * @method static self EB(int $size)
 * @method static self ZB(int $size)
 * @method static self YB(int $size)
 * @method float toB()
 * @method float toKB()
 * @method float toMB()
 * @method float toGB()
 * @method float toTB()
 * @method float toPB()
 * @method float toEB()
 * @method float toZB()
 * @method float toYB()
 */
class Size
{
    /**
     * The amount of bytes parsed from the initial instantiation
     * 
     * @var int
     */
    private static int $bytes;
    
    /**
     * @var null|Size
     */
    private static $instance;
    
    /**
     * @var array
     */
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
    
    /**
     * Magic method used to instantiate a class object and process the method's argument down to bytes
     * 
     * @param string $name
     * @param array $args
     * @return self
     * @throws \Exception
     */
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
    
    /**
     * Magic method used to return bytes as a different (higher) unit
     * 
     * @param string $name
     * @param array $args
     * @return float
     * @throws \Exception
     */
    public function __call(string $name, array $args): float
    {
        $size = str_replace('to', '', $name);
        
        if (!in_array($size, self::$sizes)) {
            throw new \Exception("Undefined method `${name}`. The only available methods are to" . implode(', to', self::$sizes) . ".");
        }
        
        return $this->convert($size);
    }
    
    /**
     * Magic property used to return bytes as a different (higher) unit
     * 
     * @param string $name
     * @return float
     * @throws \Exception
     */
    public function __get(string $name): float
    {
        if (!in_array($name, self::$sizes)) {
            throw new \Exception("Undefined property `${name}`. The only available properties are " . implode(', ', self::$sizes) . ".");
        }
        
        return $this->convert($name);
    }
    
    /**
     * Returns back the bytes amount of the initial object is echoed out
     * 
     * @return string
     */
    public function __toString(): string
    {
        return self::$bytes;
    }

    /**
     * Converts the bytes property into a higher unit via division
     * The number 1024 is set to a power of x, where x is the index of the sizes array matched to the name of the method used
     * 
     * @param string $name
     * @return float
     */
    private function convert(string $name): float
    {
        $divisor = pow(1024, array_search($name, self::$sizes));

        return self::$bytes / $divisor;
    }
}
