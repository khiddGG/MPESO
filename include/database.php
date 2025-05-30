<?php
require_once(LIB_PATH.DS."config.php");
class Database {
	var $sql_string = '';
	var $error_no = 0;
	var $error_msg = '';
	private $conn;
	public $last_query;
	// private $magic_quotes_active;
	private $real_escape_string_exists;
	
	function __construct() {
		$this->open_connection();
		// $this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists("mysqli_real_escape_string");
	}
	
	public function open_connection() {
		$this->conn = mysqli_connect(server,user,pass);
		if(!$this->conn){
			$this->error_msg = "Problem in database connection! Contact administrator!";
			error_log($this->error_msg);
			exit();
		} else {
			$db_select = mysqli_select_db($this->conn,database_name);
			if (!$db_select) {
				$this->error_msg = "Problem in selecting database! Contact administrator!";
				error_log($this->error_msg);
				exit();
			}
		}
	}
	
	function setQuery($sql='') {
		$this->sql_string = $sql;
		$this->last_query = $sql;
		error_log("Setting query: " . $sql);
		return true;
	}
	
	function executeQuery() {
		error_log("Executing query: " . $this->sql_string);
		$result = mysqli_query($this->conn, $this->sql_string);
		if(!$result) {
			$this->error_no = mysqli_errno($this->conn);
			$this->error_msg = mysqli_error($this->conn);
			error_log("Database Error: " . $this->error_msg . " (Error No: " . $this->error_no . ")");
			error_log("Failed Query: " . $this->sql_string);
			return false;
		}
		return $result;
	}	
	
	function loadResultList( $key='' ) {
		$cur = $this->executeQuery();
		
		if(!$cur) {
			error_log("Failed to load result list: " . $this->error_msg);
			return array();
		}
		
		$array = array();
		while ($row = mysqli_fetch_object($cur)) {
			if ($key) {
				$array[$row->$key] = $row;
			} else {
				$array[] = $row;
			}
		}
		mysqli_free_result( $cur );
		return $array;
	}
	
	function loadSingleResult() {
		$cur = $this->executeQuery();
			
		if(!$cur) {
			error_log("Failed to load single result: " . $this->error_msg);
			return null;
		}
		
		$row = mysqli_fetch_object($cur);
		mysqli_free_result($cur);
		return $row;
	}
	
	function getFieldsOnOneTable($tbl_name) {
	
		$this->setQuery("DESC ".$tbl_name);
		$rows = $this->loadResultList();
		
		$f = array();
		for ( $x=0; $x<count($rows); $x++ ) {
			$f[] = $rows[$x]->Field;
		}
		
		return $f;
	}	

	public function fetch_array($result) {
		return mysqli_fetch_array($result);
	}
	//gets the number or rows	
	public function num_rows($result_set) {
		return mysqli_num_rows($result_set);
	}
  
	public function insert_id() {
		$id = mysqli_insert_id($this->conn);
		error_log("Last insert ID: " . $id);
		return $id;
	}
  
	public function affected_rows() {
		return mysqli_affected_rows($this->conn);
	}
	
	 public function escape_value( $value ) {
		if($this->real_escape_string_exists) {
			$value = stripslashes($value);
			$value = mysqli_real_escape_string($this->conn, $value);
		} else {
			$value = addslashes($value);
		}
		return $value;
   	}
	
	public function close_connection() {
		if(isset($this->conn)) {
			mysqli_close($this->conn);
			unset($this->conn);
		}
	}
	
	public function getError() {
		return $this->error_msg . " (Error No: " . $this->error_no . ")";
	}
} 
$mydb = new Database();


?>
