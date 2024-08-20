<?php

function escape($input){
    // Apply trim and then escape the trimmed input
    return htmlentities(trim($input), ENT_QUOTES, 'UTF-8');
}

?>
