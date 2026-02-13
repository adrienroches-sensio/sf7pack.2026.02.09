<?php

declare(strict_types=1);

namespace App\Conference;

use App\Conference\Event\ConferenceSubmittedEvent;
use Psr\Clock\ClockInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class ConferenceSubscriber
{
    public function __construct(
        private readonly ClockInterface $clock,
    ) {
    }

    #[AsEventListener]
    public function rejectConferenceIfTooFarInTheFuture(ConferenceSubmittedEvent $event): void
    {
        if ($event->conference->getStartAt() < $this->clock->now()->modify('+2 years')) {
            return ;
        }

        $event->reject('The conference is too far in the future (maximum 2 years ahead).');
    }
}
