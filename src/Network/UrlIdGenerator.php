<?php declare(strict_types = 1);

namespace Searchmetrics\SeniorTest\Network;

interface UrlIdGenerator
{
    public const PORT_HTTP = '80';
    public const PORT_HTTPS = '443';
    public const PROTOCOL_DIVIDER = '://';
    public const PROTOCOL_HTTP = 'http://';
    public const PROTOCOL_HTTPS = 'https://';

    /**
     * Generates a long integer ID from an URL.
     *
     * @param string $url
     * @return string
     */
    public function generate(string $url) : string;
}
