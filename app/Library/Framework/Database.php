<?php

namespace App\Library\Framework;

abstract class Database
{
	abstract protected function getNewsfeed($offset = false, $count = false);

	abstract protected function getSingle($id);

	abstract protected function delete($id);

	abstract protected function update($id, $data);

	abstract protected function add($data);
}