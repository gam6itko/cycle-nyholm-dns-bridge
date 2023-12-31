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

    public function testWithCharset(): void
    {
        $config = new NyholmDsnConnectionConfig('mysql://root:root@mysql:3306/my_database_name?charset=utf8mb4');
        self::assertSame(
            'mysql:host=mysql;port=3306;dbname=my_database_name;charset=utf8mb4',
            $config->getDsn()
        );
    }

    public function testSetOptions(): void
    {
        $config = new NyholmDsnConnectionConfig(
            'mysql://root:root@mysql/dbname',
            [
                'option-name' => 'option-value',
            ]
        );
        self::assertEquals([
            \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "UTF8"',
            \PDO::ATTR_STRINGIFY_FETCHES => false,
            'option-name' => 'option-value',
        ], $config->getOptions());
    }
}
