<?php
// ací va la lògica per a processar el formulari de creació de tuits

function reArrayFiles($file_post) {

    var_dump($file_post);

    $file_ary = [];
    $file_count = count(($file_post["name"]));
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}
var_dump(reArrayFiles($_FILES["file"]));
