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
		parent::__construct();
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
	public static function loadFromID( $id ) {
		$instance = new self();
		$instance->loadByID( $id );
		return $instance;
}


public static function withRow( array $row ) {
		$instance = new self();
		$instance->fill( $row );
		return $instance;
}

public function loadByEmail( $email ) {
		// do query
		$table = App::getInstance()->getTable($this->tableName);
		$row = $table->selectUserByEmail($email);
		if ($row) {
			return $this->fill( $row );
		}
		return $row;
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
					$this->values[$key] = $row[$key];
				}
			}
		}
		return $this;
	}
	public function insert() {
		$table = App::getInstance()->getTable($this->tableName);
		$table->insert($this->values);
		return App::getInstance()->getDb()->lastInsertId();
	}
}