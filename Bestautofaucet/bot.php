<?php
error_reporting(0);
const 
title = "bestautofaucet",
versi = "1.5",
host = "bestautofaucet.com",
yt = "https://youtube.com/c/iewil",
b = "\033[1;34m",
c = "\033[1;36m",
d = "\033[0m",
h = "\033[1;32m",
k = "\033[1;33m",
m = "\033[1;31m",
n = "\n",
p = "\033[1;37m",
u = "\033[1;35m";

function short(){if(!file_exists('Data/Password')){pass:bn();$s    = json_decode(file_get_contents('https://raw.githubusercontent.com/iewilmaestro/GudangDuit/main/Data.json'),1);$ran = rand(0,count($s)-1);$url  = $s[$ran]["url"];$sh  = $s[$ran]["short"];$ul   = file_get_contents($url);$p    = explode(" -",explode('content="Password: ',$ul)[1])[0];print h." Link     : ".k.$sh."\n";$pas = readline(h." Password : ".k);if($pas == $p){print h." --- Ok ".n;sleep(5);file_put_contents('Data/Link',$url);file_put_contents('Data/Password',$pas);print " Success save password";}else{print m." --- Error!";sleep(5);goto pass;}}else{$a   = file_get_contents('Data/Link');$ul   = file_get_contents($a);$p    = explode(" -",explode('content="Password: ',$ul)[1])[0];if(file_get_contents('Data/Password') == $p){}else{system('rm -r Data');}}}
function server(){$base    = file_get_contents("https://raw.githubusercontent.com/iewilmaestro/GudangDuit/main/Data.txt");$data     = explode('#',explode('#'.title.':',$base)[1])[0];$status  = explode('|',$data)[0];$versi    = explode('|',$data)[1];$link      = explode('|',$data)[2];if($status == "off" || $status == null){bn();echo m."Bot Sudah tidak aktif\n";echo k."------------ ".c."@iewil57 \n";exit;}if(!file_exists('Data/Versi')){system('mkdir Data');file_put_contents('Data/Versi',$versi);}if(versi == $versi){}else{bn();print m." Script update!".n;print h." Download : ".c.$link.n;die();}}
function bn(){system('clear');print n.n.h." Author   : ".k."iewil".n.h." Script   : ".k.title." ".p.versi.n.h." Youtube  : ".k."youtube.com/c/iewil".n.line();}

function Run($u, $h = 0, $p = 0){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $u);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	//curl_setopt($ch, CURLOPT_COOKIE,TRUE);
	if($p){
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
	}
	if($h){
		curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	}
	curl_setopt($ch, CURLOPT_HEADER, true);
	$r = curl_exec($ch);
	$c = curl_getinfo($ch);
	if(!$c) return "Curl Error : ".curl_error($ch); else{
		$hd = substr($r, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		$bd = substr($r, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		curl_close($ch);
		return array($hd,$bd)[1];
	}
}
function Save($n){
	if(file_exists($n)){
		$d = file_get_contents($n);
	}else{
		$d = readline(m."Input ".$n.k." > ".h.n);
		echo n;
		file_put_contents($n,$d);
	}
	return $d;
}
function Line(){
	$l = 50;
	return b.str_repeat('─',$l).n;
}
function Tmr($tmr){$timr=time()+$tmr;while(true){echo "\r                       \r";$res=$timr-time(); if($res < 1){break;}echo date('i:s',$res);sleep(1);}}
function head(){
	$user=Save("User_Agent");
	$cookie=Save("Cookie");
	$ua=["Host: ".host,
		"accept: */*",
		"user-agent: ".$user,
		"cookie: ".$cookie];
	return $ua;
}

bn();
server();short();
bn();

cookie:
save('Cookie');save('User_agent');
system("termux-open-url ".yt);

bn();

while(true){
	$r = Run("https://".host."/session/autofaucet",head());
	if(preg_match('/Cloudflare/',$r)){
		echo m."cloudflare detect, update cookie\n";
		print line();unlink('Cookie');goto cookie;
	}
	$user = explode('"',explode('t.name="user",t.value="',$r)[1])[0];
    $data = "user=".$user;
	$r2 = Run("https://".host."/session/autofaucet",array_merge(head(),["content-length"=>"0","content-type"=>"application/x-www-form-urlencoded"]),$data);
	
	$err=trim(explode('</div>',explode('<div class="AutoACell AAC-error">',$r2)[1])[0]);
	$token=explode('</div>',explode('<i class="fas fa-coins"></i>',$r)[1])[0];
	preg_match_all('#<div class="AutoACell AAC-success">(.*?)</a>#is',$r2,$has);
	
	if($has[1]){
		echo "\r            \r";
		if($token){
			echo k.strstr($token, '.', true)."\n";
		}
		for($i=0;$i<count($has[1]);$i++){
			echo h.trim(strip_tags($has[1][$i]))."\n";
		}
		print line();
		tmr(60);
	}else{
		echo "\r            \r";
		echo m.'please wait';
		sleep(10);
	}
	if($err == 'Insufficient balance to claim rewards.'){
		echo m.$err."\n";
		print line();
		exit;
	}
}

