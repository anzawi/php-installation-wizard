<?php namespace Wizaraty\Classes\Costum;

class Model extends \Wizaraty\Classes\DB
{
	public function __construct($host, $db, $username, $password)
	{
			 $this->_hostname 	 = $host;
			 $this->_dbname 	 = $db;
			 $this->_usename 	 = $username;
			 $this->_password 	 = $password;
	}

	public function testConnection()
	{
		$connect = $this->connect();
		 if(is_object($connect))
		 	 return true;
		 return false;
	}

	public function tables()
	{
		$this->table('users')->schema([
				'id' => 'increments',
				'username' => 'string:255',
				'email' => 'string:255',
				'password' => 'string:255',
				'joind' => 'timestamp',
				'permissions' => 'int|default:0'
		])->create();


		$this->table('permissions')->schema([
				'id' => 'increments',
				'name' => 'string:255'
		])->create();



		$this->table('any_thing')->schema([
				'id' => 'increments',
				'username' => 'string:255',
				'email' => 'string:255',
				'password' => 'string:255'
		])->create();



		$this->table('test')->schema([
				'id' => 'increments',
				'utest_name' => 'string:255'
		])->create();

		return true;
	}


	public function createAdmin($information)
	{
		$this->table('users')->insert($information);
	}
}