<?php

namespace Tolacika\OktatasiHivatalHw\models;

class ExamResult
{
    private string $name;
    private string $type;
    private int $result;

    /**
     * @param string $name
     * @param string $type
     * @param int $result
     */
    public function __construct(string $name, string $type, int $result)
    {
        $this->name = $name;
        $this->type = $type;
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
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
