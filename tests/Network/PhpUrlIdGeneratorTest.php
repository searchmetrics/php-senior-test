<?php declare(strict_types = 1);

namespace Searchmetrics\SeniorTest\Tests\Network;

use PHPUnit\Framework\TestCase;
use Searchmetrics\SeniorTest\Network\PhpUrlIdGenerator;
use Searchmetrics\SeniorTest\Network\UrlIdGenerator;

final class PhpUrlIdGeneratorTest extends TestCase
{
    /**
     * @test
     */
    public function instantiation_works() : void
    {
        $generator = new PhpUrlIdGenerator();

        self::assertInstanceOf(PhpUrlIdGenerator::class, $generator);
        self::assertInstanceOf(UrlIdGenerator::class, $generator);
    }

    /**
     * @return mixed[]
     */
    public function provideGeneratorExpectations() : array
    {
        $providers = [];

        $file = \fopen(__DIR__ . '/../Resources/url_ids.txt', 'r');

        if (false !== $file) {
            while (($line = \fgets($file)) !== false) {
                $providers[] = \explode("\t|\t", \trim($line));
            }

            \fclose($file);
        }

        return $providers;
    }

    /**
     * @test
     * @dataProvider provideGeneratorExpectations
     */
    public function generate_withValidUrl_returnsUrlId(string $url, string $expectedId) : void
    {
        $generatedId = (new PhpUrlIdGenerator())->generate($url);

        self::assertSame(
            $expectedId,
            $generatedId,
            \sprintf('Expected URL ID generator to return ID [%s], got [%s] instead.', $expectedId, $generatedId)
        );
    }
}
