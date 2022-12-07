<?php declare(strict_types=1);

namespace App\Quote;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

final class Quote
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Quote constructor.
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->client = new Client(['base_uri' => 'https://api.quotable.io', 'verify' => false]);
    }

    /**
     * @return string
     */
    public function getQuote(): string
    {
        $this->logger->info('Getting a new qoute');

        $response = $this->client->get('random');
        $contents = json_decode($response->getBody()->getContents(), true);

        $this->logger->info("Got a new qoute: {$contents['content']}");

        return $contents['content'];
    }
}
