# Grauzone Pott – Doku-Podcast Webseite

**Grauzone Pott** ist ein dokumentarischer Podcast über migrantischen Widerstand und neonazistische Gewalt im Ruhrgebiet der 1980er und 1990er Jahre. Die Webseite dient als zentrale Anlaufstelle für alle Episoden, Shownotes, Transkripte und Metadaten – gestützt durch eine Headless-CMS-API und ein objektorientiertes PHP-Setup.

## 🔧 Projektstruktur

```
grauzone-pott.de/
│
├── classes/
│   ├── Controllers/         # Alle Controller zur Seitensteuerung
│   ├── Models/              # Datenmodelle (z. B. Episode)
│   ├── View.php             # Rendering-Logik
│   ├── Router.php           # Einfache Routing-Lösung
│
├── config/meta.php          # Meta-Daten pro Seite
├── views/                   # Seiten (HTML/PHP-Templates)
├── partials/                # Gemeinsame Teile wie Header, Footer, Assets
├── css/, js/, font/, img/   # Statische Assets
```

## Funktionsweise

- Die Seite nutzt ein minimalistisches MVC-System in PHP.
- Daten (Episoden etc.) werden via cURL aus einer API geladen (`Models/Episode.php`).
- `Router.php` matched die URL auf eine definierte Route und ruft den entsprechenden Controller/Action auf.
- Metadaten werden dynamisch aus `meta.php` geladen und von `BaseController.php` bereitgestellt.

## Beispiel: Eine Episode anzeigen

```php
// Route: /episode/1/zum-beispiel
$router->add('/episode/(\d+)/([\w-]+)', 'EpisodeController', 'show');
```

Der `EpisodeController` lädt die Episode über ihre ID, prüft den Slug (für SEO), setzt die Meta-Tags und rendert die `episode`-View mit dem Episodendatensatz.

## Beispiel: Datenmodell `Episode`

```php
public static function getById($id)
{
    $url = self::$apiUrl . '?rid=' . $id;
    $json = self::fetchData($url);
    $data = json_decode($json, true);
    return isset($data[0]) ? self::extractEpisodeData($data[0]) : null;
}
```

## Beispiel-View: `views/episode.php`

Die View-Datei rendert:
- Titel & Untertitel
- Audio-Player
- Beschreibung, Shownotes, Transkript-Link
- Mitwirkende
- Links zu allen Streamingplattformen

## Meta-Daten-Handling

Die Meta-Daten befinden sich in `config/meta.php`. Sie werden automatisch gesetzt (bspw. bei der Startseite) oder dynamisch überschrieben, wie bei einzelnen Episoden:

```php
$this->setMeta('title', $episode['title'] . ' | Grauzone Pott');
$this->setMeta('description', $episode['description']);
```
