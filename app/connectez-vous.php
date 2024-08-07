<?php
require_once 'includes/_header.php';
?>

<?php
echo getHtmlMessages($messages);
echo getHtmlErrors($errors);
?>
<ul id="errorsList" class="error"></ul>
<ul id="messagesList" class="messages"></ul>