<?php
error_reporting(0);
const 
title = "bithub",
versi = "1.0",
host = "bithub.win",
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

function Curl($u, $h = 0, $p = 0, $m = 0,$c = 0,$x = 0) {//url,header,post,proxy
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $u);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_COOKIE,TRUE);
	if($p) {
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
	}
	if($h) {
		curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	}
	if($m) {
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $m);
	}
	if($x) {
		curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
		curl_setopt($ch, CURLOPT_PROXY, $x);
	}
	curl_setopt($ch, CURLOPT_HEADER, true);
	$r = curl_exec($ch);
	$c = curl_getinfo($ch);
	if(!$c) return "Curl Error : ".curl_error($ch); else{
		$hd = substr($r, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		$bd = substr($r, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		curl_close($ch);
		return array($hd,$bd);
	}
}
function z($x,$y,$z){
	return ["+".$y."+".$z."+".$x,"+".$x."+".$y."+".$z,"+".$x."+".$z."+".$y,"+".$y."+".$x."+".$z,"+".$z."+".$y."+".$x,"+".$z."+".$x."+".$y];
}
function Save($n){if(file_exists($n)){$d = file_get_contents($n);}else{$d = readline(m."Input ".$n.k." > ".h.n);echo n;file_put_contents($n,$d);}return $d;}
function Line(){$l = 50;return b.str_repeat('─',$l).n;}
function bn(){
	system('clear');
	print n.n.h." Author   : ".k."iewil".n.h." Script   : ".k.title." ".p.versi.n.h." Youtube  : ".k."youtube.com/c/iewil".n.line();
}

function h(){
	$u=Save("User_Agent");
	$c=Save("Cookie");
	return ["user-agent: ".$u,"cookie: ".$c];
}
function Get_Dashboard(){
	$url = "https://".host."/dashboard";
	$r = Curl($url,h())[1];
	$user = explode("',",explode("siteUserFullName: '",$r)[1])[0];
	$bal   = explode('</h2>',explode('<h2 class="title">',$r)[1])[0];
	return ["user"=>$user,"bal"=>$bal];
}
function Gp($code){
	$r = '{
		"car":["hMoL","dt1U"],
		"cup":["hN4J","dslW"],
		"heart":["j84YLvs=","fdlHC0s="],
		"house":["j8QML+o=","fdNTClo="],
		"key":["jM4A","ftlf"],
		"plane":["l8cYMuo=","ZdBHF1o="],
		"star":["lN8YLg==","ZshHCw=="],
		"tree":["k9kcOQ==","Yc5DHA=="],
		"truck":["k9kMP+Q=","Yc5TGlQ="]}
	';
	$res = json_decode($r,1);
	return $res[$code];
}
print bn();
server();short();
print bn();
cookie:
Save("User_Agent");Save("Cookie");
awal:
print bn();
$r = Get_Dashboard();
echo h."Balance    ~> ".k.$r["bal"].n;
print Line();
faucet:
while(true){
	for($i=0;$i<6;$i++){
		$r = Curl("https://".host."/faucet",h())[1];
		if(preg_match('/Just a moment.../',$r)){
			print m."koprel lagi bosku\n";
			unlink('Cookie');
			Save("Cookie");
			goto awal;
		}
		$tmr=explode(' -',explode('let wait = ',$r)[1])[0];
		if($tmr>0){tmr($tmr);goto faucet;}
		$csrf = explode('"',explode('id="token" value="',$r)[1])[0];
		$token = explode('"',explode('name="token" value="',$r)[1])[0];
		$code = explode('</span>',explode('<span class="text-color text-capitalize">',$r)[1])[0];
		$gp = Gp($code);
		if($gp[1]){
			$b = explode('\"#\" rel=\"',$r);
			$b1 = explode('\"',$b[1])[0];
			$b2 = explode('\"',$b[2])[0];
			$b3 = explode('\"',$b[3])[0];
			$bot = z($b1,$b2,$b3);
			
			echo $bot[$i];
			$data = "antibotlinks=".$bot[$i]."&ci_csrf_token=".$csrf."&token=".$token."&captcha=gpcaptcha&captcha_code=".$gp[0]."&captcha_choosen=".$gp[1];
			$r1 = Curl("https://".host."/faucet/verify",h(),$data)[1];
			$ss = explode(' has',explode("text: '",$r1)[1])[0];
			echo "\r                        \r";
			if($ss){
				echo h."Success    ~> ".k.$ss.n;
				echo h."Balance    ~> ".k.Get_Dashboard()["bal"].n;
				print Line();
			}else{
				echo m."antibotlink salah";
				sleep(2);
				echo "\r                    \r";
			}
		}
	}
}

function Tmr($tmr){$timr=time()+$tmr;while(true){echo "\r                       \r";$res=$timr-time(); if($res < 1){break;}echo date('i:s',$res);sleep(1);}}
