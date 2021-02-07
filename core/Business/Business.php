<?php
namespace Core\Business;
use App;
use Core\Entity\Entity;
use Core\Auth\DbAuth;

class Business {
protected  $entityFactory;
protected object $auth;

    public function __construct() {
			$this->auth = $this->getAuth();
	
		}
		    /**
     * Set new instance of DbAuth
     * 
     * @return DbAuth
     */
    protected function getAuth() {
			return new DbAuth (App::getInstance()->getDb());
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
	public function fromArray($tableName, $userData) {
		return $this->getEntity($tableName)->init($userData);
	}
	public function UserId() {
		return $this->getAuth()->getUserId();
	}
	public function console_log($message) {
		App::console_log($message);
	}

}