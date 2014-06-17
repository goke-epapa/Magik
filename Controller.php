<?php

class Magik_Controller{

    private $_url;
    private static $_applicationPath;
    private $_action;
    private $_controller;
    private $_plugins;
    private $_params;
    public $view;


    /**
     * The constructor will automatically set the url
     */
    public function  __construct($config = null, $path = null)
    {
        $this->_config = $config;
        $this->_url = $_SERVER['REQUEST_URI'];

        $findQ = strpos($this->_url, "?");
        if($findQ)
            $uri = substr($_SERVER['REQUEST_URI'], 0, $findQ);
        else
            $uri = $_SERVER['REQUEST_URI'];

        $uri = str_replace("http://", "", $uri);
        $uri = str_replace("https://", "", $uri);
        $uri = str_replace($_SERVER['SERVER_NAME'],"",$uri);
        $uri = trim(str_replace($path, "", $uri), "/");

        $tmpparams = explode("/", $uri);

        $configcount = count($this->_config);
        $params = array();


        for($i = 0; $i < $configcount; $i++){
            if(empty($tmpparams[$i])){
                $params[$this->_config[$i]] = 'index';
            }else{
                $params[$this->_config[$i]] = $tmpparams[$i];
            }

        }

        for($i = $configcount; $i < count($tmpparams); $i++){
            $ai = $i;
            $bi = ++$i;
            //echo $tmpparams[$ai] . ":" . $tmpparams[$bi] . "<br/>";
            if(isset($tmpparams[$ai]) && isset($tmpparams[$bi])){
                $params[$tmpparams[$ai]] = $tmpparams[$bi];
            }
        }

        $this->_params = $params;

        $this->init();
    }

    public function init(){}

    public function getParam($param)
    {
        return $this->_params[$param];
    }



    /**
     * Sets the url to be parsed by dispatch
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->_url = $url;
    }


    /**
     * Sets the application path so we can find the
     * controllers and views
     *
     * @param string $path
     */
    public static function setApplicationPath($path)
    {
        self::$_applicationPath = $path;
    }


    /**
     * Sets the view to an Am_View object
     *
     * @param Magik_View $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }


    /**
     * Get the current action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->getParam('action');
    }

    public function getController()
    {
        return $this->getParam('controller');
    }

    /**
     * Redirect to a url
     *
     * @param string $url
     */
    public function redirect($url)
    {
        header("Location: " . $url);
        exit;
    }


    public function forward($controller, $action)
    {
    	$this->_controller = $controller;
    	$this->_action = $action;
    	
    	return $this->run();
    }


    public function registerPlugin($plugin)
    {
        $this->_plugins[] = $plugin;
    }


    public function run()
    {
        $this->preDispatch();
        $dispatch = $this->dispatch();
        $this->postDispatch();

        return $dispatch;
    }


    /**
     * Get the part of the url after the domain name and map it to a file
     *
     */
    public function dispatch()
    {
        $sControllerName = ucfirst($this->getController());
        $sActionName = ucfirst($this->getAction());
        $sFilePathAndName = self::$_applicationPath . "controllers/";
        $sFilePathAndName .= str_replace("_", "/", $sControllerName) . "Controller.php";

        include($sFilePathAndName);

        $sControllerClass = $sControllerName . "Controller";

        $Controller = new $sControllerClass();
        $sActionMethod = $sActionName . "Action";

        if(isset($this->view)){
            $sViewFile = self::$_applicationPath . "views/";
            $sViewFile .= strtolower($sControllerName) . "/";
            $sViewFile .= strtolower($sActionName) . ".phtml";
            $Controller->setView($this->view);
            $Controller->$sActionMethod();

            return $Controller->view->render($sViewFile);

        }else{
            $Controller->$sActionMethod();
        }
    }

    public function hasPostData()
    {
        if(count($_POST) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function hasGetData()
    {
        if(count($_GET) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function preDispatch()
    {
        if(count($this->_plugins) > 0)
        {
            foreach($this->_plugins as $plugin)
            {
                $plug = new $plugin();
                $plug->setController($this);
                $plug->preDispatch();
            }
        }
    }

    public function postDispatch()
    {
        if(count($this->_plugins) > 0)
        {
            foreach($this->_plugins as $plugin)
            {
                $plug = new $plugin();
                $plug->postDispatch();
            }
        }
    }
}
