<?php

namespace Tolacika\OktatasiHivatalHw;

use Tolacika\OktatasiHivatalHw\models\University;

require 'vendor/autoload.php';

$app = new Calculator();
$points = $app->calculate(new University("University", "Kar", "Szak"), [], []);

print $points . PHP_EOL;