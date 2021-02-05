<?php
namespace Core\Business;
use App;
use Core\Entity\Entity;

class Business {
protected  $entityFactory;

    public function __construct() {

    }
private function getEntity($tableName) {
		if ($this->entityFactory == null) {
			$this->entityFactory = new EntityFactory();
		}
		return $this->entityFactory->get($tableName);
	}
	public function load($table, $col, $val) {
		return $this->getEntity($table)->loadByCol($col, $val);
	}
	public function loadBy($table, $col, $val)
	{
		return $this->getEntity($table)->loadByCol($col, $val);
	}
	public function create($tableName, $row)
	{
		return $this->getEntity($tableName)->create($row);

		// Entity::create($table, $col, $value);
	}
	public function initEntity($tableName, $row) {
		return $this->getEntity($tableName)->initEntity($row);
	}
	public function fromArray($userData) {
		$this->getEntity($table)->init($userData);
	}
	public function UserId() {
		return $this->getAuth()->getUserId();
	}
	public function console_log($message) {
		App::console_log($message);
	}
	public function getBody() {
		return file_get_contents('php://input');
	}
}