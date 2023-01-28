<?php

/**
 *
 */
namespace App\AppActions;

use App\Interfaces\AppActionInterface;

class BaseAppAction implements AppActionInterface
{
    public string $errorMessage = "None";
    public array $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getLastErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function validate(): bool
    {
        return true;
    }

    public function name() : string
    {
        return get_class($this);
    }

    public function execute() : mixed
    {
        // TODO: Implement execute() method.
    }

}
