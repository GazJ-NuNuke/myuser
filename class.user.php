<?php

if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../index.php');
	exit('Access Denied');
}

//USE LIKE
// if(isset($user) && is_user($user)){
// $u = new myUser( $cookie[0], $cookie[1], $cookie[2]);
// }else{
// $u = new myUser( '', '', '');	
// }
// this class is for the logged in user to call profile data see pUser class
// created by jambo for jambo
//
// NOTE JAMBO MAKE IT GUEST FRIENDLY
////////////////////////

class myUser {
	private $id;
	private $username;
	private $password;

	function __construct($id, $username, $password) {
		global $db, $ip;
		$id = intval($id);
		$username = uclean_username($username);
		$password = uclean_password($password);
		$result = $db->sql_query("SELECT * FROM users WHERE id='".$id."' AND password='".$password."'");
		$num = intval($db->sql_numrows($result));
		$row = $db->sql_fetchrow($result);
		if($num){
		$id = intval($row['id']);
		$this->id = $id;  // make sure its int :)
		$this->password = uclean_password($password); // make sure its clean :)
		// start db side
		 // add if row to fix username guest breaking things
		$this->steam = filter($row['steam'],'nohtml', 0);
		$this->origin = filter($row['origin'],'nohtml', 0);
		$this->epicgames = filter($row['epicgames'],'nohtml', 0);
		$this->activision = filter($row['activision'],'nohtml', 0);
		$this->website = filter($row['website'],'nohtml', 0);
		$this->location = filter($row['location'],'nohtml', 0);
		$this->firstname = filter($row['firstname'],'nohtml', 0);
		$this->middlename = filter($row['middlename'],'nohtml', 0);
		$this->lastname = filter($row['lastname'],'nohtml', 0);
		$this->age = filter(intval($row['age']),'nohtml', 0);
		$this->gender = intval($row['gender']);
		$this->email = filter($row['email'],'nohtml', 0);
		$this->twitch = filter($row['twitch'],'nohtml', 0);
		$this->youtube = filter($row['youtube'],'nohtml', 0);
		$this->lastvisit = filter($row['lastvisit'],'nohtml', 0);
		$this->last_ip = filter($row['last_ip'],'nohtml', 0);
		$this->created_at = filter($row['created_at'],'nohtml', 0);
		$this->avatar = filter($row['avatar'],'nohtml', 0);
		$this->username = uclean_username($row['username'], 0); // make sure its clean :)
		$this->bio = filter($row['bio'],'html', 0);
		$this->user_level = intval($row['user_level']);
		}else{
		$this->steam = '';
		$this->origin = '';
		$this->epicgames = '';
		$this->activision = '';
		$this->website = filter('someFBIshit.com','nohtml', 0);
		$this->location = filter('Cyber Space','nohtml', 0);
		$this->realname = filter('George Guest','nohtml', 0);
		$this->firstname = filter('George','nohtml', 0);
		$this->middlename = filter('A','nohtml', 0);
		$this->lastname = filter('Guest','nohtml', 0);
		$this->age = '';
		$this->gender = '';
		$this->email = '';
		$this->twitch = '';
		$this->youtube = '';
		$this->lastvisit = date('l jS \of F Y h:i:s A');
		$this->last_ip = $ip;
		$this->created_at = '';
		$this->avatar = '';
		$this->username = 'Guest- '.$ip;
		$this->bio = '';
		$this->user_level = 0;
		}
	}
// start calling 
	function getID() {
		return $this->id;
	} 
	function getUserName() {
		global $db, $ip;
		$sql = "SELECT username FROM users WHERE id='".$this->id."' AND password='".$this->password."'";
        $result = $db->sql_query($sql);
        list($row) = $db->sql_fetchrow($result);
		if($row != ''){return $row;}else{return'Guest-'.$ip;}
		//return $this->username;
	}
	function getFirstName() {
		return $this->firstname;
	}
	function getMiddleName() {
		return $this->middlename;
	}
	function getLastName() {
		return $this->lastname;
	}
	function getAge() {
		return $this->age;
	}
	function getGender() {
		return $this->gender;
	}
	function getEmail() {
		return $this->email;
	}
	function getLocation() {
		return $this->location;
	}
	function getTwitch() {
		return $this->twitch;
	}
	function getYouTube() {
		return $this->youtube;
	}
	function getSteam() {
		return $this->steam;
	}
	function getOrigin() {
		return $this->origin;
	}
	function getEpicGames() {
		return $this->epicgames;
	}
	function getActivision() {
		return $this->activision;
	}
	function getWebsite() {
		return $this->website;
	}
	function getLastVisit() {
		return $this->lastvisit;
	}
	function getLastIp() {
		return $this->last_ip;
	}
	function getCreatedAt() {
		return $this->created_at;
	}
	function getBio() {
		return $this->bio;
	}
	function getAvatar() {
		return $this->avatar;
	}
	function getUserLevel() { 
		return $this->user_level;
			
	} 
	function getCard() { 
	global $db;
	$member_online_num = $db->sql_numrows($db->sql_query("SELECT * FROM session WHERE username='".$this->username."'"));
	if($member_online_num){
		$online= '';	
	}else{
		$online= '2';	
	}
	$card = '
	
		
            <div class="pcard hovercard">
                <div class="cardheader">               
					<div class="pavatar'.$online.'">
						<img alt="" src="img/avatars/'.$this->avatar.'" >
					</div>
				 </div>
                <div class="pcard-body info">
                    <div class="title">
                        <h5>'.$this->username.'</h5> 
                    </div>';
	  if($this->user_level === 3){
		  $level = '<span style="color:red">Admin</span>';
	  }elseif($this->user_level === 2){
		  $level = '<span style="color:orange">Mod</span>'; 
	  }elseif($this->user_level === 1){
		  $level = '<span>User</span>'; 
	  }else{
		  $level = 'Guest';
	  }
					$card .='<div class="desc"><h6>'.$level.'</h6></div>		
                    <div class="desc">Steam: '.$this->steam.'</div>      
					<div class="desc">Origin: '.$this->origin.'</div>	
                    <div class="desc">EpicGames: '.$this->epicgames.'</div>      
					<div class="desc">Activision: '.$this->activision.'</div>									
                </div>
                <div class="pcard-footer bottom">
                    <a class="btn btn-primary btn-twc" href="'.$this->twitch.'">
                        
                    </a>
                    <a class="btn btn-danger btn-yt" rel="publisher"
                       href="'.$this->youtube.'">
                        
                    </a>
                    <a class="btn btn-primary btn-twt" rel="publisher"
                       href="'.$this->email.'">
                    </a>                    
                </div>
            </div>
        
	
		';
		return $card;
	}
	function isAdult() { // i will add a adult only warning or is coppa age maybe? someday? somehow?
		return $this->age >= 18?true:false;
	}
/////////////////////////////////////
// Authencation Stuff Yawn x.x
/////////////////////////////////////

