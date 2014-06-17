<?php

class Magik_Controller_Plugin
{
    private $_controller;

    public function preDispatch(){}
    public function postDispatch(){}


    public function setController($controller)
    {
        $this->_controller = $controller;
    }

    public function getController()
    {
        return $this->_controller;
    }

}
