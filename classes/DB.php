<?php namespace Wizaraty\Classes;

class DB
{
	private $_db = null;

	protected $_hostname 	 = '',
			  $_dbname 		 = '',
			  $_usename 	 = '',
			  $_password 	 = '',
			  $_prefix 		 = '',
			  $_table		 = '',
			  $_query 		 = '',
			  $_storegEngine = "ENGINE=InnoDB";


	protected function connect()
	{
		if($this->_db === null)
		{
			@$this->_db = new \mysqli($this->_hostname, $this->_usename, $this->_password, $this->_dbname);
			@$this->_db->set_charset("utf8");

			if($this->_db->connect_errno)
				return null;
			
		}

		return $this->_db;
	}

/*
        table('table')->schema([
            'column_name' => 'type',
            'column_name' => 'type|constraint',
            'column_name' => 'type|constraint,more_constraint,other_constraint',

        ])->create();

     */ 
    
    /*
        'id' => 'increments'
        mean -> this field is primary key, auto increment not null,  and unsigned
     */
    
    /**
     * set _table var value
     * @param  string $table the table name
     * @return object   retrun DB object
     */
    protected function table($table)
    {
        $this->_table = $table;
        return $this;
    }

    /**
     * set _schema var value
     * @param  array  $structers the structer od table
     * @return object   retrun DB object
     */
    protected function schema($structers = [])
    {
        if(count($structers)) // check if isset $structers
        {
            /**
             * to store columns structers
             * @var array
             */
            $schema = [];

            foreach($structers as $column => $options)
            {
                $type = $options; // the type is the prototype of column
                $constraints = ''; // store all constraints for one column

                // check if we have a onstraints
                if(!strpos($options, '|') === false)
                {
                    
                    $constraints = explode('|', $options); // the separator to constraints is --> | <--
                    $type = $constraints[0]; // the type is first key
                    unset($constraints[0]); // remove type from onstraints
                    $constraints = implode(' ', $constraints); // convert constraints to string
                    $constraints = strtr($constraints, [
                        'primary' => 'PRIMARY KEY', // change (primary to PRIMARY KEY -> its valid constraint in sql)
                        'increment' => 'AUTO_INCREMENT', // same primary
                        'not_null' => 'NOT NULL', // same primary
                    ]);
                }
                
                // checck if type is increments we want to change it to integer and  and add some constraints like primary key ,not null, unsigned and auto increment
                ($type == 'increments'? $type = "INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL": null);
                
                // check if type of column is string change it to valid sql type (VARCHAR and set lingth)
                // ['username' => 'string:255'] convert to username VARCHAR(255)
                if(strpos($type, 'string') !== false)
                {
                    $type = explode(':', $type); 
                    $type = "VARCHAR({$type[1]})";
                }

                // check if column has a default value
                // ['username' => 'string:255|default:no-name'] convert to username VARCHAR(255) DEFAULT 'no name'
                if(strpos($constraints, 'default') !== false)
                {
                    preg_match("/(:)[A-Za-z0-9]+/", $constraints, $match);
                    $match[0] = str_replace(':', '', $match[0]);
                    $temp = str_replace('-', ' ', $match[0]);
                    $constraints = str_replace(":".$match[0] , " '{$temp}' ", $constraints);
                }

                // add key to schema var contains column _type constraints
                // ex: username VARCHAR(255) DEFUALT 'no name' NOT NULL
                $schema[] = "$column $type " . $constraints;
                
            }

            // set _scema the all columns structure
            $this->_schema = '(' . implode(",", $schema) . ')';
          
            return $this; // return DB object
        }

        return null; // return null
    }

    /**
     * this methode to run sql statment and create table
     * @param  string $createStatement its create statement -> i mean you can change it to ->  CREATE :table IF NOT EXIST
     * @return bool
     */
    protected function create($createStatement = "CREATE TABLE :table")
    {
        $this->connect();
        $createStatement = str_replace(':table', $this->_table, $createStatement);
        echo $createStatement . $this->_schema;
        try
        {
            $query = $this->_db->prepare($createStatement . $this->_schema);
            $query->execute();
        }
        catch(\mysqli_sql_exception $e)
        {
             print $e->getMessage();
                return false;
        }

        return true;
    }


	protected function insert($values = []) 
    { 
        // check if $values set 
        if(count($values))
        { 
            /** 
             * @var $fields type array 
             * store fields user want insert value for them 
             */ 
            $fields = array_keys($values); 
            /** 
             * @var $value type string 
             * store value for fields user want inserted 
             */ 
            $value = ''; 
            /** 
             * @var $x type int 
             * counter 
             */ 
            $x = 1; 
            foreach($values as $field)
            { 
                // add new value 
                $value .="$field"; 
                
                if($x < count($values)) { 
                    // add comma between values 
                    $value .= ", "; 
                } 
                $x++; 
            } 
             // generate sql statement 
            $sql = "INSERT INTO {$this->_table} (`" . implode('`,`', $fields) ."`)"; 
            $sql .= " VALUES ({$value})"; 
            // check if query is not have an error 
            $query = $this->connect()->prepare($sql);
            if($query)
            { 
                $query->execute();
                return true; 
            } 
        } 
        
        return false; 
    } 

}