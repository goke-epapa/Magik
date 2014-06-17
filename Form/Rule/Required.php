<?php

class Magik_Form_Rule_Required extends Magik_Form_Rule
{
    public function run($sentValue, $compareValue = NULL)
    {
        if(!empty($sentValue)){
            return true;
        }else{
            return false;
        }
    }
}