<?php
/**************************************************************************************
*	Author : Varun Parikh															  *
*	Company : ByteWeb IT Solutions Private Limited									  *
*	Website : http://www.byteweb.in													  *
*	Version : 1.0.0																	  *
***************************************************************************************/
	
	function bw_autologin($user,$pass,$port,$hostname) {
		$ch = curl_init();
        $fields = array('user' => $user, 'pass' => $pass);
        curl_setopt($ch, CURLOPT_URL, 'https://' . $hostname . ':' . $port . '/login/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection' => 'close'));
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       
        $page = curl_exec($ch);
        curl_close($ch);
        $session = $token = array();
		 if(!preg_match('/session=([^\;]+)/', $page, $session)) {
           
            return false;
        }
       
        if(!preg_match('|<META HTTP-EQUIV="refresh"[^>]+URL=/(cpsess\d+)/|i', $page, $token)) {
            return false;
        }
		
		$goto = 'https://' . $hostname . ':' . $port . '/' . $token[1] . '/login/?session=' . $session[1] . $extra;
		
		header('location:$goto');
		
	}
	
	$user = ='';
	$pass = ='';
	$port = ='';
	$hostname ='';
	
	bw_autologin($user,$pass,$port,$hostname);
	
		
		
?>