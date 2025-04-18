<?php
namespace Models;

class Quote {
    private static $apiUrl = 'https://grauzone-pott.de/cms/api/quotes';

    public static function getRandom() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout after 10 seconds

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception('Curl error: ' . curl_error($ch));
        }

        curl_close($ch);

        $quotes = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("JSON decoding error: " . json_last_error_msg());
        }

        // Extract the quote from the JSON response.
        $randomQuote = $quotes[array_rand($quotes)];
        
        // Assuming the actual quote is in the "body" field.
        $quoteText = $randomQuote['body'][0]['value'] ?? 'Quote not available';
        $author = $randomQuote['field_autor'][0]['value'] ?? 'Unknown Author';

        return [
            'text' => $quoteText,
            'author' => $author,
        ];
    }
}