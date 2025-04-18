<?php
namespace Models;

class Episode
{
    private static $apiUrl = 'https://grauzone-pott.de/cms/api/episodes';

    /**
     * Get all episodes from the API.
     * 
     * @return array 
     * @throws \Exception
     */
    public static function getAll()
    {
        $json = self::fetchData(self::$apiUrl);
        $episodes = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Failed to decode JSON: " . json_last_error_msg());
        }

        return array_map(function ($episode) {
            return self::extractEpisodeData($episode);
        }, $episodes);
    }

    /**
     * Get a specific episode by ID.
     * 
     * @param int 
     * @return array|null 
     * @throws \Exception
     */
    public static function getById($id)
    {
        $url = self::$apiUrl . '?rid=' . $id; 
        $json = self::fetchData($url);

        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("JSON decoding error: " . json_last_error_msg());
        }

        return isset($data[0]) ? self::extractEpisodeData($data[0]) : null;
    }


    /**
     * Fetch data from the given API URL.
     * 
     * @param string $url
     * @return string 
     * @throws \Exception
     */
    private static function fetchData($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \Exception('Curl error: ' . curl_error($ch));
        }

        curl_close($ch);
        return $response;
    }

    /**
     * Extract relevant episode data from the API response.
     * 
     * @param array $data 
     * @return array 
     */
    private static function extractEpisodeData($data)
    {
        return [
            'id' => $data['field_reihenfolge'][0]['value'] ?? null,
            'title' => $data['title'][0]['value'] ?? 'Untitled',
            'subtitle' => $data['field_titel'][0]['value'] ?? 'Untitled',
            'description' => $data['field_description'][0]['value'] ?? 'No description available',
            'shownotes' => $data['field_shownotes'][0]['value'] ?? 'No description available',
            'transkript' => $data['field_transkript'][0]['value'] ?? 'No description available',
            'transkript-url' => $data['field_transkript_datei'][0]['url'] ?? 'No description available',
            'deezer-url' => $data['field_deezer_url'][0]['value'] ?? 'No description available',
            'amazon-url' => $data['field_amazon_url'][0]['value'] ?? 'No description available',
            'apple-url' => $data['field_apple_url'][0]['value'] ?? 'No description available',
            'youtube-url' => $data['field_youtube_url'][0]['value'] ?? 'No description available',
            'castbox-url' => $data['field_castbox_url'][0]['value'] ?? 'No description available',
            'spotify-url' => $data['field_spotify_url'][0]['value'] ?? 'No description available',
            'playerfm-url' => $data['field_playerfm_url'][0]['value'] ?? 'No description available',
            'wissen-url' => $data['field_wissen_url'][0]['value'] ?? 'No description available',
            'audio_url' => $data['field_url_audio'][0]['value'] ?? null,
            'author' => $data['field_itunes_author'][0]['value'] ?? 'Unknown',
            'copyright' => $data['field_copyright'][0]['value'] ?? 'No copyright info',
            'language' => $data['field_language'][0]['value'] ?? 'Not specified',
            'publication_date' => $data['field_pubdate'][0]['value'] ?? null,
            'duration' => $data['field_itunes_duration'][0]['value'] ?? null,
            'explicit' => $data['field_itunes_explicit'][0]['value'] ?? 'no',
            'link' => $data['field_link'][0]['value'] ?? null,
            'summary' => $data['field_itunes_summary'][0]['value'] ?? '',
            'slug' => $data['field_slug'][0]['processed'] ?? '',
            'image-url' => $data['field_motiv'][0]['url'] ?? null,
            'image-alt' => $data['field_motiv'][0]['alt'] ?? null,
            'image-mobile-url' => $data['field_motiv_mobile'][0]['url'] ?? null,
            'image-mobile-alt' => $data['field_motiv_mobile'][0]['alt'] ?? null,
        ];
    }
}
