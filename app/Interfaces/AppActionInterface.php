<?php


namespace App\Interfaces;


interface AppActionInterface
{
    public function validate() : bool;
    public function execute() : mixed;
    public function getLastErrorMessage() : string;
    public function name() : string;
}
