<?php
namespace Controllers;

use Classes\View;

class BaseController
{
    protected $meta;

    public function __construct()
    {
        $config = include __DIR__ . '/../../config/meta.php';  
        $this->meta = $config['default']; 
    }

    /**
     * Set specific meta for a page from the config file.
     *
     * @param string $page The key in the meta configuration (e.g., 'datenschutz', 'impressum').
     */
    public function setPageMeta($page)
    {
        $config = include __DIR__ . '/../../config/meta.php'; 

        if (isset($config[$page])) {
            $this->meta = array_merge($this->meta, $config[$page]);
        }
    }

    /**
     * Set a specific meta tag value.
     *
     * @param string $key The meta tag key (e.g., title, description).
     * @param string $value The meta tag value.
     */
    public function setMeta($key, $value)
    {
        $this->meta[$key] = $value;
    }

    /**
     * Get all meta information.
     *
     * @return array The meta information array.
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Render the view and pass meta data.
     *
     * @param string $view The view file to render.
     * @param array $data Data to pass to the view.
     */
    protected function render($view, $data = [])
    {
        $data['meta'] = $this->getMeta();

        $viewInstance = new View();
        $viewInstance->render($view, $data);
    }

    /**
     * Render a 404 page with specific meta tags.
     */
    protected function render404()
    {
        $this->setPageMeta('404'); 
        header("HTTP/1.0 404 Not Found");
        $this->render('404');
    }
}
