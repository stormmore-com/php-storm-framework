<?php
/**
 * @var Stormmore\Framework\Mvc\View $view
 * @var string $name
 */

$view->setTitle("Storm App - Homepage");
$view->setLayout("@/src/templates/includes/layout.php");
?>
<h2>It works!</h2>

<?php if ($view->request->messages->isset('success')): ?>
    <div style="padding:10px; background-color: lightseagreen;color:white">Success!</div>
<?php endif ?>

<?php if ($view->request->messages->isset('failure')): ?>
    <div style="padding:10px; background-color: crimson; color: white">Failure!</div>
<?php endif ?>

<p>Made for demonstration purposes. If you want to build your own app use <a href="https://github.com/stormmore-com/php-storm-framework-startup">official template on GitHub</a></p>

<p>Links:</p>
<p>
    <a href="/signin">Sign in</a>
    | <a href="/profile">Profile (requires authentication)</a>
    | <a href="/administrator">Administrator (requires 'administrator' privilege)</a>
</p>
<p><a href="/form">Form</a></p>
<p><a href="/cqs-test">Run CQS commands</a></p>
<p><a href="/redirect-with-success">Redirect with success</a> | <a href="/redirect-with-failure">Redirect with failture</a></p>
<p><a href="/url-existing-only-in-imaginations">404</a> | <a href="/url-made-only-to-throw-exception-but-it-exist">500</a></p>
<p><a href="/configuration">Configuration</a></p>

<p><a href=""></a></p>
