<?php
error_reporting(0);
const 
title = "trxsatoshi",
versi = "1.0",
host = "trxsatoshi.xyz",
b = "\033[1;34m",
c = "\033[1;36m",
d = "\033[0m",
h = "\033[1;32m",
k = "\033[1;33m",
m = "\033[1;31m",
n = "\n",
p = "\033[1;37m",
u = "\033[1;35m";
$base    = file_get_contents("https://raw.githubusercontent.com/iewilmaestro/GudangDuit/main/Data.txt");
function short(){if(!file_exists('Data/Password')){pass:bn();$s    = json_decode(file_get_contents('https://raw.githubusercontent.com/iewilmaestro/GudangDuit/main/Data.json'),1);$ran = rand(0,count($s)-1);$url  = $s[$ran]["url"];$sh  = $s[$ran]["short"];$ul   = file_get_contents($url);$p    = explode(" -",explode('content="Password: ',$ul)[1])[0];print h." Link     : ".k.$sh."\n";$pas = readline(h." Password : ".k);if($pas == $p){print h." --- Ok ".n;sleep(5);file_put_contents('Data/Link',$url);file_put_contents('Data/Password',$pas);print " Success save password";}else{print m." --- Error!";sleep(5);goto pass;}}else{$a   = file_get_contents('Data/Link');$ul   = file_get_contents($a);$p    = explode(" -",explode('content="Password: ',$ul)[1])[0];if(file_get_contents('Data/Password') == $p){}else{system('rm -r Data');}}}
function server(){$base    = file_get_contents("https://raw.githubusercontent.com/iewilmaestro/GudangDuit/main/Data.txt");$data     = explode('#',explode('#'.title.':',$base)[1])[0];$status  = explode('|',$data)[0];$versi    = explode('|',$data)[1];$link      = explode('|',$data)[2];if($status == "off" || $status == null){bn();echo m."Bot Sudah tidak aktif\n";echo k."------------ ".c."@iewil57 \n";exit;}if(!file_exists('Data/Versi')){system('mkdir Data');file_put_contents('Data/Versi',$versi);}if(versi == $versi){}else{bn();print m." Script update!".n;print h." Download : ".c.$link.n;die();}}
function bn(){system('clear');print n.n.h." Author   : ".k."iewil".n.h." Script   : ".k.title." ".p.versi.n.h." Youtube  : ".k."youtube.com/c/iewil".n;}

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
function answer($x,$y,$z){
	if($x + $y == $z){
		return "add";
	}elseif($x - $y == $z){
		return "sub";
	}elseif($x * $y == $z){
		return "multiply";
	}else{
		return 0;
	}
}
function S($namadata){
	if(file_exists($namadata)){
		$data = file_get_contents($namadata);
	}else{
		$data = readline("Input ".$namadata." > ");
		file_put_contents($namadata,$data);
	}
	return $data;
}
function z($x,$y,$z){
	return ["+".$y."+".$z."+".$x,"+".$x."+".$y."+".$z,"+".$x."+".$z."+".$y,"+".$y."+".$x."+".$z,"+".$z."+".$y."+".$x,"+".$z."+".$x."+".$y];
}
function Tmr($tmr){$timr=time()+$tmr;while(true){echo "\r                       \r";$res=$timr-time(); if($res < 1){break;}echo date('i:s',$res);sleep(1);}}

//server();short();
bn();
s('Cookie');s('User_agent');

$line = u.str_repeat('~',50)."\n";

titel:
$h[] = "user-agent: ".s('User_agent');
$h[] = "cookie: ".s('Cookie');

bn();
print $line;

$r = Run(host.'/dashboard',$h);
$user	= explode('"',explode('id="wallet" value="',$r)[1])[0];
$balance = explode('</h4>',explode('<h4><i class="fas fa-coins"></i> ',$r)[1])[0];//0200,000.00
print h."Wallet   : ".k.$user."\n";
print h."Balance  : ".k.$balance."\n";
print $line;

pul:
while(true){
	for($i=0;$i<6;$i++){
		mangkat:
		$r = Run(host.'/faucet',$h);
		if(preg_match('/Cloudflare/',$r) || preg_match('/Firewall/',$r)){
			print m."kena kopler, update cookie maseh\n";
			unlink('Cookie');
			s('Cookie');
			goto titel;
		}
		$token	= explode('"',explode('name="token" value="',$r)[1])[0];
		$csrf	= explode('"',explode('id="token" value="',$r)[1])[0];
		$hidden	= explode('"',explode('<input type="hidden" value="',$r)[1])[0];
		$ques	= explode('</h2>',explode('<h2>Question: ',$r)[1])[0];//52 ___ 8 = 416
		
		$q	= explode(' ',$ques);
		$x	= $q[0];
		$y	= $q[2];
		$z	= $q[4];
		$answer	= answer($x,$y,$z);
		if($answer <= null ){
			goto mangkat;
		}
		$b	= explode('rel=\"',$r);
		$b1	= explode('\">',$b[1])[0];
		$b2	= explode('\">',$b[2])[0];
		$b3	= explode('\">',$b[3])[0];
		$bot	= z($b1,$b2,$b3);
					
		echo $bot[$i];
		$data	= "antibotlinks=".$bot[$i]."&csrf_token_name=".$csrf."&token=".$token."&answer=".$answer."&hidden=".$hidden;
		$r	= Run('https://'.host.'/faucet/verify',$h,$data);
		
		$ss	= explode('has',explode("text: '",$r)[1])[0];
		$wr	= explode('</div>',explode('<i class="fas fa-exclamation-circle"></i> ',$r)[1])[0];
		print "\r                                 \r";
		if($ss){
			//$r = Run(host.'/dashboard',$h);
			//$bal = explode('</h4>',explode('<h4><i class="fas fa-coins"></i> ',$r)[1])[0];//0200,000.00
		
			print h."Success ~> ".k.$ss.n;
			//print c."New Balance  : ".k.$bal."\n";
			print $line;
			tmr(30);
			goto pul;
		}else{
			print m.$wr;
			sleep(2);
			print "\r                                 \r";
		}
	}
}
