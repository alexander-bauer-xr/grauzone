<?php
namespace Controllers;

use Models\Quote;

class HomeController extends BaseController {
    public function index() {
        $this->setPageMeta('default');

        $quote = Quote::getRandom();

        $this->render('index', ['quote' => $quote['text'], 'author' => $quote['author']]);
    }
}