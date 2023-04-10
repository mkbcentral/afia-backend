<?php

namespace App\Enums;

enum UserStatus:int{
    case ENABLE=1;
    case DESABLE=2;

    public function color():string{
        return match($this){
            UserStatus::ENABLE=>"primary",
            UserStatus::ENABLE=>"danger"
        };
    }
}
