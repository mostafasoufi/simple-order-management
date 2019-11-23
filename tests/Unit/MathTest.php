<?php

namespace Tests\Unit;

use Tests\TestCase;
use function App\Http\Helper\Percent;

class MathTest extends TestCase
{
    /**
     * Discount test.
     *
     * @return void
     */
    public function testDiscount()
    {
        $value = Percent(2000, 20);
        $this->assertEquals($value, 1600);
    }
}
