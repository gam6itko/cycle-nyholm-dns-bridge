<?php

declare(strict_types=1);

namespace Gam6itko\Cycle\Database\Test\Config;

use Gam6itko\Cycle\Database\Config\NyholmDsnConnectionConfig;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Gam6itko\Cycle\Database\Config\NyholmDsnConnectionConfig
 */
final class NyholmDsnConnectionConfigTest extends TestCase
{
    public function testWithoutPort(): void
    {
        $config = new NyholmDsnConnectionConfig('mysql://root:root@mysql/my_database_name');
        self::assertSame(
            'mysql:host=mysql;dbname=my_database_name',
            $config->getDsn()
        );
    }

    public function testWithPort(): void
    {
        $config = new NyholmDsnConnectionConfig('mysql://root:root@mysql:3306/my_database_name');
        self::assertSame(
            'mysql:host=mysql;port=3306;dbname=my_database_name',
            $config->getDsn()
        );
    }
}
