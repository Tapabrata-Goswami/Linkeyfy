<?php

// Slience is golden

require_once ('dbconnect.php');

// Fetch the requested URL
$request = $_GET['url'] ?? '/';

// Define your routes (simple mapping of URLs to actions)
$routes = [
    '/' => 'controller/link-counter.php',
    // '/contact' => 'contact.php'
    // Add more routes as needed
];

// Check if the requested route exists in the defined routes
if (array_key_exists($request, $routes)) {
    // If the route exists, include the corresponding file
    include $routes[$request];
} else {
    // If the route doesn't exist, show a 404 error or handle it as needed
    echo '404 - Page Not Found';
}

?>
