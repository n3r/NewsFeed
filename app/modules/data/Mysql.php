<?php

class Mysql extends Database
{
	protected $db;

	protected $table;

	public function __construct($config, $table = 'news')
	{
		$this->table = $table;

		$host = $config['mysql']['host'];
		$database = $config['mysql']['database'];
		$user = $config['mysql']['username'];
		$pass = $config['mysql']['password'];

		$this->db = new PDO("mysql:host=$host;dbname=$database", $user, $pass, array(
			PDO::ATTR_PERSISTENT => true
		));
	}

	public function getNewsfeed($offset = false, $count = false)
	{
		$newsfeed = $this->db->query('SELECT * FROM '.$this->table.' ORDER BY date_updated DESC');
		
		$result = array();
		
		while($row = $newsfeed->fetch(PDO::FETCH_ASSOC)) {
			$result[] = $row;
		}

		return $result;
	}

	public function getSingle($id)
	{
		$newsfeed = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE id = ?');
		$newsfeed->bindValue(1, $id, PDO::PARAM_INT);
		$newsfeed->execute();

		return $newsfeed->fetch();
	}

	public function delete($id)
	{
		$this->db->exec("DELETE FROM ".$this->table." WHERE id = ".$id);
	}

	public function update($id, $data)
	{
		$date = date("Y-m-d H:i:s");
		
		$new = $this->db->prepare("UPDATE news set title = :title, content = :content, date_updated = :date_updated where id=:id");
		$new->bindParam(':id', $id);
		$new->bindParam(':title', $data['title']);
		$new->bindParam(':content', $data['content']);
		$new->bindParam(':date_updated', $date);
		$new->execute();

		return true;
	}

	public function add($data)
	{
		//var_dump($data);die();
		$new = $this->db->prepare("INSERT INTO news (title, content, date_created, date_updated) VALUES (:title, :content, :date_created, :date_updated)");
		$new->bindParam(':title', $data['title']);
		$new->bindParam(':content', $data['content']);
		$date = date("Y-m-d H:i:s");
		$new->bindParam(':date_created', $date);
		$new->bindParam(':date_updated', $date);
		$new->execute();
		return $this->db->lastInsertId();
	}
}