<?php

class Magik_Form_Filter_Trim extends Magik_Form_Filter
{
    public function run($value, $trim = NULL)
    {
        return trim($value, $trim);
    }
}