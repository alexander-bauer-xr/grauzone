<?php

namespace Controllers;

class SitemapController
{
    public function generate()
    {
        // Set the header for XML output
        header("Content-Type: application/xml; charset=utf-8");

        // Base URL of the site
        $base_url = 'https://www.grauzone-pott.de';

        // Define the static routes
        $routes = [
            '/',   // The base URL will have a special case for priority
            '/about',
            '/episoden',
            '/presse',
            '/datenschutz',
            '/impressum',
            '/kontakt'
        ];

        // Fetch episode data from API
        $api_url = "$base_url/cms/api/episodes";
        $episodes = [];
        try {
            $response = file_get_contents($api_url);
            if ($response) {
                $episodes = json_decode($response, true); // Assuming API returns JSON
            }
        } catch (\Exception $e) {
            error_log("Error fetching episodes: " . $e->getMessage());
        }

        // Start building the XML
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Add static routes to the sitemap
        foreach ($routes as $route) {
            echo '<url>';
            echo '<loc>' . htmlspecialchars($base_url . $route) . '</loc>';

            // Set priority based on whether it's the base URL
            if ($route === '/') {
                echo '<priority>1.0</priority>'; // Higher priority for the base URL
            } else {
                echo '<priority>0.8</priority>';
            }

            echo '<changefreq>monthly</changefreq>';
            echo '</url>';
        }

        // Add dynamic episode routes to the sitemap
        if (!empty($episodes)) {
            foreach ($episodes as $episode) {
                if (!empty($episode['field_url'][0]['value']) && !empty($episode['changed'][0]['value'])) {
                    $episode_url = $base_url . htmlspecialchars($episode['field_url'][0]['value']);
                    $lastmod = htmlspecialchars($episode['changed'][0]['value']);

                    echo '<url>';
                    echo '<loc>' . $episode_url . '</loc>';
                    echo '<lastmod>' . $lastmod . '</lastmod>';
                    echo '<changefreq>weekly</changefreq>';
                    echo '<priority>0.9</priority>';
                    echo '</url>';
                }
            }
        }

        echo '</urlset>';
    }
}

