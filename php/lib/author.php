<?php
namespace mwaid1\ObjectOriented;

require_once("../Classes/Author.php");

$author = new Author("54bae1c8-99a0-44bf-82a0-c9f7473ba3d6", "noodle.com", "12345678901234567890123456789012", "me@me.com", '$argon2i$v=19$m=1024,t=384,p=2$dE55dm5kRm9DTEYxNFlFUA$nNEMItrDUtwnDhZ41nwVm7ncBLrJzjh5mGIjj8RlzVA', "Me");
var_dump($author);
?>