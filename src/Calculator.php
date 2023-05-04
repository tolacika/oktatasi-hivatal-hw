<?php

namespace Tolacika\OktatasiHivatalHw;

use Illuminate\Support\Collection;
use Tolacika\OktatasiHivatalHw\exceptions\FailedExamException;
use Tolacika\OktatasiHivatalHw\exceptions\MissingExamException;
use Tolacika\OktatasiHivatalHw\models\ExamResult;
use Tolacika\OktatasiHivatalHw\models\ExtraPoint;
use Tolacika\OktatasiHivatalHw\models\University;

class Calculator
{
    #region Calculator configuration
    public const EXAM_MAGYAR = "magyar nyelv és irodalom";
    public const EXAM_TORTENELEM = "történelem";
    public const EXAM_MATEK = "matematika";
    public const EXAM_BIOLOGIA = "biológia";
    public const EXAM_FIZIKA = "fizika";
    public const EXAM_INFORMATIKA = "informatika";
    public const EXAM_KEMIA = "kémia";
    public const EXAM_ANGOL = "angol nyelv";
    public const EXAM_FRANCIA = "francia nyelv";
    public const EXAM_NEMET = "német nyelv";
    public const EXAM_OLASZ = "olasz nyelv";
    public const EXAM_OROSZ = "orosz nyelv";
    public const EXAM_SPANYOL = "spanyol nyelv";
    public const REQUIRED_EXAMS = [self::EXAM_MAGYAR, self::EXAM_TORTENELEM, self::EXAM_MATEK];

    public const EXAM_LANG_LEVEL_B2 = "B2";
    public const EXAM_LANG_LEVEL_C1 = "C1";

    public const EXAM_LEVEL_KOZEP = "közép";
    public const EXAM_LEVEL_EMELT = "emelt";
    public const EXAM_LEVELS = [self::EXAM_LEVEL_KOZEP, self::EXAM_LEVEL_EMELT];

    #endregion

    /**
     * @param University $theChosenOne
     * @param Collection|ExamResult[] $examResults
     * @param Collection|ExtraPoint[] $extraPoints
     * @return int
     */
    public function calculate(University $theChosenOne, Collection $examResults, Collection $extraPoints)
    {
        // Search for missing required exam
        foreach (self::REQUIRED_EXAMS as $reqExam) {
            if ($examResults->doesntContain(function ($item) use ($reqExam) {
                /** @var ExamResult $item */
                return $item->name == $reqExam;
            })) {
                throw new MissingExamException("Missing Required Exam(s)");
            }
        }

        // Search for failed exam(s)
        if ($examResults->contains(function ($item) {
            /** @var ExamResult $item */
            return $item->result < 20;
        })) {
            throw new FailedExamException("One of the exams has failed");
        }

        // Checking the university's requirements
        /** @var ExamResult $requiredExam */
        $requiredExam = $examResults->first(function ($item) use ($theChosenOne) {
            /** @var ExamResult $item */
            return $item->name == $theChosenOne->requiredExam;
        });

        /** @var Collection|ExamResult[] $optionalExams */
        $optionalExams = $examResults->filter(function ($item) use ($theChosenOne) {
            /** @var ExamResult $item */
            return in_array($item->name, $theChosenOne->optionalExams);
        });

        // Required exam

        if (!$requiredExam) {
            throw new MissingExamException("Missing the required exam for the university. No exam.");
        }

        // Required exam's level
        if ($theChosenOne->requiredLevel == self::EXAM_LEVEL_EMELT && $requiredExam->level != self::EXAM_LEVEL_EMELT) {
            throw new MissingExamException("Missing the required exam for the university. Bad level.");
        }

        // Optional exams
        if ($optionalExams->isEmpty()) {
            throw new MissingExamException("Missing an optional exam for the university. No exam.");
        }

        /** @var ExamResult $bestOptionalExam */
        $bestOptionalExam = $optionalExams->sortByDesc('result')->first();

        $basePoint = ($requiredExam->result + $bestOptionalExam->result) * 2;

        $extraPoint = $examResults->sum(function ($item) {
            /** @var ExamResult $item */
            return $item->level == self::EXAM_LEVEL_EMELT ? 50 : 0;
        });

        $langExtra = [];

        foreach ($extraPoints as $extra) {
            /** @var ExtraPoint $extra */
            if (!isset($langExtra[$extra->lang])) {
                $langExtra[$extra->lang] = $extra->type;
            } elseif ($extra->type == self::EXAM_LANG_LEVEL_C1) {
                $langExtra[$extra->lang] = $extra->type;
            }
        }

        $extraPoint += collect($langExtra)->sum(function ($level) {
            switch ($level) {
                case self::EXAM_LANG_LEVEL_B2:
                    return 28;
                case self::EXAM_LANG_LEVEL_C1:
                    return 40;
                default:
                    return 0;
            }
        });

        if ($extraPoint > 100) {
            $extraPoint = 100;
        }

        return $basePoint + $extraPoint;
    }
}
