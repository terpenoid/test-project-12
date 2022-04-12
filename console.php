<?php

const ROOT_PATH = __DIR__;

require __DIR__.'/App/App.php';

App::init();
App::$kernel->launch($argv);
