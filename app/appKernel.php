<?php

namespace App;

use App\Library\Framework\Router as Router;
use App\Library\Framework\Db\Mysql as Mysql;
use App\Library\Framework\Db\File as File;

class appKernel
{
	protected $router;
	protected $config;
	protected $db;

	public function __construct($config)
	{
		$this->config = $config;
		$this->router = new Router();

		// Берем данные из конфига о типе базы данных
		switch ($this->config['data_storage']){
			default:
			case 'mysql':
				// Создаем экземпляр класса работы с базой
				$this->db = new Mysql($this->config);
				break;
			case 'file':
				// Создаем экземпляр класса работы с базой
				$this->db = new File($this->config);
				break;
		}
	}

	public function run()
	{
		// Запускаем действие для выбранной страницы
		$action = $this->router->action.'Action';
		$this->$action();
	}

	public function indexAction()
	{
		$news = $this->db->getNewsfeed();
		$this->render($this->router->action, array('news' => $news));
	}

	public function addAction()
	{
		$data = $this->getParam('data');
		if ($data){
			$this->db->add($data);
			$this->redirect('');
		}else{
			$this->render($this->router->action);
		}
	}

	public function editAction()
	{
		if ($id = $this->router->params['id']){
			$data = $this->getParam('data');
			
			// Ищем запись для редактирования
			$new = $this->db->getSingle($id);

			if ($data){

				$this->db->update($id, $data);

				$this->redirect('');
			}else{
				$this->render($this->router->action, array('new' => $new));
			}
		}else{
			$this->redirect('');
		}
	}

	public function deleteAction()
	{
		if ($id = $this->router->params['id']){
			$new = $this->db->getSingle($id);

			$submit = $this->getParam('submit');
			if ($submit){
				$this->db->delete($id);
				$this->redirect('');
			}else{
				$this->render($this->router->action, array('new' => $new));
			}
		}else{
			$this->redirect('');
		}
	}

	/*
	* Маленький шаблонизатор
	*/
	private function render($template, $data = array())
	{
		extract($data);
		$file = __DIR__.'/views/'.$template.'.php';
		if (file_exists($file)){
			require_once 'views/'.$template.'.php';
		}else{
			throw new Exception('Template not found');
		}	
	}

	private function redirect($action, $params = array())
	{
		if (!empty($params)){

		}else{
			$params_string = '';
		}
		header('Location: /'.$action.$params_string);
	}

	private function getParam($param)
	{
		if (isset($_POST[$param])){
			// Можно еще экранирование спецсимволов добавить и кучу валидаторов
			return $_POST[$param];
		}else{
			return false;
		}
	}

}