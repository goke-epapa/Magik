<?php

class Magik_Form_Element
{
    protected $_name;
    protected $_label;
    protected $_errorMessage;
    protected $_errorDisplay;
    protected $_required;
    protected $_filters;
    protected $_rules;
    protected $_placeholder;
    protected $_default;
    protected $_attributes;
    protected $_type;

    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setLabel($label)
    {
        $this->_label = $label;
        return $this;
    }

    public function getLabel()
    {
        return $this->_label;
    }

    public function setErrorMessage($message)
    {
        $this->_errorMessage = $message;
        return $this;
    }

    public function getErrorMessage()
    {
        return $this->_errorDisplay;
    }

    public function displayError()
    {
        $this->_errorDisplay = $this->_errorMessage;
    }

    public function setRequired($bool)
    {
        $this->_required = $bool;
        return $this;
    }

    public function addFilter($filter, $value = NULL)
    {
        $this->_filters[$filter] = $value;
        return $this;
    }

    public function addRule($rule, $value = NULL)
    {
        $this->_rules[$rule] = $value;
        return $this;
    }

    public function setPlaceholder($placeholder)
    {
        $this->_placeholder = $placeholder;
        return $this;
    }

    public function setDefault($default)
    {
        $this->_default = $default;
    }

    public function hasFilters()
    {
        if(count($this->_filters) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function hasRules()
    {
        if(count($this->_rules) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function setAttributes($attributes)
    {
        $this->_attributes = $attributes;
        return $this;
    }

    public function getAttributes()
    {
        return $this->_attributes;
    }

    public function getRules()
    {
        return $this->_rules;
    }

    public function getFilters()
    {
        return $this->_filters;
    }

    public function setType($type)
    {
        $this->_type = $type;
    }

    public function getType()
    {
        return $this->_type;
    }
}