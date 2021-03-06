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
	public function get($table) {
    $data = $this->loadAll($table);

    return $data;
  }
private function getEntity($tableName) {
		if ($this->entityFactory == null) {
			$this->entityFactory = new EntityFactory();
		}
		return $this->entityFactory->get($tableName);
	}
	public function load($table, $col, $val) {
		// la requête doit retourne une seule record
		return $this->getEntity($table)->loadByCol($col, $val);
	}
	public function loadAll($table) {
		// var_dump(($table));
		return $this->getEntity($table)->all();
	}
	public function loadFiltre($table, $filtre) {
		return $this->getEntity($table)->all();
	}
	public function getByCol($table, $col, $val)
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