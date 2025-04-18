<?php
namespace Controllers;

use Models\Episode;

class EpisodeController extends BaseController {
    public function index() {
        $episodes = Episode::getAll();

        $this->setPageMeta('episoden'); 

        $this->render('episodes', ['episodes' => $episodes]);
    }

    public function show($id, $slug) {
        $episode = Episode::getById($id);

        if ($episode) {
            if (isset($episode['slug']) && $slug !== $episode['slug']) {
                header("Location: /episode/{$id}/{$episode['slug']}", true, 301);
                exit;
            }

            $this->setMeta('title', $episode['title'] . ': '. $episode['subtitle'] . ' | Grauzone Pott - Ein Doku-Podcast');
            $this->setMeta('description', $episode['description']);
            $this->setMeta('keywords', $episode['title'] . ', podcast, episode');
            $this->setMeta('ogTitle', $episode['title']);
            $this->setMeta('ogDescription', $episode['description']);
            $this->setMeta('ogUrl', "https://www.grauzonepott.com/episode/{$id}/{$slug}");
            $this->setMeta('ogType', 'article');
            $this->setMeta('twitterTitle', $episode['title']);
            $this->setMeta('twitterDescription', $episode['description']);

            $this->render('episode', ['episode' => $episode]);
        } else {
            $this->render404();
        }
    }
}