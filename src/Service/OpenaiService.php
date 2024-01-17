<?php

namespace App\Service;

use App\Entity\Chat;
use Doctrine\ORM\EntityManagerInterface;
use OpenAI\Client;
use OpenAI\Factory;
use OpenAI\ValueObjects\Transporter\Headers;

class OpenaiService
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    private function createClient(): Client
    {
        $apiKey = $_ENV['OPENAI_APIKEY'];
        $headers = ['apiKey' => $apiKey];
        $factory = new Factory();
        $factory->withApiKey($apiKey);
        $client = $factory->make();
    }

    public function onNewChat(Chat $chat): bool
    {
        $client = $this->createClient();

        dd($client);
    }
}
