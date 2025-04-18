<?php
namespace Controllers;

class PageController extends BaseController {
    public function datenschutz() {
        $this->setPageMeta('datenschutz');
        $this->render('datenschutz');
    }

    public function impressum() {
        $this->setPageMeta('impressum');
        $this->render('impressum');
    }

    public function kontakt() {
        $this->setPageMeta('kontakt');
        $this->render('kontakt');
    }

    public function about() {
        $this->setPageMeta('about');
        $this->render('about');
    }

    public function presse() {
        $this->setPageMeta('presse');
        $this->render('presse');
    }

    public function generate() {
        include '/view/sitemap.php';
    }
    
}