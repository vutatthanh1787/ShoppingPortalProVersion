<?php 
	/**
	* 
	*/
	class Database
	{
		// Khai bao bien
		private static $Instance = null;
		private $_mysqli,
				$dbHost = 'localhost',
				$dbUser = 'root',
				$dbPass = 'root' ,
				$dbName = 'shopping',
				$_error = false,
				$_results,
				$_count;

        /**
         * Database constructor.
         */
        public function __construct(){
			$this->_mysqli = new mysqli ( $this->dbHost, $this->dbUser, $this->dbPass, $this->dbName );
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

		public function get_info($table , $column = '' ,$value = ''){
			// Neu gia tri nhap vao khong phai la so nguyen
            $this->_error = false;
			if (!is_int($value)) {
				$value = "'". $value ."'";
				// kiem tra cot nhap vao co null hay k
				if ($column != '') {
					$sql = "SELECT * FROM $table WHERE $column=$value";
					var_dump($this->_mysqli->query($sql));
					if ($query = $this->_mysqli->query($sql)){ // Khong thuc hien duoc query
                        $this->_count = $query->num_rows;
                        print_r($this->_count);
                        die('111');
                        while ($row = $query->fetch_assoc()) {
                            $this->_results = $row;
                        }
//                        $this->_error = true;
                    }else{
					    $this->_error = true;
                    }
				}else{
				    $sql = "SELECT * FROM $table";
				    if ($query = $this->_mysqli->query($sql)){
                        $this->_count = $query->num_rows;
                        while ($row = $query->fetch_assoc()) {
                            $this->_results[] = $row;
                        }
                    }else{
                        $this->_error = true;
                    }
                }
			}
            return $this;
		}

		public function run_query($sql, $msg){
			if ( $this->mysqli->query($sql) ) {
				return true;
			}else{
				echo $msg;
			}
		}

		public function results(){
			return $this->_results;
		}

		public function count(){
		    return $this->_count;
        }

		public function first(){
			return $this->_results[0];
		}

		public function error(){
			return $this->_error;
		}

		public function escape($name)
		{
			return $this->mysqli->real_escape_string($name);
		}
	}
 ?>