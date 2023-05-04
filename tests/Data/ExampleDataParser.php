<?php

namespace Tolacika\OktatasiHivatalHw\Tests\Data;

use Illuminate\Support\Collection;
use Tolacika\OktatasiHivatalHw\models\ExamResult;
use Tolacika\OktatasiHivatalHw\models\ExtraPoint;
use Tolacika\OktatasiHivatalHw\models\University;

class ExampleDataParser
{
    public static ?array $exampleData = null;

    public static function getExampleData($i)
    {
        self::readExamples();

        if (isset(self::$exampleData[$i])) {
            $example = self::$exampleData[$i];

            $uni = null;
            $results = new Collection();
            $extras = new Collection();
            $output = null;

            if (isset($example['valasztott-szak'])) {
                $uni = new University(
                    $example['valasztott-szak']['egyetem'],
                    $example['valasztott-szak']['kar'],
                    $example['valasztott-szak']['szak']
                );
            }

            if (isset($example['erettsegi-eredmenyek'])) {
                foreach ($example['erettsegi-eredmenyek'] as $result) {
                    $results->push(new ExamResult($result['nev'], $result['tipus'], intval($result['eredmeny'])));
                }
            }

            if (isset($example['tobbletpontok'])) {
                foreach ($example['tobbletpontok'] as $extra) {
                    $extras->push(new ExtraPoint($extra['kategoria'], $extra['tipus'], $extra['nyelv']));
                }
            }

            if (isset($example['output'])) {
                $output = $example['output'];
            }

            return [
                'uni' => $uni,
                'results' => $results,
                'extras' => $extras,
                'output' => $output
            ];
        } else {
            return null;
        }
    }

    private static function readExamples()
    {
        if (!self::$exampleData) {
            require "homework_input.php";

            self::$exampleData = $exampleData ?? null;
        }
    }
}