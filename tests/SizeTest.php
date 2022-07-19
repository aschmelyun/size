<?php

use Aschmelyun\Size\Size;

it(
    'can be instantiated statically',
    function () {
        $bytes = (string) Size::B(1234);
        
        $this->assertEquals(1234, $bytes);
    }
);

it(
    'cannot be instantiated with an option outside of the sizes array',
    function () {
        Size::foo(1234);
    }
)->throws(\Exception::class, 'Undefined method `foo`. The only available methods are B, KB, MB, GB, TB, PB, EB, ZB, YB.');

it(
    'can access conversions using methods on the object',
    function () {
        $bytes = Size::MB(2);

        $this->assertEquals(2048, $bytes->toKB());
    }
);

it(
    'can access conversions using properties on the object',
    function () {
        $bytes = Size::MB(2);

        $this->assertEquals(2048, $bytes->KB);
    }
);

it(
    'cannot access conversions using methods on the object outside the sizes array',
    function () {
        $bytes = Size::MB(2)->toFoo();
    }
)->throws(\Exception::class, 'Undefined method `toFoo`. The only available methods are toB, toKB, toMB, toGB, toTB, toPB, toEB, toZB, toYB.');

it(
    'cannot access conversions using properties on the object outside the sizes array',
    function () {
        $bytes = Size::MB(2)->foo;
    }
)->throws(\Exception::class, 'Undefined property `foo`. The only available properties are B, KB, MB, GB, TB, PB, EB, ZB, YB.');

it(
    'can convert bytes to KB, MB, GB, and TB',
    function () {
        $bytes = Size::B(1099511627776);

        $this->assertEquals(1073741824, $bytes->KB);

        $this->assertEquals(1048576, $bytes->MB);

        $this->assertEquals(1024, $bytes->GB);

        $this->assertEquals(1, $bytes->TB);
    }
);

it(
    'can convert KB, MB, GB, and TB to bytes',
    function () {
        $bytes = Size::TB(1);

        $this->assertEquals(1099511627776, $bytes->B);

        $this->assertEquals(1073741824, $bytes->KB);

        $this->assertEquals(1024, $bytes->GB);

        $this->assertEquals(1, $bytes->TB);

        $bytes = Size::MB(1);

        $this->assertEquals(1048576, $bytes->B);

        $this->assertEquals(1024, $bytes->KB);

        $this->assertEquals(1, $bytes->MB);
        
        $this->assertEquals(0.0009765625, $bytes->GB);
    }
);