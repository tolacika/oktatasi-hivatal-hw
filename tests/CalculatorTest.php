<?php

namespace Tolacika\OktatasiHivatalHw\Tests;

use PHPUnit\Framework\TestCase;
use Tolacika\OktatasiHivatalHw\Calculator;
use Tolacika\OktatasiHivatalHw\exceptions\FailedExamException;
use Tolacika\OktatasiHivatalHw\exceptions\MissingExamException;
use Tolacika\OktatasiHivatalHw\Tests\Data\ExampleDataParser;

class CalculatorTest extends TestCase
{
    public function testPositiveCases()
    {
        $dataset = [
            ExampleDataParser::getExampleData('success1'),
            ExampleDataParser::getExampleData('success2'),
        ];

        foreach ($dataset as $data) {
            $calculator = new Calculator();
            $this->assertEquals(
                $data['output'],
                $calculator->calculate($data['uni'], $data['results'], $data['extras'])
            );
        }
    }

    public function testMissingExam()
    {
        $data = ExampleDataParser::getExampleData('fail_missing_required');

        $calculator = new Calculator();
        $this->expectException(MissingExamException::class);
        $result = $calculator->calculate($data['uni'], $data['results'], $data['extras']);

    }

    public function testFailedExam()
    {
        $data = ExampleDataParser::getExampleData('fail_low_result');

        $calculator = new Calculator();
        $this->expectException(FailedExamException::class);
        $result = $calculator->calculate($data['uni'], $data['results'], $data['extras']);
    }

    public function testDuplicateLanguageExam()
    {

        $data = ExampleDataParser::getExampleData('duplicated_extras');

        $calculator = new Calculator();
        $this->assertEquals(
            $data['output'],
            $calculator->calculate($data['uni'], $data['results'], $data['extras'])
        );
    }
}