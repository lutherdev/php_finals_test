<?php
require_once "layouts/main.layout.php";
require_once "bootstrap.php";
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
if ($uri === "") {
    $folder = "home-page";
} else {
    $folder = $uri;
}

if (!file_exists(PAGES_PATH . "/{$folder}/index.php")) {
    $folder = "404";
}

$pageFile = PAGES_PATH . "/{$folder}/index.php";
$pageCssPath = "pages/{$folder}/assets/css/{$folder}.css";
$title = ucfirst($folder);

require_once PAGES_PATH . '/loader/loader.php';
renderMainLayout(function () use ($pageFile) {
    if (file_exists($pageFile)) {
        require $pageFile;
    } else {
        echo "<h1>404 - Page Not Found</h1>";
    }
}, $title, $pageCssPath);
