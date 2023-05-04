<?php

namespace Tolacika\OktatasiHivatalHw\models;

class ExamResult
{
    public string $name;
    public string $level;
    public int $result;

    /**
     * @param string $name
     * @param string $level
     * @param int $result
     */
    public function __construct(string $name, string $level, int $result)
    {
        $this->name = $name;
        $this->level = $level;
        $this->result = $result;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * @param string $level
     */
    public function setLevel(string $level): void
    {
        $this->level = $level;
    }

    /**
     * @return int
     */
    public function getResult(): int
    {
        return $this->result;
    }

    /**
     * @param int $result
     */
    public function setResult(int $result): void
    {
        $this->result = $result;
    }
}
