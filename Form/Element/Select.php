<?php

class Magik_Form_Element_Select extends Magik_Form_Element
{
    private $_options;

    public function render()
    {
        $element = '<select ';
        $element .= ' name="' . $this->_name . '"';
        $element .= '/>' . "\n";

        foreach($this->_options as $key => $value)
        {
            $selected = "";

            if($key == $this->_default)
            {
                $selected = " selected=\"selected\"";
            }

            $element .= "<option value=\"" . $key . "\" " . $selected . ">" . $value . "</option>";

        }

        $element .= "</select>";

        return $element;
    }

    public function setOptions($options)
    {
        $this->_options = $options;
    }
}