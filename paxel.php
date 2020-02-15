<?php

$headers = array(); 
$headers[] = 'accept: application/json, text/plain, */*';
$headers[] = 'x-player: 311b057f-1542-4f4c-ab73-'.random(12);
$headers[] = 'content-type: application/json';
$headers[] = 'user-agent: okhttp/3.12.1';

echo color('blue', "[+]")." Bot Paxel - By : GidhanB.A\n";
echo color('blue', "[+]")." Nomer HP: ";
$nomer = trim(fgets(STDIN));
$cek = curl('https://api.paxel.co/apg/api/v1/me/phone-token?on=register', '{"phone":"'.$nomer.'","referral_code":""}', $headers);

echo color('blue', "[+]")." OTP: ";
$otp = trim(fgets(STDIN));
$ver = curl('https://api.paxel.co/apg/api/v1/me/phone-token/validate', '{"phone":"'.$nomer.'","token":"'.$otp.'"}', $headers);

echo color('blue', "[+]")." Reff: ";
$reff = trim(fgets(STDIN));

Data:
$dat = nama();
$nama = explode(" ", $dat);
$nick = strtolower(trim($nama[0])).mt_rand(10,99);
$usr = curl('https://api.paxel.co/apg/api/v1/check-username', '{"username":"'.$nick.'"}', $headers);
if (!strpos($usr[1], '"is_same":false')) goto Data;

$regis = curl('https://api.paxel.co/apg/api/v1/register', '{"social_media_id":"","social_media_type":"","first_name":"'.trim($nama[0]).'","last_name":"'.trim($nama[1]).'","refer_by":"'.$reff.'","phone":"'.$nomer.'","token":"'.$otp.'","username":"'.$nick.'","password":"anjay123","email":"","referrer_source":"google-play","campaign":""}', $headers);
echo "\n";
echo color('green', "[+]")." ".$regis[1]."\n";

function curl($url,$post,$headers)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		if ($headers !== null) curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		if ($post !== null) curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$result = curl_exec($ch);
		$header = substr($result, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		$body = substr($result, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
		$cookies = array();
		foreach($matches[1] as $item) {
		  parse_str($item, $cookie);
		  $cookies = array_merge($cookies, $cookie);
		}
		return array (
		$header,
		$body,
		$cookies
		);
	}

function nama()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$ex = curl_exec($ch);
		preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
		return $name[2][mt_rand(0, 14) ];
	}

function color($color = "default" , $text)
    {
        $arrayColor = array(
            'grey'      => '1;30',
            'red'       => '1;31',
            'green'     => '1;32',
            'blue'      => '1;34',
        );  
        return "\033[".$arrayColor[$color]."m".$text."\033[0m";
    }

function random($length) 
	{
		$str = "";
		$characters = array_merge(range('0','9'),range('a','z'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}
