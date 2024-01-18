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

        //Pimper avec les infos venant du formulaire
        $content = "";
        if ($chat->getGender()!=1) {
            ($chat->getGender() == 2) ? $gender = "e femme" : $gender = " homme";
            $content .= "Je suis un" . $gender . ".";
        } 
        if ($chat->getAge()!=NULL) {
            $content .= "J'ai " . $chat->getAge() . " ans .";
        }
        if ($chat->getHairType()!=1) {
            $content .= "Mes cheveux sont " . $chat->getHairTypeLabel() . ".";
        }
        if ($chat->getHairTexture()!=1) {
            $content .= "Mes cheveux sont " . $chat->getHairTextureLabel() . '.';
        }
        if ($chat->getHairColor()!=1) {
            $content .= "Mes cheveux sont " . $chat->getHairColorLabel() . '.';
        }
        if ($chat->getSkinColor()!=1) {
            $content .= "Ma peau est de type " . $chat->getSkinColorLabel() . '.'; 
        }
        if ($chat->getSkinType()!=1) {
            $content .= "Ma peau est " . $chat->getSkinTypeLabel() . '.';
        }
        $content .= "Pourrais-tu me conseiller 3 produits L'Oréal pouvant m'aider à entretenir ma peau et mes cheveux en fonction des indications données ci-dessus. Sois concis STP.";

        $message = self::MESSAGE;

        $message['messages'] = [
            self::CONSEIL,
            [
                "role" => "user",
                "content" => "$content"
            ]
        ];

        $response = $client->chat()->create($message);

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
