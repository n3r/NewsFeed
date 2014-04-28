<?php

namespace App\Library\Framework\Db;

use App\Library\Framework\Database as Database;

class File extends Database
{
	public $data;
	public $file;

	public function __construct($config)
	{
		$this->file = $config['file']['destination'];
		$this->data = $this->readFile($this->file);
	}

	public function getNewsfeed($offset = false, $count = false)
	{
		return $this->data;
	}

	public function getSingle($id)
	{
		return $this->data[$id];
	}

	public function delete($id)
	{
		unset($this->data[$id]);
		$fp = fopen($this->file, 'w');
		foreach ($this->data as $new){
			foreach ($new as $row){
				fwrite($fp, $row."\n");
			}
			fwrite($fp, "--\n");
		}
		fclose($fp);
	}

	public function update($id, $data)
	{
		$this->data[$id]['title'] = $data['title'];
		$this->data[$id]['content'] = $data['content'];
		$this->data[$id]['date_updated'] = time();

		$fp = fopen($this->file, 'w');
		foreach ($this->data as $new){
			foreach ($new as $row){
				fwrite($fp, $row."\n");
			}
			fwrite($fp, "---\n");
		}
		fclose($fp);
	}

	public function add($data)
	{
		$id = $this->getLastId() + 1;
		$date = time();
		$fp = fopen($this->file, 'a');
		fwrite($fp, $id."\n");
		fwrite($fp, $data['title']."\n");
		fwrite($fp, $data['content']."\n");
		fwrite($fp, $date."\n");
		fwrite($fp, $date."\n");
		fwrite($fp, "---\n");
		fclose($fp);
	}

	private function readFile($file, $delimiter="\n")
	{
	    // Устанавливаем счетчик строки
	    $i = 1;

	    // Открываем файл на чтение
	    $fp = fopen( $file, 'r' );



	    $result = array();
	    $record = array();
	    // Пробегаемся по всему файлу
	    while ( !feof ( $fp) )
	    {
	        // Читаем строку
	        $buffer = stream_get_line( $fp, 1024, $delimiter );
	        switch ($i){
	        	default:
	        	case 1:
	        		$record['id'] = $buffer;
	        		break;
	        	case 2:
	        		$record['title'] = $buffer;
	        		break;
	        	case 3:
	        		$record['content'] = $buffer;
	        		break;
	        	case 4:
	        		$record['date_created'] = $buffer;
	        		break;
	        	case 5:
	        		$record['date_updated'] = $buffer;
	        		break;
	        	case 6:
	        		$result[$record['id']] = $record;
	        		$i = 0;
	        		break;
	        }
	        
	        $i++;
	        
	        // Очищаем буффер
	        $buffer = '';
	    }

	    return $result;
	}

	private function getLastId()
	{
		return end($this->data)['id'];
	}
}