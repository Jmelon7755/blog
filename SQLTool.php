<?php

namespace JBlog;

class SQLTool
{
	public $mysqli;
	public $result;

	public function __construct(\mysqli $mysqli)
	{
		$this->mysqli = $mysqli;
		!$this->mysqli->connect_errno or exit('Connect Error (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
		$this->mysqli->query("SET NAMES utf8");
		$this->mysqli->select_db("jblog");
	}

	public function sqlQueryPre($sql, $params)
	{
		$this->result = null;

		$stmt = $this->mysqli->prepare($sql);
		if (!$stmt) {
			return;
		}

		call_user_func_array(array($stmt, 'bind_param'), $params);
		if (!$stmt->execute()) {
			return;
		}

		$this->result = $stmt->get_result();
	}

	public function sqlQuery($sql)
	{
		$this->result = $this->mysqli->query($sql);
	}

	//目前只有integer :)
	//i: integer
	//s: string
	public function fetchObjectAll(string $class_name, string $types, bool $reverse = false)
	{
		$posts = [];

		if (!$this->result) {
			return [];
		}

		while ($object = $this->result->fetch_object($class_name)) {
			$reflect = new \ReflectionClass($object);
			$props = $reflect->getProperties();
			$object->setType($types);
			if ($reverse) {
				array_unshift($posts, $object);
			} else {
				array_push($posts, $object);
			}
		}

		return $posts;
	}

	public function close()
	{
		if ($this->result) {
			$this->result->free();
		}
		$this->mysqli->close();
	}
}
