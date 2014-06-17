<?php

class Magik_Form
{
    protected $_action;
    protected $_method;
    protected $_elements;
    protected $_values;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function setAction($action)
    {
        $this->_action = $action;
        return $this;
    }

    public function setMethod($method)
    {
        $this->_method = $method;
    }

    public function createElement($type, $name)
    {
        $class_name = "Magik_Form_Element_" . ucfirst($type);
        $element = new $class_name;
        $element->setName($name);
        $element->setType($type);
        return $element;
    }

    public function addElement($element)
    {
        $elementName = $element->getName();
        $this->_elements[$elementName] = $element;
        $this->$elementName = $element;
    }

    public function getElements()
    {
        return $this->_elements;
    }

    public function open()
    {
        return '<form action="' . $this->_action . '" method="' . $this->_method . '">' . "\n";
    }


    public function close()
    {
        return "</form>\n";
    }


    public function setDefaults($defaults)
    {
        foreach($defaults as $key => $value)
        {
            if(isset($this->_elements[$key]))
            {
                $this->_elements[$key]->setDefault($value);
            }
        }
    }

    public function getValues()
    {
        return $this->_values;
    }



    public function validate($values)
    {
        $formValid = true;


        if(count($values) > 0)
        {
            $this->_values = $values;
            foreach($this->_elements as $element)
            {
                if($element->hasFilters())
                {
                    $filters = $element->getFilters();
                    foreach($filters as $filter => $value)
                    {
                        $filterClass = 'Magik_Form_Filter_' . ucfirst($filter);
                        $processFilter = new $filterClass;
                        $this->_values[$element->getName()] = $processFilter->run($this->_values[$element->getName()], $value);
                    }
                }

                if($element->hasRules())
                {
                    $rules = $element->getRules();
                    foreach($rules as $rule => $value)
                    {
                        $ruleClass = 'Magik_Form_Rule_' . ucfirst($rule);
                        $processRule = new $ruleClass;
                        $bool = $processRule->run($this->_values[$element->getName()], $value);

                        if($bool === false)
                        {
                            $invalidFields[] = $element->getName();
                            $element->displayError();
                            $formValid = false;
                        }


                    }
                }

                if(isset($values[$element->getName()]))
                {
                    $element->setDefault($values[$element->getName()]);
                }
            }
        }

        return $formValid;

    }

}
