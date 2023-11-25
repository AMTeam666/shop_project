<?php
use SMS\MeliPayamakService;
use Interfaces\MassageInterface;

class SmsService implements MassageInterface{
    
    private $text;
    private $from;
    private $to;
    private $isFlash = true;



    public function fire(){

        $meliPayamak = new MeliPayamakService();

    }


    public function getFrom(){

        return $this->from;
    }

    public function setFrom($from){

        $this->from = $from;
    }

    public function getText(){

        return $this->text;
    }

    public function setText($text){

        $this->text = $text;    
    }

    public function getTo(){

        return $this->to;
    }

    public function setTo($to){

        $this->to = $to;
    }
}