<?php

namespace App\Service;
use DateTime;

class Random
{

    public function random()
    {
        return rand(333, 415);
    }

}
