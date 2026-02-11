<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Conference;
use DateTimeImmutable;
use InvalidArgumentException;

interface ConferenceRepositoryInterface
{
    /**
     * @return list<Conference>
     *
     * @throws InvalidArgumentException When both $start and $end are null. (At least one must be provided)
     */
    public function searchBetweenDates(DateTimeImmutable|null $start, DateTimeImmutable|null $end): array;

    /**
     * @return list<Conference>
     */
    public function listAll(): array;
}
