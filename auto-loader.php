<?php

/*
 * Auto Loader for namespaced classes
 */

function namespaced_autoloader($class) {

    $path = LIBPATH;
    $explodedPath = explode("\\", $class);
    foreach($explodedPath as $classpath) {
        $path = $path . '/' . $classpath;
    }
	
    $path = $path . '.class.php';
    if (file_exists($path)) {
        include $path;
    }
    
}

spl_autoload_register('namespaced_autoloader');

?>