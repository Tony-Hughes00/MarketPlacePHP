<?php

namespace Core\Entity;
use \App;
/**
 * Entity class
 * @package Core\Entity
 */
class Entity {
	protected $values;
	public $tableName = "";

	public function __construct() {
		App::console_log( "Entity constructor" );
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
		$instance->loadByCol('id', $id );
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
public static function loadBy($tableName, $col, $val ) {
	// do query
//	$instance = new self();
	$table = $tableName . "Table";
	$instance = new $table();
	$instance->loadByCol($col, $val);
	if ($row) {
		return $this->fill( $row );
	}
	return $row;
}
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
		if (is_object($row)) {
			foreach ($this->values as $key => $value) {
				$this->values[$key] = $row->$key;
			}
		} else {
			foreach ($this->values as $key => $value) {
				if (isset($row[$key])) {
					$this->$key = $row[$key];
				}
			}
		}
		var_dump($row);
		var_dump($this->values);
		return $this;
	}
	public function insert() {
		$table = App::getInstance()->getTable($this->tableName);
		$table->insert($this->values);
		return App::getInstance()->getDb()->lastInsertId();
	}
}