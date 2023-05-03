<?php

namespace Tolacika\OktatasiHivatalHw\models;

class University
{
    private string $university;
    private string $kar;
    private string $szak;

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