	function isUser() { 
		global $db, $cookie;
			static $userSave;
			if (isset($userSave)) return $userSave;
			$sql = "SELECT user_level FROM users WHERE id='".$this->id."' AND password='".$this->password."'";
			$result = $db->sql_query($sql);
			list($row) = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
			if ($row && $row === '1' || $row && $row === '2' || $row && $row === '3') { 
				return $userSave = 1;
				//return  TRUE;
			}else{
				return $userSave = 0;
				//return FALSE;
				
			}
	}
	function isMod() { 
		global $db, $cookie;
			static $muserSave;
			if (isset($muserSave)) return $muserSave;
			$sql = "SELECT user_level FROM users WHERE id='".$this->id."' AND password='".$this->password."'";
			$result = $db->sql_query($sql);
			list($row) = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
			if ($row && $row === '2') { 
				return $muserSave = 1;
				//return  TRUE;
			}else{
				return $muserSave = 0;
				//return FALSE;
			}
	}
	function isAdmin() { 
		global $db, $cookie;
			static $suserSave;
			if (isset($suserSave)) return $suserSave;
			$sql = "SELECT user_level FROM users WHERE id='".$this->id."' AND password='".$this->password."'";
			$result = $db->sql_query($sql);
			list($row) = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);
			if ($row && $row === '3') { 
				return $suserSave = 1;
				//return  TRUE;
			}else{
				return $suserSave = 0;
				//return FALSE;
			}
	}

}

