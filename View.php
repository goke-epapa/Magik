<?php
/**
 * View part of the mvc
 *
 * This is a view object which will be used for display
 *
 * LICENSE: New BSD License
 *
 * @category   Magik
 * @package    Magik_View
 * @copyright  Copyright (c) 2010 Jarzion, LLC (http://www.jarzion.com)
 * @version    $Id:$
 * @since      File available since Release 1.0
 */
class Magik_View{

    /**
     * Magic function used to get a property value that was not defined
     * so it just returns a blank string
     *
     * @param string $name
     * @return string
     */
    public function __get($name)
    {
        return '';
    }


    /**
     * Magic function used to set an object property without declaring it
     *
     * @param string $name
     * @param string $value
     */
    public function __set($name, $value)
    {
        $this->$name = $value;
    }


    /**
     * Include the view so it can be rendered
     *
     * @param string $viewPath
     */
    public function render($viewPath)
    {
        ob_start();
        $this->display($viewPath);
        $output = ob_get_clean();
        return $output;
    }



    public function display($viewPath){
        include($viewPath);
    }
}

