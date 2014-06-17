<?php

class Magik_Form_Element_Hidden extends Magik_Form_Element
{
    public function render()
    {
        $element = '<input type="hidden" ';
        $element .= ' name="' . $this->_name . '"';

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