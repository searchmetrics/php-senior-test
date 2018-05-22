<?php declare(strict_types = 1);

namespace Searchmetrics\SeniorTest\Network;

abstract class AbstractUrlIdGenerator implements UrlIdGenerator
{
    /**
     * Map of all hex representations of ASCII special chars.
     *
     * @var string[]
     * @see http://www.w3schools.com/tags/ref_urlencode.asp
     */
    private const ASCII_ENCODINGS = [
        '%20',
        '%21',
        '%22',
        '%23',
        '%24',
        '%25',
        '%26',
        '%27',
        '%28',
        '%29',
        '%2A',
        '%2B',
        '%2C',
        '%2D',
        '%2E',
        '%2F',
        '%30',
        '%31',
        '%32',
        '%33',
        '%34',
        '%35',
        '%36',
        '%37',
        '%38',
        '%39',
        '%3A',
        '%3B',
        '%3C',
        '%3D',
        '%3E',
        '%3F',
        '%40',
        '%41',
        '%42',
        '%43',
        '%44',
        '%45',
        '%46',
        '%47',
        '%48',
        '%49',
        '%4A',
        '%4B',
        '%4C',
        '%4D',
        '%4E',
        '%4F',
        '%50',
        '%51',
        '%52',
        '%53',
        '%54',
        '%55',
        '%56',
        '%57',
        '%58',
        '%59',
        '%5A',
        '%5B',
        '%5C',
        '%5D',
        '%5E',
        '%5F',
        '%60',
        '%61',
        '%62',
        '%63',
        '%64',
        '%65',
        '%66',
        '%67',
        '%68',
        '%69',
        '%6A',
        '%6B',
        '%6C',
        '%6D',
        '%6E',
        '%6F',
        '%70',
        '%71',
        '%72',
        '%73',
        '%74',
        '%75',
        '%76',
        '%77',
        '%78',
        '%79',
        '%7A',
        '%7B',
        '%7C',
        '%7D',
        '%7E',
        '%7F',
        '%E2%82%AC',
        '%81',
        '%E2%80%9A',
        '%C6%92',
        '%E2%80%9E',
        '%E2%80%A6',
        '%E2%80%A0',
        '%E2%80%A1',
        '%CB%86',
        '%E2%80%B0',
        '%C5%A0',
        '%E2%80%B9',
        '%C5%92',
        '%C5%8D',
        '%C5%BD',
        '%8F',
        '%C2%90',
        '%E2%80%98',
        '%E2%80%99',
        '%E2%80%9C',
        '%E2%80%9D',
        '%E2%80%A2',
        '%E2%80%93',
        '%E2%80%94',
        '%CB%9C',
        '%E2%84',
        '%C5%A1',
        '%E2%80',
        '%C5%93',
        '%9D',
        '%C5%BE',
        '%C5%B8',
        '%C2%A0',
        '%C2%A1',
        '%C2%A2',
        '%C2%A3',
        '%C2%A4',
        '%C2%A5',
        '%C2%A6',
        '%C2%A7',
        '%C2%A8',
        '%C2%A9',
        '%C2%AA',
        '%C2%AB',
        '%C2%AC',
        '%C2%AD',
        '%C2%AE',
        '%C2%AF',
        '%C2%B0',
        '%C2%B1',
        '%C2%B2',
        '%C2%B3',
        '%C2%B4',
        '%C2%B5',
        '%C2%B6',
        '%C2%B7',
        '%C2%B8',
        '%C2%B9',
        '%C2%BA',
        '%C2%BB',
        '%C2%BC',
        '%C2%BD',
        '%C2%BE',
        '%C2%BF',
        '%C3%80',
        '%C3%81',
        '%C3%82',
        '%C3%83',
        '%C3%84',
        '%C3%85',
        '%C3%86',
        '%C3%87',
        '%C3%88',
        '%C3%89',
        '%C3%8A',
        '%C3%8B',
        '%C3%8C',
        '%C3%8D',
        '%C3%8E',
        '%C3%8F',
        '%C3%90',
        '%C3%91',
        '%C3%92',
        '%C3%93',
        '%C3%94',
        '%C3%95',
        '%C3%96',
        '%C3%97',
        '%C3%98',
        '%C3%99',
        '%C3%9A',
        '%C3%9B',
        '%C3%9C',
        '%C3%9D',
        '%C3%9E',
        '%C3%9F',
        '%C3%A0',
        '%C3%A1',
        '%C3%A2',
        '%C3%A3',
        '%C3%A4',
        '%C3%A5',
        '%C3%A6',
        '%C3%A7',
        '%C3%A8',
        '%C3%A9',
        '%C3%AA',
        '%C3%AB',
        '%C3%AC',
        '%C3%AD',
        '%C3%AE',
        '%C3%AF',
        '%C3%B0',
        '%C3%B1',
        '%C3%B2',
        '%C3%B3',
        '%C3%B4',
        '%C3%B5',
        '%C3%B6',
        '%C3%B7',
        '%C3%B8',
        '%C3%B9',
        '%C3%BA',
        '%C3%BB',
        '%C3%BC',
        '%C3%BD',
        '%C3%BE',
        '%C3%BF',
    ];

    /**
     * Parses an URL to find the expected default port as well as the actual one being used.
     *
     * @param string $url
     * @return string[]
     */
    private function determinePort(string $url) : array
    {
        $protocol = (0 === \strpos($url, self::PROTOCOL_HTTPS) ? self::PROTOCOL_HTTPS : self::PROTOCOL_HTTP);

        $defaultPort = (self::PROTOCOL_HTTPS === $protocol ? self::PORT_HTTPS : self::PORT_HTTP);
        $actualPort = '1337';

        return [$defaultPort, $actualPort];
    }

    /**
     * Checks if the URL starts with the given protocol.
     */
    private function hasProtocol(string $url, ?string $protocol = null) : bool
    {
        return false;
    }

    /**
     * Checks if the URL contains another URL as a query parameter.
     */
    private function hasUrlParameter(string $url) : bool
    {
        return true;
    }

    private function normalizeUrl(string $url) : string
    {
        switch (true) {
            case $this->hasProtocol($url, self::PROTOCOL_HTTP):
                $url = $this->removePort($url);
                break;

            case $this->hasProtocol($url, self::PROTOCOL_HTTPS):
                $url = $this->removePort($url);
                break;

            // This leads to URLs with non-http protocols being prefixed with http
            // but is the expected behavior at this point and therefore can't be changed
            case ($this->hasProtocol($url) === false || $this->hasUrlParameter($url)):
                $url = $this->removePort(self::PROTOCOL_HTTP . $url);
                break;
        }

        // Replace lowercase ASCII encoded characters with uppercase
        $url = \str_ireplace(self::ASCII_ENCODINGS, self::ASCII_ENCODINGS, $url);

        return $url;
    }

    /**
     * Removes the port from the authority of an URL.
     *
     * @param string $url
     * @return string
     */
    private function removePort(string $url) : string
    {
        [$defaultPort, $actualPort] = $this->determinePort($url);

        if ($defaultPort === $actualPort) {
            $url = \preg_replace("#:$defaultPort#", '', $url, 1);
        }

        return $url;
    }

    /**
     * Generates a long integer ID from an URL.
     */
    final public function generate(string $url) : string
    {
        $url = \trim($url);

        if ($url === '') {
            throw new \InvalidArgumentException('URL string must not be empty!');
        }

        return $this->generateId($this->normalizeUrl($url));
    }

    abstract protected function generateId(string $url) : string;
}
