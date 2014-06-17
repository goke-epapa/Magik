<?php

class Magik_Form_Element_Text extends Magik_Form_Element
{
    public function render()
    {
        $element = '<input type="text" ';
        $element .= ' name="' . $this->_name . '"';

        if($this->_placeholder)
        {
            $element .= ' placeholder="' . $this->_placeholder . '"';
        }

        if($this->_default)
        {
            $element .= ' value="' . $this->_default . '"';
        }

        $attributes = $this->getAttributes();
        if(count($attributes) > 0){
           foreach($attributes as $key => $value)
           {
               $element .= " " . $key . "=\"" . $value . "\"";
           }
        }

        $element .= '/>' . "\n";

        return $element;
    }
}