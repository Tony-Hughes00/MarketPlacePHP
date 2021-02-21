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
	protected $id;
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
// 	public static function load( $id ) {
// 		$instance = new self();
// 		$instance->selectBy('id', $id );
// 		return $instance;
// }
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
	$this->insert();
	return $this;
}
public function update($data) {
	
	$table = App::getInstance()->getTable($this->tableName);

	$table->update($this->{$this->id}, $data);

	$this->fill($data);

	return $this;
}
public function all() {
	$table = App::getInstance()->getTable($this->tableName);
	return $table->all();
}
public function initEntity($row) {
	return $this->fill($row);
}
public function loadByCol($col, $value ) {

		$table = App::getInstance()->getTable($this->tableName);
		$entity = $table->selectBy($col, $value);
		if (empty($entity)) {
			return null;
		}
		return $entity;

}
public function fill( $row ) {
		// fill all properties from array
		// var_dump($row);

		if (!is_array($row)) {
			$row_keys = array_keys($this->values);
			foreach ($row_keys as $key) {
				// var_dump($key);
				if (array_key_exists($key, $row)) {
					// var_dump($row[$key]);
					$this->{$key} = $row->{$key};
				}
			}
		} else {
			$row_keys = array_keys($this->values);
			foreach ($row_keys as $key) {
				// var_dump($key);
				if (array_key_exists($key, $row)) {
					// var_dump($row[$key]);
					$this->{$key} = $row[$key];
				}
			}
		}
		// var_dump($row);
		// var_dump($this->values);
		return $this;
	}
	public function insert() {
		$table = App::getInstance()->getTable($this->tableName);
		// var_dump($this->values);
		$table->insert($this);
		return App::getInstance()->getDb()->lastInsertId();
	}
}