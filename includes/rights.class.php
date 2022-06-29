<?php
class Rights {
    private $db;
    private $settings;
    public $rights;

    public function __construct($db,$settings,$userId) {
	$this->db = $db;
	$this->settings = $settings;
	$this->userId = $userId;
	$this->getUsergroups();
	$this->getRights();
    }
    
    
    public function getUsergroups() {
	$sql = "SELECT uID, rID FROM user_rights WHERE uID='".$this->userId."'";
	$result = $this->db->query($sql);
	$group_r = array();
	while($row = $result->fetch_array()) {
	    $group_r[] = $row['rID'];
	}
	return $this->groups = $group_r;
	
    }
    
    /* This is not yet ready.*/
    public function getRights() {
	$query = "    SELECT *
		     FROM rules
		     WHERE (    Leveltype = 'group' AND LevelID IN (0,". implode(',',(array)$this->groups) .") OR
			      (Leveltype = 'user' AND LevelID = '". $this->userId."') )
		     ORDER BY Leveltype DESC";
	//echo $query;
	$result = $this->db->query($query);
	

	if($result->num_rows == 0) {
	    throw new Exception("No rules where found for this user.");
	}
	
	$actions = array('view','move','del','make','edit');

	while($row = $result->fetch_array()) {
	    foreach($actions AS $action) {

		if($row['Leveltype'] == 'group') {
		    if($rights[ $row['Actionkind'] ][ $row['ActionID'] ][$action] == 1) {
			;
		    // nee, hier doen we niks.
		    }
		    elseif($row[$action] == 1) {
			$rights[ $row['Actionkind'] ][ $row['ActionID'] ][$action] = 1;
		    }
		    else {
			$rights[ $row['Actionkind'] ][ $row['ActionID'] ][$action] = 0;
		    }
		}
		else {
		    if($row[$action] === NULL) {
			;
		    }
		    elseif($row[$action] == 1) {
			$rights[ $row['Actionkind'] ][ $row['ActionID'] ][$action] = 1;
		    }
		    else {
			$rights[ $row['Actionkind'] ][ $row['ActionID'] ][$action] = 0;
		    }
		}

	    }
	}
	//return true;
	return $this->rights = $rights;
     }   
 
    public function checkRights($what, $id = 0, $action = "view") {
       if(isset($this->rights[$what][$id][$action])) {
	   if(!$this->rights[$what][$id][$action]) {
	       return false;
	   } else {
	       return true;
	   }
       } else {
	   return null;
       }
   }
}