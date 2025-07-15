<?php
require_once "layouts/main.layout.php";
require_once "bootstrap.php";
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
if ($uri === "") {
    $folder = "home-page";
} else {
    $folder = $uri;
}

$pageFile = PAGES_PATH . "/{$folder}/index.php";
$pageCssPath = "pages/{$folder}/assets/css/{$folder}.css";
$title = ucfirst($folder);

if (!file_exists($pageFile)) {
    $pageFile = ERRORS_PATH . "/_404.error.php";
    $pageCssPath = "/assets/css/_404.css";
    $title = "404 Not Found";
}

require_once PAGES_PATH . '/loader/loader.php';
renderMainLayout(function () use ($pageFile) {
    if (file_exists($pageFile)) {
        require $pageFile;
    } else {
        echo "<h1>404 - Page Not Found</h1>";
    }
}, $title, $pageCssPath);
