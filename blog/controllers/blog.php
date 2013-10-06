<?php

$action = val($arg[1], 'index');
return load_controller("blog/{$action}", $arg);
