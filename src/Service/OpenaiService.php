<?php

namespace App\Service;

use App\Entity\Chat;
use Doctrine\ORM\EntityManagerInterface;
use OpenAI\Client;
use OpenAI\Factory;
use OpenAI\ValueObjects\Transporter\Headers;

class OpenaiService
{
    CONST MESSAGE = [
        "model"=> "gpt-3.5-turbo",
        "messages" => [
        ]
    ];

    CONST CONSEIL = [
        "role" => "system",
        "content" => "Tu es un expert produit et beauté de chez L'Oréal"
    ];

    CONST TUTO = [
        "role" => "system",
        "content" => "Tu es un expert en application de produits de beauté, au sens large du terme, de chez L'Oréal"
    ];

    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    private function createClient(): Client
    {
        //Initialisation de l'API Key
        $apiKey = $_ENV['OPENAI_APIKEY'];
        $organisationID = $_ENV['OPENAI_ORGANISATION_ID'];
        //Création de l'objet Factory, qui permet la création du Client (avec la clé API)
        $factory = new Factory();
        $factory->withApiKey($apiKey);
        $factory->withOrganization($organisationID);
        $client = $factory->make();

        return $client;
    }

    public function onNewChat(Chat $chat): bool
    {
        $client = $this->createClient();

        //TODO: remplacer par les infos venant du formulaire
        $content = "je viens du front";
        $message = self::MESSAGE;

        $message['messages'] = [
            self::CONSEIL,
            [
                "role" => "user",
                "content" => "$content"
            ]
        ];

        //$response = $client->chat()->create($message);

        //Venir créer un objet Message, en stockant le $content envoyé à chatGPT (texte envoyé) et le ["message"]["content"] renvoyé par chatGPT (texte reçu)

        $message = new Message;
        $message->setSent($content);
        $message->setReceived($response->choices['message']['content']);
        $message->setChat($chat);

        $this->entityManager->persist($message);
        $this->entityManager->flush();

        dd($response->choices);
    }
}
