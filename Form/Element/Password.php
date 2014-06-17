<?php

class Magik_Form_Element_Password extends Magik_Form_Element
{
    public function render()
    {

        $element = '<input type="password"';
        $element .= ' name="' . $this->_name . '"';

        if($this->_placeholder)
        {
            $element .= ' placeholder="' . $this->_placeholder . '"';
        }

        if($this->_default)
        {
            $element .= ' value="' . $this->_default . '"';
        }

        $element .= '/>' . "\n";

        return $element;
    }
}