class pUser {
	private $username;
	private $mode;
	function __construct($username) {
		global $db;
		$result = $db->sql_query("SELECT * FROM users WHERE username='".$username."'");
		$num = $db->sql_numrows($result);
		$row = $db->sql_fetchrow($result);
		// start db side
		if($row){ // add if row to fix username guest breaking things
		$this->id = intval($row['id']);  // make sure its int :)
		$this->steam = filter($row['steam'],'nohtml', 0);
		$this->origin = filter($row['origin'],'nohtml', 0);
		$this->epicgames = filter($row['epicgames'],'nohtml', 0);
		$this->activision = filter($row['activision'],'nohtml', 0);
		$this->website = filter($row['website'],'nohtml', 0);
		$this->location = filter($row['location'],'nohtml', 0);
		$this->realname = filter($row['realname'],'nohtml', 0);
		$this->email = filter($row['email'],'nohtml', 0);
		$this->twitch = filter($row['twitch'],'nohtml', 0);
		$this->youtube = filter($row['youtube'],'nohtml', 0);
		$this->lastvisit = filter($row['lastvisit'],'nohtml', 0);
		$this->last_ip = filter($row['last_ip'],'nohtml', 0);
		$this->created_at = filter($row['created_at'],'nohtml', 0);
		$this->avatar = filter($row['avatar'],'nohtml', 0);
		$this->username = uclean_username($row['username']); // make sure its clean :)
		$this->bio = filter($row['bio'],'html', 0);
		$this->user_level = intval($row['user_level']);
		}else{
		$this->id = '';
		$this->steam = '';
		$this->origin = '';
		$this->epicgames = '';
		$this->activision = '';
		$this->website = '';
		$this->location = '';
		$this->realname = '';
		$this->email = '';
		$this->twitch = '';
		$this->youtube = '';
		$this->lastvisit = '';
		$this->last_ip = '';
		$this->created_at = '';
		$this->avatar = '';
		$this->username = 'Guest';
		$this->bio = '';
		$this->user_level = '';		
		}
	}
	function getID() {
		return $this->id;

	} 
	function getUserName() {
		return $this->username;
	}
	function getRealName() {
		return $this->realname;
	}
	function getEmail() {
		return $this->email;
	}
	function getLocation() {
		return $this->location;
	}
	function getTwitch() {
		return $this->twitch;
	}
	function getYouTube() {
		return $this->youtube;
	}
	function getSteam() {
		return $this->steam;
	}
	function getOrigin() {
		return $this->origin;
	}
	function getEpicGames() {
		return $this->epicgames;
	}
	function getActivision() {
		return $this->activision;
	}
	function getWebsite() {
		return $this->website;
	}
	function getLastVisit() {
		return $this->lastvisit;
	}
	function getLastIp() {
		return $this->last_ip;
	}
	function getCreatedAt() {
		return $this->created_at;
	}
	function getBio() {
		return $this->bio;
	}
	function getAvatar() {
		return $this->avatar;
	}
	function getUserLevel() { 
		return $this->user_level;	
	}


	function get_user_stat($mode){
		global $db;
		switch($mode){
		case 'usercount':
				$sql = "SELECT COUNT(id) AS total
					FROM users
					WHERE id > 0";
			if(!($result = $db->sql_query($sql))){
				return false;
			}
			$row = $db->sql_fetchrow($result);					
				return $row['total'];
		break;

		case 'newestuser':
				$sql = "SELECT username
					FROM users
					ORDER BY id DESC
					LIMIT 1";
			if(!($result = $db->sql_query($sql))){
				return false;
			}
			$row = $db->sql_fetchrow($result);					
				return $row['username'];
		break;

		case 'oldestuser':
				$sql = "SELECT username
					FROM users
					ORDER BY id ASC
					LIMIT 1";
			if(!($result = $db->sql_query($sql))){
				return false;
			}
			$row = $db->sql_fetchrow($result);					
				return $row['username'];
		break;
		}
		
		return false;
	}
}

function uclean_username($string) {
	$string = preg_replace('/[^A-Za-z0-9-]/', ' ', $string); // Removes special chars
	$string = filter($string , 'nohtml', 1);
return $string;
}
function uclean_password($string) {
	$string = filter_var($string, FILTER_SANITIZE_STRING);
	$string = filter($string , 'nohtml', 1);
return $string;
}
?>