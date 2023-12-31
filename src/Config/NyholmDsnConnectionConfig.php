<?php

declare(strict_types=1);

namespace Gam6itko\Cycle\Database\Config;

use Cycle\Database\Config\MySQL\ConnectionConfig;
use Cycle\Database\Config\ProvidesSourceString;
use Nyholm\Dsn\Configuration\Dsn;
use Nyholm\Dsn\DsnParser;

class NyholmDsnConnectionConfig extends ConnectionConfig implements ProvidesSourceString
{
    public Dsn $dsn;

    public function __construct(string $dsnString)
    {
        $this->dsn = DsnParser::parse($dsnString);
        parent::__construct($this->dsn->getUser(), $this->dsn->getPassword(), $this->dsn->getParameters());
    }

    public function getDsn(): string
    {
        $result = sprintf(
            "%s:host=%s;%sdbname=%s",
            $this->getName(),
            $this->dsn->getHost(),
            $this->dsn->getPort() ? "port={$this->dsn->getPort()};" : '',
            ltrim($this->dsn->getPath(), '/')
        );

        if ($charset = $this->dsn->getParameter('charset')) {
            $result .= ";charset=$charset";
        }

        return $result;
    }

    public function getSourceString(): string
    {
        return ltrim($this->dsn->getPath(), '/');
    }
}
