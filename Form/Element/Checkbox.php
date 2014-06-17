<?php

class Magik_Form_Element_Checkbox extends Magik_Form_Element
{
    public function render()
    {
        $element = '<input type="checkbox" ';
        $element .= ' id="' . $this->_name . '"';
        $element .= ' name="' . $this->_name . '"';
        $element .= '/><label for="' . $this->_name . '">' . $this->_label . "</label>\n";

        return $element;
    }
}