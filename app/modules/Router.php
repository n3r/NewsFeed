<?php

class Router
{
	public $action;
	public $params;

	public function __construct()
	{
		$routeArray = explode('/', $_SERVER['REQUEST_URI']);
	    // удаляем пустые элементы массива
	    $route = array();
	    foreach ($routeArray as $value) {
	        if (!empty($value)) {
	            $route[] = trim($value);
	        }

	    }

	    // Если массив пустой, показываем главную страницу
	    if (empty($route)){
	    	$this->action = 'index';
	    }else{
	    	$this->action = $route[0];
	    	if (count($route) > 1){
	    		$this->_prepareParams($route);
	    	}
	    }

	}

	private function _prepareParams($route)
	{
		// Берем данные о параметрах из урла и формируем массив
		unset($route[0]);
		$count = count($route);
		if (($count%2) != 0){
			throw new Exception('Incorrect params were passed to action "'. $this->action.'"');
		}else{
			$params = array();
			for ($i=1;$i<=$count;$i=$i+2){
				$params[$route[$i]] = $route[$i+1];
			}
			$this->params = $params;
		}
	}
}