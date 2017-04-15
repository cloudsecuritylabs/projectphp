<?php

/* ********************************************************************	*/
/* Description:															*/
/*																		*/
/*																		*/
/*																		*/
/*																		*/
/*																		*/
/*																		*/
/* ********************************************************************	*/

class User
{
	/* ****************************************************************	*/
	/* Class Variables													*/
	/*																	*/
	/*																	*/
	/*																	*/
	/*																	*/
	/*																	*/
	/* ****************************************************************	*/
	
	public static $classDetails	= array(
		// Class specific details (value pairs - must not be array)
		'className' 		=>	"User",
		'tableName' 		=>	"Users",
		'table_id_name' 	=> 	"id",
		
		// Field Specific Details
		'id'			=> array( 'FieldName' => "id", 			'FriendlyName' => "Id",				'VarType' => "INT",		'VarSize' => 11,	'Required' => FALSE,	'FieldType' => "TEXT",		'DefaultValue' => 0 ),
		'firstName'		=> array( 'FieldName' => "firstName", 	'FriendlyName' => "First Name",		'VarType' => "VARCHAR",	'VarSize' => 100,	'Required' => FALSE,	'FieldType' => "TEXT",		'DefaultValue' => "" ),
		'lastName'		=> array( 'FieldName' => "lastName", 	'FriendlyName' => "Last Name",		'VarType' => "VARCHAR",	'VarSize' => 100,	'Required' => FALSE,	'FieldType' => "TEXT",		'DefaultValue' => "" ),
		'email'			=> array( 'FieldName' => "email", 		'FriendlyName' => "Email",			'VarType' => "VARCHAR",	'VarSize' => 100,	'Required' => FALSE,	'FieldType' => "EMAIL",		'DefaultValue' => "" ),
		'password'		=> array( 'FieldName' => "password", 	'FriendlyName' => "Password",		'VarType' => "VARCHAR",	'VarSize' => 100,	'Required' => FALSE,	'FieldType' => "PASSWORD",	'DefaultValue' => "" ),
		'displayName'	=> array( 'FieldName' => "displayName", 'FriendlyName' => "Display Name",	'VarType' => "VARCHAR",	'VarSize' => 100,	'Required' => FALSE,	'FieldType' => "TEXT",		'DefaultValue' => "" )
		
		);
		
	private $last_stmt_return_message = array();
	private $validationMessages = array(
			'firstName'		=> "",
			'lastName'		=> "",
			'email'			=> "",
			'password'		=> "",
			'displayName'	=> ""
		);
	
	private $id;	
	private $firstName;
	private $lastName;
	private $email;
	private $password;
	private $displayName;	
	
	/* ****************************************************************	*/
	/* Constructors and Destructors										*/
	/*																	*/
	/*																	*/
	/*																	*/
	/*																	*/
	/*																	*/
	/* ****************************************************************	*/
	function __construct() {
	}
	
	function __destruct() {
	}
	
	/* ****************************************************************	*/
	/* Agnostic Database Functions										*/
	/*																	*/
	/*																	*/
	/*																	*/
	/*																	*/
	/*																	*/
	/* ****************************************************************	*/
	
	protected function buildClassAsArray() {
		$attributes = array();
		
		foreach(self::$classDetails as $key => $value) {
			if ( is_array($value) ) {
				if(property_exists($this, $value['FieldName'])) {
					$attributes[$value['FieldName']] = $this->{$value['FieldName']};
				}
			}
		}
		
		return $attributes;
	}
	
	protected function attributes() {
		$attributes = array();
		
		foreach(self::$classDetails as $key => $value) {
			if ( is_array($value) ) {
				if(property_exists($this, $value['FieldName'])) {
					$attributes[$value['FieldName']] = $this->{$value['FieldName']};
				}
			}
		}
		
		return $attributes;		
	}
	
	
	
	private function has_attribute($attribute) {
		return array_key_exists($attribute, $this->attributes());
	}
	
	private static function instantiate($record) {
		$object = new self;
		
		foreach ($record as $attribute=>$value) {
			if($object->has_attribute($attribute)) {
				$object->$attribute = $value;
			}
		}
		
		return $object;
	}	
	
	public static function find_By_SQL($sql_Query){
		// Get or instantiate connection to database
		$db = Database::getDB();
		
		$result = $db->query($sql_Query);
		$result->setFetchMode(PDO::FETCH_CLASS, self::$classDetails['className']);
		
		$object_array = array();
		while ( $row = $result->fetch() ) {
			$object_array[] = self::instantiate($row);
		}
		
		return $object_array;		
	}
	
	public static function find_All() {
		$sql = "SELECT	*
				FROM	".self::$classDetails['tableName'].";";
		
		return self::find_By_SQL($sql);		
	}
	
