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
		$id = intval($row['id']);// make sure its int :)
		$this->id = $id;  
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
		$this->twitter = filter($row['twitter'],'nohtml', 0);
		$this->facebook = filter($row['facebook'],'nohtml', 0);
		$this->reddit = filter($row['reddit'],'nohtml', 0);
		$this->instagram = filter($row['instagram'],'nohtml', 0);
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
		$this->twitter = '';
		$this->facebook = '';
		$this->reddit = '';
		$this->instagram = '';
		$this->lastvisit = date('l jS \of F Y h:i:s A');
		$this->last_ip = $ip;
		$this->created_at = '';
		$this->avatar = '';
		$this->username = 'Guest- '.$ip;
		$this->bio = '';
		$this->user_level = 0;
		$this->password = null;
		}
	}
// start calling 
	function getID() {
		//return $this->id;
		static $idSave;
		if (isset($idSave)) return $idSave;
		return $idSave = $this->id;		
	} 
	function getUserName() {
		//return $this->username;
		static $usernameSave;
		if (isset($usernameSave)) return $usernameSave;
		return $usernameSave = $this->username;	
	}
	function getFirstName() {
		//return $this->firstname;
		static $firstnameSave;
		if (isset($firstnameSave)) return $firstnameSave;
		return $firstnameSave = $this->firstname;
	}
	function getMiddleName() {
		//return $this->middlename;
		static $middlenameSave;
		if (isset($middlenameSave)) return $middlenameSave;
		return $middlenameSave = $this->middlename;
	}
	public function getLastName() {
		//return $this->lastname;
		static $lastnameSave;
		if (isset($lastnameSave)) return $lastnameSave;
		return $lastnameSave = $this->lastname;
	}
	public function getAge() {
		//return $this->age;
		static $ageSave;
		if (isset($ageSave)) return $ageSave;
		return $ageSave = $this->age;
	}
	public function getGender() {
		//return $this->gender;
		static $genderSave;
		if (isset($genderSave)) return $genderSave;
		return $genderSave = $this->gender;
	}
	public function getEmail() {
		//return $this->email;
		//return $this->gender;
		static $emailSave;
		if (isset($emailSave)) return $emailSave;
		return $emailSave = $this->email;
	}
	public function getLocation() {
		//return $this->location;
		static $locationSave;
		if (isset($locationSave)) return $locationSave;
		return $locationSave = $this->location;
	}
	public function getTwitch() {
		//return $this->twitch;
		static $twitchSave;
		if (isset($twitchSave)) return $twitchSave;
		return $twitchSave = $this->twitch;
	}
	public function getTwitter() {
		//return $this->twitter;
		static $twitterSave;
		if (isset($twitterSave)) return $twitterSave;
		return $twitterSave = $this->twitter;
	}
	public function getFacebook() {
		//return $this->facebook;
		static $facebookSave;
		if (isset($facebookSave)) return $facebookSave;
		return $facebookSave = $this->facebook;
	}
	public function getInstagram() {
		//return $this->instagram;
		static $instagramSave;
		if (isset($instagramSave)) return $instagramSave;
		return $instagramSave = $this->instagram;
	}
	public function getReddit() {
		//return $this->reddit;
		static $redditSave;
		if (isset($redditSave)) return $redditSave;
		return $redditSave = $this->reddit;
	}
	public function getYouTube() {
		//return $this->youtube;
		static $youtubeSave;
		if (isset($youtubeSave)) return $youtubeSave;
		return $youtubeSave = $this->youtube;
	}
	public function getSteam() {
		//return $this->steam;
		static $steamSave;
		if (isset($steamSave)) return $steamSave;
		return $steamSave = $this->steam;
	}
	public function getOrigin() {
		//return $this->origin;
		static $originSave;
		if (isset($originSave)) return $originSave;
		return $originSave = $this->origin;
	}
	public function getEpicGames() {
		//return $this->epicgames;
		static $epicgamesSave;
		if (isset($epicgamesSave)) return $epicgamesSave;
		return $epicgamesSave = $this->epicgames;
	}
	public function getActivision() {
		//return $this->activision;
		static $activisionSave;
		if (isset($activisionSave)) return $activisionSave;
		return $activisionSave = $this->activision;
	}
	public function getWebsite() {
		//return $this->website;
		static $websiteSave;
		if (isset($websiteSave)) return $websiteSave;
		return $websiteSave = $this->website;
	}
	public function getLastVisit() {
		//return $this->lastvisit;
		static $lastvisitSave;
		if (isset($lastvisitSave)) return $lastvisitSave;
		return $lastvisitSave = $this->lastvisit;
	}
	public function getLastIp() {
		//return $this->last_ip;
		static $last_ipSave;
		if (isset($last_ipSave)) return $last_ipSave;
		return $last_ipSave = $this->last_ip;
	}
	public function getCreatedAt() {
		//return $this->created_at;
		static $created_atSave;
		if (isset($created_atSave)) return $created_atSave;
		return $created_atSave = $this->created_at;
	}
	public function getBio() {
		//return $this->bio;
		static $bioSave;
		if (isset($bioSave)) return $bioSave;
		return $bioSave = $this->bio;
	}
	public function getAvatar() {
		//return $this->avatar;
		static $avatarSave;
		if (isset($avatarSave)) return $avatarSave;
		return $avatarSave = $this->avatar;
	}
	public function getUserLevel() { 
		//return $this->user_level;
		static $user_levelSave;
		if (isset($user_levelSave)) return $user_levelSave;
		return $user_levelSave = $this->user_level;	
	}
	public function DisplayUserLevel() {
		if($this->user_level === 3){
		$level = '<span style="color:red">Admin</span>';
		}elseif($this->user_level === 2){
		$level = '<span style="color:orange">Staff</span>'; 
		}elseif($this->user_level === 1){
		$level = '<span>User</span>'; 
		}else{
		$level = 'Guest';
		}
		return $level;	
	}
	public function getCard() { 
	global $db;
	static $member_online_num;
	if (isset($member_online_num)){
		$member_online_num = intval($member_online_num);
		$online= '';
	}else{
		if($db->sql_numrows($db->sql_query("SELECT * FROM session WHERE username='".$this->username."'"))){
			$online= '';
			$member_online_num = 1;	
		}else{
			$online= '2';
			$member_online_num = 0;	
		}
	}
	//$member_online_num = $db->sql_numrows($db->sql_query("SELECT * FROM session WHERE username='".$this->username."'"));
	//if(isset($member_online_num)){
	//	$online= '';	
	//}else{
	//	$online= '2';	
	//}
	$card = '';
         $card.='<div class="pcard hovercard">';
         $card.='<div class="cardheader">  ';             
		 $card.='<div class="pavatar'.$online.'">';
		 $card.='<img alt="" src="img/avatars/'.$this->avatar.'" >';
		 $card.='</div>';
		 $card.='</div>';
         $card.='<div class="pcard-body info">';
         $card.='<div class="title">';
         $card.='<h5>'.$this->username.'</h5> ';
         $card.='</div>';
				  if($this->user_level === 3){
					  $level = '<span style="color:red">Admin</span>';
				  }elseif($this->user_level === 2){
					  $level = '<span style="color:orange">Staff</span>'; 
				  }elseif($this->user_level === 1){
					  $level = '<span>User</span>'; 
				  }else{
					  $level = 'Guest';
				  }
		$card .='<div class="desc"><h6>'.$level.'</h6></div>';		
        $card.='<div class="desc">Steam: '.$this->steam.'</div>';
		$card.='<div class="desc">Origin: '.$this->origin.'</div>';
        $card.='<div class="desc">EpicGames: '.$this->epicgames.'</div>';
		$card.='<div class="desc">Activision: '.$this->activision.'</div>';
        $card.='</div>';
        $card.='<div class="pcard-footer bottom">';
        $card.='<a class="a-yt" href="https://youtube.com/channel/'.$this->youtube.'" rel="noopener noreferrer nofollow" target="_blank"></a>';
		$card.='<a class="a-twc" href="https://twitch.tv/'.$this->twitch.'" rel="noopener noreferrer nofollow" target="_blank"></a>';
        $card.='<a class="a-fb" href="https://facebook.com/'.$this->facebook.'" rel="noopener noreferrer nofollow" target="_blank"></a>';
        $card.='<a class="a-twt" href="https://twitter.com/'.$this->twitter.'" rel="noopener noreferrer nofollow" target="_blank"></a>'; 
		$card.='<a class="a-rdt" href="https://reddit.com/user/'.$this->reddit.'" rel="noopener noreferrer nofollow" target="_blank"></a>';                  
        $card.='</div>';
        $card.='</div>';
	
		$data = array();
		$data['card'] = $card;
		$data['username'] = $this->username;
		$data['online'] = $online;
		$data['avatar'] = $this->avatar;
		$data['level'] = $level;
		$data['steam'] = $this->steam;
		$data['origin'] = $this->origin;
		$data['epicgames'] = $this->epicgames;
		$data['activision'] = $this->activision;
		$data['youtube'] = $this->youtube;
		$data['twitch'] = $this->twitch;
		$data['facebook'] = $this->facebook;
		$data['twitter'] = $this->twitter;
		$data['reddit'] = $this->reddit;
		$data['youtube'] = $this->youtube;
		$obh = new TemplateParser();
		$obh->initData($data);
		//Parse Template Data
		$parsedData = $obh->parseTemplateData(file_get_contents("templates/jambo/card.html"));
		//echo $parsedData;
		return $parsedData;
		unset($data);
		unset($card);
		unset($parsedData);
	}
	function isAdult() { // i will add a adult only warning or is coppa age maybe? someday? somehow?
		//return $this->age >= 18?true:false;
		static $isadultSave;
		if (isset($isadultSave)) return $isadultSave;
		return $isadultSave = $this->age >= 18?true:false;
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
		global $db, $ip;
		$result = $db->sql_query("SELECT * FROM users WHERE username='".$username."'");
		$num = $db->sql_numrows($result);
		$row = $db->sql_fetchrow($result);
		// start db side
		if($num){
		$id = intval($row['id']);
		$this->id = $id;  // make sure its int :)
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
		$this->twitter = filter($row['twitter'],'nohtml', 0);
		$this->facebook = filter($row['facebook'],'nohtml', 0);
		$this->reddit = filter($row['reddit'],'nohtml', 0);
		$this->instagram = filter($row['instagram'],'nohtml', 0);
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
		$this->twitter = '';
		$this->facebook = '';
		$this->reddit = '';
		$this->instagram = '';
		$this->lastvisit = date('l jS \of F Y h:i:s A');
		$this->last_ip = $ip;
		$this->created_at = '';
		$this->avatar = '';
		$this->username = 'Guest- '.$ip;
		$this->bio = '';
		$this->user_level = 0;
		}
	}
	function getID() {
		return $this->id;

	} 
	function getUserName() {
		return $this->username;

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
	function getTwitter() {
		return $this->twitter;
	}
	function getFacebook() {
		return $this->facebook;
	}
	function getInstagram() {
		return $this->instagram;
	}
	function getReddit() {
		return $this->reddit;
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
	function DisplayUserLevel() {
		if($this->user_level === 3){
		$level = '<span style="color:red">Admin</span>';
		}elseif($this->user_level === 2){
		$level = '<span style="color:orange">Staff</span>'; 
		}elseif($this->user_level === 1){
		$level = '<span>User</span>'; 
		}else{
		$level = 'Guest';
		}
		return $level;	
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
	
	
function getCard() { 
	global $db;
	static $member_online_num;
	if (isset($member_online_num)){
		$member_online_num = intval($member_online_num);
		$online= '';
	}else{
		if($db->sql_numrows($db->sql_query("SELECT * FROM session WHERE username='".$this->username."'"))){
			$online= '';
			$member_online_num = 1;	
		}else{
			$online= '2';
			$member_online_num = 0;	
		}
	}
	//$member_online_num = $db->sql_numrows($db->sql_query("SELECT * FROM session WHERE username='".$this->username."'"));
	//if(isset($member_online_num)){
	//	$online= '';	
	//}else{
	//	$online= '2';	
	//}
	$card = '';
         $card.='<div class="pcard hovercard">';
         $card.='<div class="cardheader">  ';             
		 $card.='<div class="pavatar'.$online.'">';
		 $card.='<img alt="" src="img/avatars/'.$this->avatar.'" >';
		 $card.='</div>';
		 $card.='</div>';
         $card.='<div class="pcard-body info">';
         $card.='<div class="title">';
         $card.='<h5>'.$this->username.'</h5> ';
         $card.='</div>';
				  if($this->user_level === 3){
					  $level = '<span style="color:red">Admin</span>';
				  }elseif($this->user_level === 2){
					  $level = '<span style="color:orange">Staff</span>'; 
				  }elseif($this->user_level === 1){
					  $level = '<span>User</span>'; 
				  }else{
					  $level = 'Guest';
				  }
		$card .='<div class="desc"><h6>'.$level.'</h6></div>';		
        $card.='<div class="desc">Steam: '.$this->steam.'</div>';
		$card.='<div class="desc">Origin: '.$this->origin.'</div>';
        $card.='<div class="desc">EpicGames: '.$this->epicgames.'</div>';
		$card.='<div class="desc">Activision: '.$this->activision.'</div>';
        $card.='</div>';
        $card.='<div class="pcard-footer bottom">';
        $card.='<a class="a-yt" href="https://youtube.com/channel/'.$this->youtube.'" rel="noopener noreferrer nofollow" target="_blank"></a>';
		$card.='<a class="a-twc" href="https://twitch.tv/'.$this->twitch.'" rel="noopener noreferrer nofollow" target="_blank"></a>';
        $card.='<a class="a-fb" href="https://facebook.com/'.$this->facebook.'" rel="noopener noreferrer nofollow" target="_blank"></a>';
        $card.='<a class="a-twt" href="https://twitter.com/'.$this->twitter.'" rel="noopener noreferrer nofollow" target="_blank"></a>'; 
		$card.='<a class="a-rdt" href="https://reddit.com/user/'.$this->reddit.'" rel="noopener noreferrer nofollow" target="_blank"></a>';                  
        $card.='</div>';
        $card.='</div>';
	
		$data = array();
		$data['card'] = $card;
		$data['username'] = $this->username;
		$data['online'] = $online;
		$data['avatar'] = $this->avatar;
		$data['level'] = $level;
		$data['steam'] = $this->steam;
		$data['origin'] = $this->origin;
		$data['epicgames'] = $this->epicgames;
		$data['activision'] = $this->activision;
		$data['youtube'] = $this->youtube;
		$data['twitch'] = $this->twitch;
		$data['facebook'] = $this->facebook;
		$data['twitter'] = $this->twitter;
		$data['reddit'] = $this->reddit;
		$data['youtube'] = $this->youtube;
		$obh = new TemplateParser();
		$obh->initData($data);
		//Parse Template Data
		$parsedData = $obh->parseTemplateData(file_get_contents("templates/jambo/card.html"));
		//echo $parsedData;
		return $parsedData;
		unset($data);
		unset($card);
		unset($parsedData);
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