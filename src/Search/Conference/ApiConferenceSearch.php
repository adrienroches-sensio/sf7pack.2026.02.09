<?php

declare(strict_types=1);

namespace App\Search\Conference;

use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsAlias(ConferenceSearchInterface::class)]
final class ApiConferenceSearch implements ConferenceSearchInterface
{
    public function __construct(
        private readonly HttpClientInterface $client,

        #[Autowire(env: 'CONFERENCES_API_KEY')]
        private readonly string $apiKey,
    ) {
    }

    public function searchByName(?string $name = null): array
    {
        $options = [
            'headers' => [
                'apikey' => $this->apiKey,
                'accept' => 'application/json'
            ],
        ];

        $name = trim($name ?? '');

        if ('' !== $name) {
            $options['query'] ??= [];
            $options['query']['name'] = $name;
        }

        $response = $this->client->request('GET', 'https://devevents-api.fr/events', $options);
        dump($response->toArray());

        return [];
    }
}
