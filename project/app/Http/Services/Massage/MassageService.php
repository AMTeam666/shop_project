<?php

namespace App\Http\Services\Massage;
use App\Http\Interfaces\MassageInterface;

class MassageService
{
    private $massage;

    public function __construct(MassageInterface $massage){

        $this->massage = $massage;

    }

    public function send(){

        return $this->massage->fire();

    }
}