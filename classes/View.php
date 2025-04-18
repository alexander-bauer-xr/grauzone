<?php
namespace Classes;

class View {

    /**
     * Renders a view with the given data.
     *
     * @param string $view The view file to render.
     * @param array $data Data to be extracted and used in the view.
     */
    public function render($view, $data = []) {
        extract($data);

        $viewFile = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($viewFile)) {
            include($viewFile);
        } else {
            throw new \Exception("View file '$view' not found.");
        }
    }
}
