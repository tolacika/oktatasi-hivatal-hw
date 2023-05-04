<?php

namespace Tolacika\OktatasiHivatalHw;

use Tolacika\OktatasiHivatalHw\models\ExamResult;
use Tolacika\OktatasiHivatalHw\models\ExtraPoint;
use Tolacika\OktatasiHivatalHw\models\University;

require 'vendor/autoload.php';

$uni = new University("ELTE", "IK", "Programtervező informatikus");
$result = collect([
    new ExamResult(Calculator::EXAM_MATEK, Calculator::EXAM_LEVEL_KOZEP, 100),
    new ExamResult(Calculator::EXAM_TORTENELEM, Calculator::EXAM_LEVEL_KOZEP, 70),
    new ExamResult(Calculator::EXAM_MAGYAR, Calculator::EXAM_LEVEL_KOZEP, 80),
    new ExamResult(Calculator::EXAM_ANGOL, Calculator::EXAM_LEVEL_KOZEP, 91),
    new ExamResult(Calculator::EXAM_FIZIKA, Calculator::EXAM_LEVEL_KOZEP, 100),
    new ExamResult(Calculator::EXAM_KEMIA, Calculator::EXAM_LEVEL_KOZEP, 59),
]);
$extra = collect([
    new ExtraPoint("Nyelvvizsga", "C1", "angol"),
    new ExtraPoint("Nyelvvizsga", "B2", "angol"),
]);

$app = new Calculator();
$points = $app->calculate($uni, $result, $extra);

print $points . PHP_EOL;