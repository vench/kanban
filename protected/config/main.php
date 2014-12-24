<?php

if(file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR.'work.php')) {
    return require_once 'work.php';
}
return require_once 'install.php';


