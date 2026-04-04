<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    /**
     * Simulate sending a WhatsApp message.
     * In a real production environment, you would use Twilio, Ultramsg, or WhatsApp Business API here.
     * 
     * @param string $phone The recipient's phone number
     * @param string $message The message content
     * @return bool
     */
    public function sendMessage(string $phone, string $message)
    {
        // For development/demonstration, we log the SMS instead of paying for a real API.
        Log::channel('single')->info("====== WHATSAPP NOTIFICATION SIMULATION ======");
        Log::channel('single')->info("TO: " . $phone);
        Log::channel('single')->info("MESSAGE:\n" . $message);
        Log::channel('single')->info("==============================================");

        // Example of a real Ultramsg integration (Commented out):
        /*
        $token = env('ULTRAMSG_TOKEN');
        $instanceId = env('ULTRAMSG_INSTANCE_ID');
        
        $response = Http::post("https://api.ultramsg.com/{$instanceId}/messages/chat", [
            'token' => $token,
            'to' => $phone,
            'body' => $message
        ]);
        
        return $response->successful();
        */

        return true;
    }

    /**
     * Send a standardized Admin Alert
     */
    public function sendAdminAlert($bookingId, $price)
    {
        $message = "🚨 *KEMET ALERT - New Booking*\n\n";
        $message .= "A new booking has just been confirmed on the platform!\n";
        $message .= "ID: {$bookingId}\n";
        $message .= "Revenue: {$price} EGP\n\n";
        $message .= "Check the admin dashboard for details.";

        // The user provided these admin numbers
        $adminNumbers = ['01003445139', '01060401644'];
        
        foreach ($adminNumbers as $number) {
            $this->sendMessage($number, $message);
        }
    }
}
