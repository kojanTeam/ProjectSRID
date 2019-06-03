<?php
namespace Model;

abstract class ModelBase 
{
	private static $db_host = "localhost";
	private static $db_username = "root";
	private static $db_password = "";
	private static $db_name = "ProjectSRID";

	private static $connection;



	protected static $select;

	protected static $table;
	protected static $id;
	protected static $fields;
	protected static $types;




	private static function OpenConnection()
	{
		self::$connection = mysqli_connect(self::$db_host, self::$db_username, self::$db_password, self::$db_name);
	}

	private static function CloseConnection()
	{
		mysqli_close(self::$connection);
	}



	public static function Select()
	{
		self::OpenConnection();
		$query = static::$select . " WHERE " . static::$table .".IsDelete != 1";
		$result = mysqli_query(self::$connection, $query);
		$class = static::class;

		$list = array();		
		while ($row = mysqli_fetch_assoc($result))
		{
			$entity = new $class;
			foreach ($row as $key => $value)
			{
				$entity->$key = $value;
			}

			$list[] = $entity;
    	}

    	mysqli_free_result($result);
		self::CloseConnection();

		return $list;
	}

	public static function SelectByID($update_id)
	{
		self::OpenConnection();
		$query = static::$select . " WHERE " . static::$table .".IsDelete != 1 AND ".static::$id." = $update_id";
		$result = mysqli_query(self::$connection, $query);
		$class = static::class;

		$list = array();		
		$row = mysqli_fetch_assoc($result);
		$entity = new $class;
		
		foreach ($row as $key => $value)
		{
			$entity->$key = $value;
		}

    	mysqli_free_result($result);
		self::CloseConnection();

		return $entity;
	}

	public function Insert()
	{
		$fields = implode(', ', static::$fields);
		$params = implode(', ', array_fill(0, count(static::$fields), '?'));
		$types = static::$types;

		$values = array();
		foreach (static::$fields as $field)
		{
			$values[] = $this->$field;
		}

		$query = "INSERT INTO " . static::$table . "($fields) VALUES ($params);";


		self::Query($query, $values, $types);
	}

	public function Delete()
	{
		$id = static::$id;
		$types = 'i';

		$values[] = $this->$id;

		$query = "UPDATE " . static::$table . "SET IsDelete = 1 WHERE $id = ?;";


		self::Query($query, $values, $types);
	}

	public function PermamentDelete()
	{
		$id = static::$id;
		$types = 'i';

		$values[] = $this->$id;

		$query = "DELETE FROM " . static::$table . " WHERE $id = ?;";


		self::Query($query, $values, $types);
	}

	public function Update()
	{
		$id = static::$id;
		$fields = implode(' = ?, ', static::$fields) . ' = ?';
		$types = static::$types . 'i';

		$values = array();
		foreach (static::$fields as $field)
		{
			$values[] = $this->$field;
		}
		$values[] = $this->$id;

		$query = "UPDATE " . static::$table . " SET $fields WHERE $id = ?;";


		self::Query($query, $values, $types);
	}



	private static function Query($query, $values, $types)
	{
		self::OpenConnection();
		$stmt = mysqli_stmt_init(self::$connection);

		mysqli_stmt_prepare($stmt, $query);
	    mysqli_stmt_bind_param($stmt, $types, ...$values);
	    mysqli_stmt_execute($stmt);

	    mysqli_stmt_close($stmt);
		self::CloseConnection();
	}
}
?>