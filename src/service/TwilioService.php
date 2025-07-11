<?php
namespace App\Service;

use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;

class TwilioService {
    private Client $client;
    private string $fromNumber;
    
    public function __construct() {
        $accountSid = $_ENV['TWILIO_ACCOUNT_SID'] ?? '';
        $authToken = $_ENV['TWILIO_AUTH_TOKEN'] ?? '';
        $this->fromNumber = $_ENV['TWILIO_PHONE_NUMBER'] ?? '';
        
        if (empty($accountSid) || empty($authToken) || empty($this->fromNumber)) {
            throw new \RuntimeException("Configuration Twilio manquante dans .env");
        }
        
        $this->client = new Client($accountSid, $authToken);
    }
    
    public function envoyerMessageValidation(string $telephone, string $nom): bool {
        try {
            $message = "Bonjour $nom, votre inscription sur MaxitSA a été effectuée avec succès ! Bienvenue dans notre service.";
            
            // Format du numéro pour Sénégal (+221)
            $numeroFormate = '+221' . $telephone;
            
            $this->client->messages->create(
                $numeroFormate,
                [
                    'from' => $this->fromNumber,
                    'body' => $message
                ]
            );
            
            return true;
            
        } catch (TwilioException $e) {
            error_log("Erreur Twilio: " . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            error_log("Erreur envoi SMS: " . $e->getMessage());
            return false;
        }
    }
}