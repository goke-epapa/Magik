<?php

class Magik_Form_Element_Jquery_DatePicker extends Magik_Form_Element
{

    public function render()
    {
        $element = '
        <script>
	        $(function() {
		    $( "#' . $this->_name . '" ).datepicker();
	    });
        </script>';
        $element .= '<input type="text" ';
        $element .= ' id="' . $this->_name . '"';
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