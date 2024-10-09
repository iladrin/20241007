<?php

namespace App\Event;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Mailer\Event\MessageEvent;

#[AsEventListener]
readonly class DemoListener
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function __invoke(MessageEvent $event): void
    {
        $this->logger->info('DemoListener: Sending message somehow');
    }
}
