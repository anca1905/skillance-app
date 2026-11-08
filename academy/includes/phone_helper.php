<?php
/**
 * Skillance Academy - Phone & WhatsApp Helper
 * Strict Indonesian Phone Number Validation & WA Dispatcher
 */

if (!function_exists('validateIndonesianPhone')) {
    function validateIndonesianPhone($phone) {
        $clean = preg_replace('/[^0-9]/', '', (string)$phone);
        
        // Normalize leading 0 or 8 to 62
        if (strpos($clean, '0') === 0) {
            $clean = '62' . substr($clean, 1);
        } elseif (strpos($clean, '8') === 0) {
            $clean = '62' . $clean;
        }

        // Must start with 628 and have 10-13 digits local (total 11 to 14 chars with 62)
        if (!preg_match('/^628[0-9]{8,11}$/', $clean)) {
            return [
                'valid' => false, 
                'message' => 'Nomor harus 10-13 digit angka aktif Indonesia dan diawali 08 / 628.'
            ];
        }

        $localPrefix = '0' . substr($clean, 2, 3); // e.g. 0822, 0852, 0812

        $operators = [
            'Telkomsel' => ['0811','0812','0813','0821','0822','0823','0851','0852','0853'],
            'Indosat Ooredoo' => ['0814','0815','0816','0855','0856','0857','0858'],
            'XL Axiata' => ['0817','0818','0819','0859','0877','0878'],
            'Axis' => ['0831','0832','0833','0838'],
            'Tri (3)' => ['0895','0896','0897','0898','0899'],
            'Smartfren' => ['0881','0882','0883','0884','0885','0886','0887','0888','0889']
        ];

        $matchedOperator = null;
        foreach ($operators as $op => $prefixes) {
            if (in_array($localPrefix, $prefixes)) {
                $matchedOperator = $op;
                break;
            }
        }

        if (!$matchedOperator) {
            return [
                'valid' => false, 
                'message' => "Prefix '$localPrefix' bukan nomor seluler Indonesia yang terdaftar."
            ];
        }

        $suffix = substr($clean, 5); // remaining 6-9 digits
        
        // Reject all identical digits in suffix (e.g. 081211111111)
        if (preg_match('/^(.)\1+$/', $suffix)) {
            return [
                'valid' => false, 
                'message' => 'Nomor WhatsApp terindikasi nomor palsu (angka berulang).'
            ];
        }

        // Reject obvious fake patterns (e.g. 99887766, 123456, 112233)
        if (preg_match('/(12345|54321|998877|9988|7766|112233|00000)/', $suffix)) {
            return [
                'valid' => false, 
                'message' => 'Nomor WhatsApp terindikasi nomor acak/palsu. Mohon masukkan nomor aktif Anda.'
            ];
        }

        return [
            'valid' => true,
            'phone' => $clean,
            'formatted' => '0' . substr($clean, 2),
            'operator' => $matchedOperator
        ];
    }
}

if (!function_exists('sendWhatsAppMessage')) {
    function sendWhatsAppMessage($phone, $message) {
        // 1. Try local node gateway at port 3000
        $gatewayUrl = 'http://127.0.0.1:3000/send';
        $payload = json_encode(['phone' => $phone, 'message' => $message]);

        $ch = curl_init($gatewayUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        curl_close($ch);

        if (!$err && $httpCode >= 200 && $httpCode < 300) {
            $json = json_decode($response, true);
            if (!empty($json['status']) && $json['status'] === 'success') {
                return ['success' => true, 'channel' => 'local_gateway', 'response' => $json];
            }
        }

        // 2. Fallback: Simulation/Dev mode (Gateway is standby or offline)
        return [
            'success' => false,
            'channel' => 'standby',
            'message' => 'WhatsApp Gateway lokal sedang offline/standby.'
        ];
    }
}
