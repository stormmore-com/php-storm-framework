<?php
/**
 * @var Stormmore\Framework\Mvc\View $view
 * @var string $name
 */

$view->setTitle("Storm App - Homepage");
$view->setLayout("@/src/templates/includes/layout.php");
?>
<h2>It works!</h2>


<p>Made for demonstration purposes. If you want to build your own app use <a href="https://github.com/stormmore-com/php-storm-framework-startup">official template on GitHub</a></p>

<p><a href="/configuration">Configuration</a></p>
<p><a href="/url-existing-only-in-imaginations">404</a></p>
<p><a href="/url-made-only-to-throw-excception-but-it-exist">500</a></p>

<p><a href="/signin">Sign in</a></p>

<p><a href=""></a></p>
