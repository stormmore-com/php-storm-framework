<?php
/** @var Stormmore\Framework\Mvc\View $view */

$view->setLayout('@templates/includes/layout.php');
?>
<h2>Sign in</h2>
<div style="border:solid 1px; padding:10px">
    <form action="/signin" method="post">
        <p>
            It's made just for demonstration purposes so user data is written in cookie and there is no password validation. Don't worry about that.
        </p>
        <input type="text" name="username">
        <button><?php echo _('signin.post') ?></button>
    </form>
</div>


