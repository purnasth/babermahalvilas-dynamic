<?php
class Subpackage extends DatabaseObject {

	protected static $table_name = "tbl_package_sub";
	protected static $db_fields = array('id', 'title', 'detail', 'facility_title', 'feature', 'image', 'image2', 'content', 'no_rooms', 'currency', 'discount', 'people_qnty', 'room_price', 'status', 'sortorder', 'added_date', 'type');
	
	public $id;
	public $title;
	public $detail;
	public $feature;
	public $image;
	public $image2;
	public $content;
	public $facility_title;
	public $no_rooms;
	public $currency;
	public $discount;
	public $people_qnty;
	public $room_price;
	public $status;
	public $sortorder;
	public $added_date;
	public $type;

	//Get Facility Ttle
	public static function getFacility() { 
		global $db;
		$sql = "SELECT facility_title FROM ".self::$table_name." WHERE status=1 ORDER BY sortorder ASC";
		return self::find_by_sql($sql);
	}

	// homepage package list	
	public static function getPackage_limit($type=0,$limit=''){
		global $db;
		$cond = !empty($limit)?' LIMIT '.$limit:'';
		$sql = "SELECT * FROM ".self::$table_name." WHERE type=$type AND status=1 ORDER BY sortorder ASC $cond ";
		return self::find_by_sql($sql);
	}

	public static function getTotalSub($type=''){
		global $db;
		$cond = !empty($type)?' AND type='.$type:'';
		$query = "SELECT COUNT(id) AS tot FROM ".self::$table_name." WHERE status=1 $cond ";
		$sql = $db->query($query);
		$ret = $db->fetch_array($sql);
		return $ret['tot'];
	}

	public static function get_relatedpkg($type='', $notid='')
	{
		global $db;
		$cond = !empty($type)?' AND type='.$type:'';
		$cond2 = !empty($notid)?' AND id<>'.$notid:'';
		$sql = "SELECT * FROM ".self::$table_name." WHERE status=1 $cond $cond2 ORDER BY sortorder DESC";
		return self::find_by_sql($sql);
	}

	//FIND THE HIGHEST MAX NUMBER BY PARENT ID.
	static function find_maximum_byparent($field="sortorder",$pid=""){
		global $db;
		$result = $db->query("SELECT MAX({$field}) AS maximum FROM ".self::$table_name." WHERE type={$pid}");
		$return = $db->fetch_array($result);
		return ($return) ? ($return['maximum']+1) : 1 ;
	}

	//FIND THE HIGHEST MAX NUMBER.
	public static function find_maximum($field="sortorder"){
		global $db;
		$result = $db->query("SELECT MAX({$field}) AS maximum FROM ".self::$table_name);
		$return = $db->fetch_array($result);
		return ($return) ? ($return['maximum']+1) : 1 ;
	}
	
	//Find all the rows in the current database table.
	public static function find_all(){
		global $db;
		return self::find_by_sql("SELECT * FROM ".self::$table_name." ORDER BY sortorder ASC");
	}

	public static function field_by_id($id=0,$fields=""){
		global $db;
		$sql = "SELECT $fields FROM ".self::$table_name." WHERE id={$id} LIMIT 1";
		$result = $db->query($sql);
		$return = $db->fetch_array($result);
		return ($return) ? $return[$fields] : '' ;
	}
	
	//Find a single row in the database where id is provided.
	public static function find_by_id($id=0){
		global $db;
		$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	//Find rows from the database provided the SQL statement.
	public static function find_by_sql($sql=""){
		global $db;
		$result_set = $db->query($sql);
		$object_array = array();
		while($row = $db->fetch_array($result_set)){
			$object_array[] = self::instantiate($row);
		}
		return $object_array;
	}
	
	//Instantiate all the attributes of the Class.
	private static function instantiate($record){
		$object  = new self;
		foreach($record as $attribute=>$value){
			if($object->has_attribute($attribute)){
				$object->$attribute = $value;
			}
		}
		return $object;
	}
	
	//Check if the attribute exists in the class.
	private function has_attribute($attribute){
		$object_vars = $this->attributes();
		return array_key_exists($attribute, $object_vars);
	}
	
	//Return an array of attribute keys and thier values.
	protected function attributes(){
		$attributes = array();
		foreach(self::$db_fields as $field):
			if(property_exists($this, $field)){
				$attributes[$field] = $this->$field;
			}
		endforeach;
		return $attributes;
	}
	
	//Prepare attributes for database.
	protected function sanitized_attributes(){
		global $db;
		$clean_attributes = array();
		foreach($this->attributes() as $key=>$value):
			$clean_attributes[$key] = $db->escape_value($value);
		endforeach;
		return $clean_attributes;
	}
	
	//Save the changes.
	public function save(){
		return isset($this->id) ? $this->update() : $this->create();
	}
	
	//Add  New Row to the database
	public function create(){
		global $db;
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO ".self::$table_name."(";
		$sql.= join(", ", array_keys($attributes));
		$sql.= ") VALUES ('";
		$sql.= join("', '", array_values($attributes));
		$sql.= "')";
		if($db->query($sql)){
			$this->id = $db->insert_id();
			return true;
		} else {
			return false;
		}
	}
	
	//Update a row in the database.
	public function update(){
		global $db;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		
		foreach($attributes as $key=>$value):
			$attribute_pairs[] = "{$key}='{$value}'";
		endforeach;
		
		$sql = "UPDATE ".self::$table_name." SET ";
		$sql.= join(", ", array_values($attribute_pairs));
		$sql.= " WHERE id=".$db->escape_value($this->id);
		$db->query($sql);
		return ($db->affected_rows()==1) ? true : false;
		//return true;
	}
}
?>