<?php

class Magik_Form_Element_Submit extends Magik_Form_Element
{
    public function render()
    {
        $element = '<input type="submit"';
        $element .= ' name="' . $this->_name . '"';
        $element .= ' value="'. $this->_label .'"';
        $element .= '/>' . "\n";

        return $element;
    }
}