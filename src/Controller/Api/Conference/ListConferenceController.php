<?php

declare(strict_types=1);

namespace App\Controller\Api\Conference;

use App\Search\Conference\ConferenceSearchInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route(
    path: '/api/conferences',
    name: 'api_conference_list',
    methods: ['GET'],
)]
final class ListConferenceController
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly ConferenceSearchInterface $conferenceSearch,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            $this->serializer->serialize($this->conferenceSearch->searchByName('202'), 'json', [
                AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function(object $object, string $format, array $context) {
                    return $object->getId();
                }
            ]),
            json: true
        );
    }
}
