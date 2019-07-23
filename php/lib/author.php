<?php
namespace mwaid1\ObjectOriented;

require_once("../Classes/Author.php");

$author = new Author("54bae1c8-99a0-44bf-82a0-c9f7473ba3d6", "noodle.com", "12345678901234567890123456789012", "me@me.com", "b10a8db164e0754105b7a99be72e3fe5", "Me");
var_dump($author);
?>