	public static function find_By_Id($id=0) {
		$sql = "SELECT	*
				FROM	".self::$classDetails['tableName']."
				WHERE	".self::$table_id_name."={$id}
				LIMIT	1;";
		
		$result_array = self::find_By_SQL($sql);
		
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public function create() {
		// Get or instantiate connection to database
		$db = Database::getDB();
		
		// Build array of keys and values
		$thisClassAsArray = $this->buildClassAsArray();
		
		// Build SQL Statement
		$sql = "	INSERT INTO ".self::$classDetails['tableName'];
		$sql .= "	(".join(", ", array_keys($thisClassAsArray)).") ";
		$sql .= "	VALUES (";
		$sql .= ":".join(", :", array_keys($thisClassAsArray));
		$sql .= ")";		
		
		// Create array of: ':field1' => $field1
		// This is used as they key/value pairs to present data to the prepared statement
		$attribute_pairs = array();
		foreach($thisClassAsArray as $key=> $value) {
			$attribute_pairs[':'.$key] = $value;
		}
		
		// Set and execute statement
		$stmt = $db->prepare($sql);
		$stmt_return = $stmt->execute($attribute_pairs);
		
		// Use $stmt_return for troubleshooting
		$this->last_stmt_return_message = $stmt->errorInfo();
		
		// Check row count to make sure insert was successful
		if( $stmt->rowCount() ) {
			// Update the Id Number
			$this->setId($db->lastInsertId());
			return true;
		}
		
		return false;
	}
	
	public function update() {
		// Get or instantiate connection to database
		$db = Database::getDB();
		
		// Build array of keys and values
		$attributes = $this->buildClassAsArray();
		$attribute_pairs = array();
		foreach($attributes as $key => $value ) {
			array_push($attribute_pairs, "{$key}='{$value}'");
		}
		
		// Build SQL Statement
		$sql = 	"	UPDATE 	".self::$classDetails['tableName'];
		$sql .= " 	SET 	".join(", ", $attribute_pairs);
		$sql .= " 	WHERE 	".self::$table_id_name."=".$this->getId().";";		
		
		// Set and execute statement
		$stmt = $db->prepare($sql);
		$stmt_return = $stmt->execute();
		
		// Use $stmt_return for troubleshooting
		$this->last_stmt_return_message = $stmt->errorInfo();
		
		return ($stmt->rowCount() == 1) ? TRUE : FALSE;
		
	}
	
	public function save() {
		return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function delete() {
		// Get or instantiate connection to database
		$db = Database::getDB();
		
		// Build SQL Statement
		$sql = 	"	DELETE FROM ".self::$classDetails['tableName'];
		$sql .= " 	WHERE 		".self::$table_id_name."=".$this->getId();
		$sql .= " 	LIMIT 		 1;";		
		
		// Set and execute statement
		$stmt = $db->prepare($sql);
		$stmt_return = $stmt->execute();
		
		// Use $stmt_return for troubleshooting
		$this->last_stmt_return_message = $stmt->errorInfo();
		
		return ($stmt->rowCount() == 1) ? TRUE : FALSE;		
	}
	
	/* ****************************************************************	*/
	/* Getter Functions													*/
	/*																	*/
	/*																	*/
	/*																	*/
	/*																	*/
	/*																	*/
	/* ****************************************************************	*/
	public function getFirstName() {
		return $this->firstName;
	}
	public function getLastName() {
		return $this->lastName;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getPassword() {
		/* This function has been intentionally crippled! */
		/* Exposing the password is a security risk!	  */
		return '';
	}
	public function getDisplayName() {
		return $this->displayName;
	}	
	public function getValidationMessages() {
		return $this->validationMessages;
	}
	
	/* ****************************************************************	*/
	/* Setter Functions													*/
	/*																	*/
	/*																	*/
	/*																	*/
	/*																	*/
	/*																	*/
	/* ****************************************************************	*/
	public function setFirstName($new_firstName = '') {
		$fieldName = 'firstName';
		$value = $new_firstName;
		
		if($this->validateField($fieldName, $value)) {
			$this->$fieldName = $value;
			$this->setValidationMessages($fieldName, "");
		}
	}
	
	public function setLastName($new_lastName = '') {
		$fieldName = 'lastName';
		$value = $new_lastName;
		
		if($this->validateField($fieldName, $value)) {
			$this->$fieldName = $value;
			$this->setValidationMessages($fieldName, "");
		}
	}
	
	public function setEmail($new_email = '') {
		$fieldName = 'email';
		$value = $new_email;
		
		if($this->validateField($fieldName, $value)) {
			$this->$fieldName = $value;
			$this->setValidationMessages($fieldName, "");
		}
	}
	
	public function setPassword($new_password = '') {
		$fieldName = 'password';
		$value = $new_password;
		
		if($this->validateField($fieldName, $value)) {
			$this->$fieldName = $value;
			$this->setValidationMessages($fieldName, "");
		}
	}
	
	public function setDisplayName($new_displayName = '') {
		$fieldName = 'displayName';
		$value = $new_displayName;
		
		if($this->validateField($fieldName, $value)) {
			$this->$fieldName = $value;
			$this->setValidationMessages($fieldName, "");
		}
	}
	
	/* ****************************************************************	*/
	/* Private Functions												*/
	/*																	*/
	/*																	*/
	/*																	*/
	/*																	*/
	/*																	*/
	/* ****************************************************************	*/
	private function setId($new_id) {
		$this->id = $new_id;
	}
	private function getId() {
		return $this->id;
	}
	private function validateField($fieldName, $value) {
		// Check if field is required
		if ( $this::$classDetails[$fieldName]['Required'] )
		{
			// Check for no value
			if(strlen($value) === 0)
			{
				$this->setValidationMessages($fieldName, "Field is required.");
				return FALSE;
			}
		}
		
		// Check to make sure string is not longer than database size.
		if (strlen($value) > $this::$classDetails[$fieldName]['VarSize'] )
		{
			$this->setValidationMessages($fieldName, "Value is too long.");
			return FALSE;
		}
		
		return TRUE;		
	}
	private function setValidationMessages($fieldName, $msgValue){
		$this->validationMessages[$fieldName] = $msgValue;
	}
	
	
	/* ****************************************************************	*/
	/* Public Functions													*/
	/*																	*/
	/*																	*/
	/*																	*/
	/*																	*/
	/*																	*/
	/* ****************************************************************	*/
	public function validateCredentials($loginName, $loginPassword){
		if ( $this->email == $loginName
			&& $this->password == $loginPassword ) 
		{
			return true;
		}
		return false;
	}
	public function isValidState() {
		foreach ($this->validationMessages as $key => $value) {
			if ( strlen($value) > 0 ) {
				return FALSE;
			}
		}
		return TRUE;
	}
}
