# Grauzone Pott – Documentary Podcast Website

**Grauzone Pott** is a documentary podcast about migrant resistance and neo-Nazi violence in Germany's Ruhr region during the 1980s and 1990s. The website serves as a central hub for all episodes, show notes, transcripts, and metadata – supported by a headless CMS API and an object-oriented PHP setup.

## 🔧 Project Structure

```
grauzone-pott.de/
│
├── classes/
│   ├── Controllers/         # All controllers for page management
│   ├── Models/              # Data models (e.g., Episode)
│   ├── View.php             # Rendering logic
│   ├── Router.php           # Simple routing solution
│
├── config/meta.php          # Metadata for each page
├── views/                   # Pages (HTML/PHP templates)
├── partials/                # Common parts like header, footer, assets
├── css/, js/, font/, img/   # Static assets
```

## Functionality

- The site uses a minimalist MVC system in PHP.
- Data (episodes etc.) is fetched via cURL from an API (`Models/Episode.php`).
- `Router.php` matches the URL to a defined route and calls the corresponding controller/action.
- Metadata is dynamically loaded from `meta.php` and provided by `BaseController.php`.

## Example: Displaying an Episode

```php
// Route: /episode/1/for-example
$router->add('/episode/(\d+)/([\w-]+)', 'EpisodeController', 'show');
```

The `EpisodeController` loads the episode by its ID, checks the slug (for SEO), sets the meta tags, and renders the `episode` view with the episode data.

## Example Data Model: `Episode`

```php
public static function getById($id)
{
    $url = self::$apiUrl . '?rid=' . $id;
    $json = self::fetchData($url);
    $data = json_decode($json, true);
    return isset($data[0]) ? self::extractEpisodeData($data[0]) : null;
}
```

## Example View: `views/episode.php`

The view file renders:
- Title & Subtitle
- Audio player
- Description, show notes, transcript link
- Contributors
- Links to all streaming platforms

## Metadata Handling

The metadata is located in `config/meta.php`. It is automatically set (e.g., for the homepage) or dynamically overridden, such as for individual episodes:

```php
$this->setMeta('title', $episode['title'] . ' | Grauzone Pott');
$this->setMeta('description', $episode['description']);
```