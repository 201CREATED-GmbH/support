<?php

namespace C201\Support\Tests\Enum;

use C201\Support\Enum\Enum;

/**
 * @author Marko Vujnovic <mv@201created.de>
 * @since  2020-07-06
 *
 * @method static $this testKonst1()
 * @method static $this testKonst2()
 */
class EnumTestProxy2 extends Enum
{
    const TEST_KONST_1 = 'TEST_KONST_1';
    const TEST_KONST_2 = 'TEST_KONST_2';
}
