<?php
error_reporting(0);
const
host = "bitefaucet.com",
b = "\033[1;34m",
c = "\033[1;36m",
d = "\033[0m",
h = "\033[1;32m",
k = "\033[1;33m",
m = "\033[1;31m",
n = "\n",
p = "\033[1;37m",
u = "\033[1;35m";

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
function Ban(){
	system('clear');
	print n.n;
	print h."Author  : ".k."iewil".n;
	print h."Script  : ".k.host.n;
	print h."Youtube : ".k."youtube.com/c/iewil".n;
	print line();
}
function h(){
	$u=Save("User_Agent");
	$c=Save("Cookie");
	return ["user-agent: ".$u,"cookie: ".$c];
}
function Get_Dashboard(){
	$url = "https://".host."/dashboard";
	$r = Curl($url,h())[1];
	$user = explode("<",explode("siteUserFullName: '",$r)[1])[0];
	$bal   = explode('</h2>',explode('<h2 class="title">',$r)[3])[0];
	return ["user"=>$user,"bal"=>$bal];
}
function Gp($code){
	$r = '{
		"tree":["A7Mdyg==","GLdY5A=="],
		"car":["FKAK","D6RP"],
		"heart":["H6QZ3TE=","BKBc8wg="],
		"truck":["A7MNzC4=","GLdI4hc="],
		"key":["HKQB","B6BE"],
		"cup":["FLQI","D7BN"],
		"house":["H64N3CA=","BKpI8hk="],
		"flag":["Ea0ZyA==","Cqlc5g=="],
		"plane":["B60ZwSA=","HKlc7xk="]
		}';
	$res = json_decode($r,1);
	return $res[$code];
}

cookie:
Save("User_Agent");Save("Cookie");
awal:
print Ban();
$r = Get_Dashboard();
echo h."Username   ~> ".k.$r["user"].n;
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
		$tmr=explode(' -',explode('var wait = ',$r)[1])[0];
		if($tmr>0){tmr($tmr);goto faucet;}
		echo k."Bypass ";
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
			$data = "csrf_token_name=".$csrf."&token=".$token."&antibotlinks=".$bot[$i]."&captcha=gpcaptcha&captcha_code=".$gp[0]."&captcha_choosen=".$gp[1];
			$r1 = Curl("https://".host."/faucet/verify",h(),$data)[1];
			$ss = explode('has',explode("Good job!', '",$r1)[1])[0];
			echo "\r                     \r";
			if($ss){
				echo h."Success    ~> ".k.$ss.n;
				echo h."Balance    ~> ".k.Get_Dashboard()["bal"].n;
				print Line();
			}else{
				echo m."antibotlink salah";
				sleep(2);
				echo "\r                 \r";
			}
		}
	}
}

function Tmr($tmr){$timr=time()+$tmr;while(true){echo "\r                       \r";$res=$timr-time(); if($res < 1){break;}echo date('i:s',$res);sleep(1);}}
