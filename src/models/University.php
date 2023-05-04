<?php

namespace Tolacika\OktatasiHivatalHw\models;

use Tolacika\OktatasiHivatalHw\Calculator;

class University
{
    public string $university;
    public string $kar;
    public string $szak;
    public ?string $requiredExam;
    public ?string $requiredLevel;
    public ?array $optionalExams;

    /**
     * @param string $university
     * @param string $kar
     * @param string $szak
     */
    public function __construct(string $university, string $kar, string $szak)
    {
        $this->university = $university;
        $this->kar = $kar;
        $this->szak = $szak;

        // Todo: Az egyes egyetemi szakok szintén jöhetnének valami adatforrásból, pld db-ből, a saját feltétel rendszerével együtt.
        if ($university == "ELTE") {
            $this->requiredExam = Calculator::EXAM_MATEK;
            $this->requiredLevel = Calculator::EXAM_LEVEL_KOZEP;

            $this->optionalExams = [
                Calculator::EXAM_BIOLOGIA,
                Calculator::EXAM_FIZIKA,
                Calculator::EXAM_INFORMATIKA,
                Calculator::EXAM_KEMIA,
            ];
        } else/*if ($university == "PPKE") */ {
            $this->requiredExam = Calculator::EXAM_ANGOL;
            $this->requiredLevel = Calculator::EXAM_LEVEL_EMELT;

            $this->optionalExams = [
                Calculator::EXAM_FRANCIA,
                Calculator::EXAM_NEMET,
                Calculator::EXAM_OLASZ,
                Calculator::EXAM_OROSZ,
                Calculator::EXAM_SPANYOL,
                Calculator::EXAM_TORTENELEM,
            ];
        }
    }

    /**
     * @return string
     */
    public function getUniversity(): string
    {
        return $this->university;
    }

    /**
     * @param string $university
     */
    public function setUniversity(string $university): void
    {
        $this->university = $university;
    }

    /**
     * @return string
     */
    public function getKar(): string
    {
        return $this->kar;
    }

    /**
     * @param string $kar
     */
    public function setKar(string $kar): void
    {
        $this->kar = $kar;
    }

    /**
     * @return string
     */
    public function getSzak(): string
    {
        return $this->szak;
    }

    /**
     * @param string $szak
     */
    public function setSzak(string $szak): void
    {
        $this->szak = $szak;
    }


}