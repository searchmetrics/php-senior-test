<?php declare(strict_types = 1);

namespace Searchmetrics\SeniorTest\Network;

final class PhpUrlIdGenerator extends AbstractUrlIdGenerator
{
    protected function generateId(string $url) : string
    {
        return '0';
    }
}
