<?php

class Magik_Form_Rule_Match extends Magik_Form_Rule
{
    public function run($sentValue, $compareValue = NULL)
    {
        if($sentValue != $compareValue){
            return false;
        }else{
            return true;
        }
    }
}