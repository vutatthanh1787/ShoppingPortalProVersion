<?php 
	/**
	* 
	*/
	class Database
	{
		// Khai bao bien
		private static $Instance = null;
		private $_mysqli,
				$_dbHost = 'localhost',
				$_dbUser = 'root',
				$_dbPass = 'root' ,
				$_dbName = 'shopping',
				$_error = false,
				$_results,
				$_count;

        /**
         * Database constructor.
         */
        public function __construct(){
			$this->_mysqli = new mysqli ( $this->_dbHost, $this->_dbUser, $this->_dbPass, $this->_dbName );
			if( mysqli_connect_error() ){
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
			}
		}

        /**
         * @return Database|null
         */
        public static function getInstance(){
			if( !isset( self::$Instance ) ){
				self::$Instance = new Database();
			}
			return self::$Instance;
		}

        /**
         * @param $table
         * @param string $column
         * @param string $value
         * @return $this
         */
        public function get_info($table , $column = '' , $value = ''){
			// Neu gia tri nhap vao khong phai la so nguyen
            $this->_error = false;
			if (!is_int($value)) {
				$value = "'". $value ."'";
				// kiem tra cot nhap vao co null hay k
				if ($column != '') {
					$sql = "SELECT * FROM $table WHERE $column=$value";
//					var_dump($this->_mysqli->query($sql));
					if ($query = $this->_mysqli->query($sql)){ // Khong thuc hien duoc query
                        $this->_count = $query->num_rows;
//                        print_r('count = ' . $this->_count);
//                        die();
                        if ($this->_count > 0){
                            while ($row = $query->fetch_assoc()) {
                                $this->_results = $row;
                            }
                        }
                    }else{
					    $this->_error = true;
                    }
				}else{
				    $sql = "SELECT * FROM $table";
				    if ($query = $this->_mysqli->query($sql)){
                        $this->_count = $query->num_rows;
                        if ($this->_count > 0){
                            while ($row = $query->fetch_assoc()) {
                                $this->_results[] = $row;
                            }
                        }
                    }else{
                        $this->_error = true;
                    }
                }
			}else{
			    $sql = "SELECT * FROM $table WHERE $column=$value";
                if ($query = $this->_mysqli->query($sql)){ // Khong thuc hien duoc query
                    $this->_count = $query->num_rows;
                    if ($this->_count > 0){
                        while ($row = $query->fetch_assoc()) {
                            $this->_results = $row;
                        }
                    }
                }else{
                    $this->_error = true;
                }
            }
            return $this;
		}


        /**
         * @param $table
         * @param array $fields
         * @return $this
         */
        public function insert($table, $fields = array()){
            $column = implode(",", array_keys($fields));
            //print_r($column);
            $valuesArrays = array();
            $i = 0;
            foreach($fields as $key=>$value){
                if( is_int($value) )
                    $valuesArrays[$i] = $this->escape($value);
                else
                    $valuesArrays[$i] = "'" . $this->escape($value) . "'";
                $i++;
            }
            $values = implode(", ", $valuesArrays);
            $sql = "INSERT INTO $table($column) VALUES($values)";
            if ($this->run_query($sql))
                $this->_error = false;
            else
                $this->_error = true;
            return $this;
        }

        /**
         * @param $table
         * @param $id
         * @param array $fields
         * @return $this
         */
        public function update($table, $id, $fields = array()){
            $valuesArrays = array();
            $i = 0;
            foreach ($fields as $key=>$value) {
                if (is_int($value))
                    $valuesArrays[$i] = $key . "=" . $this->escape($value);
                else
                    $valuesArrays[$i] = $key . "=" . "'" . $this->escape($value) . "'";
                $i++;
            }
            $values = implode(",", $valuesArrays);
            $sql = "UPDATE users SET $values WHERE id = $id";
            if ($this->run_query($sql))
                $this->_error = false;
            else
                $this->_error = true;
            return $this;
        }

        public function delete($table, $id = null){
            if (is_int($id) && $id != null){
                $sql = "DELETE FROM $table WHERE id = $id";
                if ($this->run_query($sql))
                    $this->_error = false;
                else
                    $this->_error = true;
            }else{
                throw  new Exception('Id Not Integer!');
            }
            return $this;
        }

        /**
         * @param $sql
         * @param $msg
         * @return bool
         */
        public function run_query($sql){
			if ( $this->_mysqli->query($sql) ) {
				return true;
			}else{
				return false;
			}
		}

        /**
         * @return mixed
         */
        public function results(){
			return $this->_results;
		}

        /**
         * @return mixed
         */
        public function count(){
		    return $this->_count;
        }

        /**
         * @return mixed
         */
        public function first(){
			return $this->_results[0];
		}

        /**
         * @return bool
         */
        public function error(){
			return $this->_error;
		}

        /**
         * @param $name
         * @return mixed
         */
        public function escape($name)
		{
			return $this->_mysqli->real_escape_string($name);
		}
	}
 ?>