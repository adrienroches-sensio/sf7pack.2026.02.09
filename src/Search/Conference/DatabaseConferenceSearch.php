<?php

declare(strict_types=1);

namespace App\Search\Conference;

use App\Entity\Conference;
use App\Repository\ConferenceRepositoryInterface;

final class DatabaseConferenceSearch
{
    public function __construct(
        private readonly ConferenceRepositoryInterface $conferenceRepository
    ) {
    }

    /**
     * @return list<Conference>
     */
    public function searchByName(string|null $name = null): array
    {
        if (null === $name) {
            return $this->conferenceRepository->listAll();
        }

        return $this->conferenceRepository->searchByName($name);
    }
}
