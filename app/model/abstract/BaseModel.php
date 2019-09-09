<?php

namespace App\Model;

/**
 * Provádí operace nad databázovou tabulkou.
 */
abstract class BaseModel
{

	use \Nette\SmartObject;

	/** @var Nette\Database\Context */
	protected $connection;

	private $tableName;


	public function __construct(\Nette\Database\Context $db)
	{
		$this->connection = $db;
		$this->getTableName();
	}


	public function getTableName()
	{
		if (is_null($this->tableName)) {
			$m = [];
			preg_match('#(\w+)Model$#', get_class($this), $m);
			$this->tableName = strtolower(preg_replace('/\B([A-Z])/', '_$1', $m[1]));
		}
		return $this->tableName;
	}


	public function getTable()
	{
		return $this->connection->table($this->tableName);
	}


	public function getConnection()
	{
		return $this->connection;
	}


	/**
	 * Vrací řádky podle filtru, např. array('name' => 'John').
	 * @return Nette\Database\Table\Selection
	 */
	public function findBy(array $by)
	{
		return $this->getTable()->where($by);
	}


	public function findById($id)
	{
		return $this->getTable()->get($id);
	}


	public function get($id)
	{
		return $this->getTable()->get($id);
	}


	public function findAll()
	{
		return $this->getTable();
	}

}
