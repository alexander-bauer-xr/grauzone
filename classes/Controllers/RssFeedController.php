<?php
namespace Controllers;

use Models\Episode;

class RssFeedController extends BaseController {
    public function index() {
        // Fetch all episodes
        $episodes = Episode::getAll();

        // Get the current time for Last-Modified header
        $lastModified = gmdate(DATE_RFC2822, time());

        // Generate a simple ETag based on content hash
        $etag = md5(json_encode($episodes));

        // Set headers for caching
        header('Content-Type: application/rss+xml; charset=utf-8');
        header('Last-Modified: ' . $lastModified);
        header('ETag: "' . $etag . '"');

        // Check if the content has changed
        if (
            isset($_SERVER['HTTP_IF_NONE_MATCH']) && 
            $_SERVER['HTTP_IF_NONE_MATCH'] === $etag
        ) {
            // Return 304 Not Modified if the content hasn't changed
            header('HTTP/1.1 304 Not Modified');
            exit();
        }

        // Generate RSS feed
        $rssContent = $this->generateRssFeed($episodes);

        // Save the RSS feed to the root directory as rss.xml
        file_put_contents(__DIR__ . '/../../rss.xml', $rssContent);

        // Output the RSS feed
        echo $rssContent;
    }

    private function generateRssFeed($episodes) {
        // Determine the current URL dynamically
        $rssFeedUrl = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '.xml';

        $rssFeed = '<?xml version="1.0" encoding="UTF-8" ?>' . PHP_EOL;
        // Add necessary namespaces: iTunes, Atom, and Podcast
        $rssFeed .= '<rss version="2.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:podcast="https://podcastindex.org/namespace/1.0">' . PHP_EOL;
        $rssFeed .= '<channel>' . PHP_EOL;

        // Channel-level metadata
        $rssFeed .= '<title>Grauzone Pott</title>' . PHP_EOL;
        $rssFeed .= '<link>https://www.grauzone-pott.de</link>' . PHP_EOL;
        $rssFeed .= '<description>Grauzone Pott beleuchtet die bisher unbeachtete Geschichte von migrantischem Widerstand und neonazistischer Gewalt im Ruhrgebiet der 1980er und 1990er Jahre.</description>' . PHP_EOL;
        $rssFeed .= '<language>de-de</language>' . PHP_EOL;

        // Add atom:link with the self-referencing feed URL
        $rssFeed .= '<atom:link href="' . htmlspecialchars($rssFeedUrl, ENT_XML1, 'UTF-8') . '" rel="self" type="application/rss+xml" />' . PHP_EOL;

        // Add general podcast image (default podcast image)
        $rssFeed .= '<itunes:image href="https://www.grauzone-pott.de/cms/sites/default/files/2024-10/Unbenannt-1.png" />' . PHP_EOL;

        // Add iTunes-specific category
        $rssFeed .= '<itunes:category text="History" />' . PHP_EOL;

        // Explicit content indicator
        $rssFeed .= '<itunes:explicit>no</itunes:explicit>' . PHP_EOL;

        // Podcast owner
        $rssFeed .= '<itunes:owner>' . PHP_EOL;
        $rssFeed .= '  <itunes:name>Grauzone Pott</itunes:name>' . PHP_EOL;
        $rssFeed .= '  <itunes:email>info@peira.space</itunes:email>' . PHP_EOL;
        $rssFeed .= '</itunes:owner>' . PHP_EOL;

        // Iterate through each episode to add item-level metadata
        foreach ($episodes as $episode) {
            $rssFeed .= '<item>' . PHP_EOL;

            // Episode title, link, description
            $rssFeed .= '<title>' . htmlspecialchars($episode['subtitle'], ENT_XML1, 'UTF-8') . '</title>' . PHP_EOL;
            $rssFeed .= '<link>https://www.grauzone-pott.de/episode/' . $episode['id'] . '/' . $episode['slug'] . '</link>' . PHP_EOL;
            $rssFeed .= '<description>' . htmlspecialchars($episode['description'], ENT_XML1, 'UTF-8') . '</description>' . PHP_EOL;

            // Enclosure with audio URL and file size
            $fileUrl = htmlspecialchars($episode['audio_url'], ENT_XML1, 'UTF-8');
            $fileSize = $this->getFileSize($fileUrl);
            $rssFeed .= '<enclosure url="' . $fileUrl . '" length="' . $fileSize . '" type="audio/mpeg" />' . PHP_EOL;

            // Episode-specific image (if available)
            if (isset($episode['image']) && $episode['image']) {
                $rssFeed .= '<itunes:image href="' . htmlspecialchars($episode['image'], ENT_XML1, 'UTF-8') . '" />' . PHP_EOL;
            }

            // Episode GUID
            $rssFeed .= '<guid>https://www.grauzone-pott.de/episode/' . $episode['id'] . '/' . $episode['slug'] . '</guid>' . PHP_EOL;

            // Publication date
            $rssFeed .= '<pubDate>' . date(DATE_RSS, strtotime($episode['publication_date'])) . '</pubDate>' . PHP_EOL;

            // iTunes-specific metadata
            $rssFeed .= '<itunes:duration>' . htmlspecialchars($episode['duration'], ENT_XML1, 'UTF-8') . '</itunes:duration>' . PHP_EOL;
            $rssFeed .= '<itunes:author>' . htmlspecialchars($episode['author'], ENT_XML1, 'UTF-8') . '</itunes:author>' . PHP_EOL;

            // Close item
            $rssFeed .= '</item>' . PHP_EOL;
        }

        // Close channel and RSS
        $rssFeed .= '</channel>' . PHP_EOL;
        $rssFeed .= '</rss>' . PHP_EOL;

        return $rssFeed;
    }

    // Helper function to get the file size of the audio file
    private function getFileSize($fileUrl) {
        $headers = get_headers($fileUrl, 1);

        if (isset($headers['Content-Length'])) {
            return $headers['Content-Length'];
        }

        return 0; // Return 0 if file size can't be determined
    }
}