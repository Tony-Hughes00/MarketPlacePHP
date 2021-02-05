<?php

namespace Core\Entity;
use \App;
use \App\Table;
/**
 * Entity class
 * @package Core\Entity
 */
class Entity {
	protected $values;
	public $tableName = "";

	public function __construct() {
		// App::console_log( "Entity constructor" );
	}

	/**
	 * Magic method
	 *
	 * @param string $key the name of the proprety
	 * @return mixed|null
	 */
	public function __get(string $key) {
		$method = 'get' .ucfirst($key);
		$this->$key = $this->$method();
		return $this->$key;
	}
	public static function load( $id ) {
		$instance = new self();
		$instance->selectBy('id', $id );
		return $instance;
}
public static function fromArray( array $row ) {

	$instance = new self();
	$instance->fill( $row );
	return $instance;
}
public static function withRow( array $row ) {
		$instance = new self();
		$instance->fill( $row );
		return $instance;
}
public function create($row) {
	$this->fill($row);
	return $this->insert();
}
public function initEntity($row) {
	return $this->fill($row);
}
// public static function create($tableName, array $row) {
// 	$table = App::getInstance()->getTable($tableName);
// })
// public static function loadBy($tableName, $col, $val ) {
// 	// do query
// //	$instance = new self();
// // var_dump('Entity loadBy');

// 	// $table = $tableName . "Table";
// 	$table = App::getInstance()->getTable($tableName);
// 	// $instance = new $table();
// 	$row = $table->selectBy($col, $val);
// 	if ($row) {
// 		return $this->fill( $row );
// 	}
// 	return $row;
// }
public function loadByCol($col, $value ) {
		// do query
		$table = App::getInstance()->getTable($this->tableName);
		return $table->selectBy($col, $value);
		// $row = $table->selectBy($col, $value);
		// if ($row) {
		// 	var_dump($row);
		// 	return $this->fill( $row );
		// }
		// return $row;
}
  public function fill( $row ) {
		// fill all properties from array
		// var_dump($row);
		if (!is_array($row)) {
			foreach ($row as $key => $value) {
				$this->values[$key] = $row->$key;
			}
		} else {
			foreach ($row as $key => $value) {
					$this->values[$key] = $row[$key];
			}
		}
		// var_dump($row);
		// var_dump($this->values);
		return $this;
	}
	public function insert() {
		$table = App::getInstance()->getTable($this->tableName);
		// var_dump($this->values);
		$table->insert($this->values);
		return App::getInstance()->getDb()->lastInsertId();
	}
}