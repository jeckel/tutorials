<?php
namespace Tutorial;

include dirname(__DIR__) . "/vendor/autoload.php";

(new Bootstrap(include 'settings.php'))->boot();

