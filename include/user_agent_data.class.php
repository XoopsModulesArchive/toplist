<?php
class user_agent_data {
	
	var $ip;		
	var $user_agent;
	var $referer;	

	function get_os($user_agent = '') {
		if ($user_agent == '') { return 'undefined'; }

		if (strpos($user_agent, 'Windows 95') || strpos($user_agent, 'Win95')) { return 'Win95'; }
		if (strpos($user_agent, 'Win 9x 4.90')) { return 'WinME'; }
		if (strpos($user_agent, 'Windows 98') || strpos($user_agent, 'Win98')) { return 'Win98'; }
		if (strpos($user_agent, 'Windows 2000') || strpos($user_agent, 'Win2000')) { return 'Win2000'; }
		if (strpos($user_agent, 'Windows NT 5\.0') || strpos($user_agent, 'WinNT 5\.0')) { return 'Win2000'; }
		if (strpos($user_agent, 'Windows NT 5\.1') || strpos($user_agent, 'WinNT 5\.1')) { return 'WinXP'; }
		if (strpos($user_agent, 'Windows NT') || strpos($user_agent, 'WinNT')) { return 'WinNT'; }
		if (strpos($user_agent, 'Windows XP') || strpos($user_agent, 'WinXP')) { return 'WinXP'; }
		if (strpos($user_agent, 'Borg') || strpos($user_agent, 'Win32')) { return 'Win32'; }
		if (strpos($user_agent, 'Windows CE') || strpos($user_agent, 'WinCE')) { return 'WinCE'; }
		if (strpos($user_agent, 'Mac')) { return 'Mac'; }
		if (strpos($user_agent, 'OmniWeb') || strpos($user_agent, 'iCab') || strpos($user_agent, 'Safari')) { return 'Mac'; }
		if (strpos($user_agent, 'Lindows')) { return 'Lindows'; }
		if (strpos($user_agent, 'Linux') || strpos($user_agent, 'Kondara') || strpos($user_agent, 'Vine') || strpos($user_agent, 'Debian')) { return 'Linux'; }
		if (strpos($user_agent, 'Fedora') || strpos($user_agent, 'Laser5')) { return 'Linux'; }
		if (strpos($user_agent, 'BSD')) { return 'UNIX (BSD)'; }
		if (strpos($user_agent, 'X11') || strpos($user_agent, 'SunOS') || strpos($user_agent, 'HP-UX')) { return 'UNIX'; }
		if (strpos($user_agent, 'AIX') || strpos($user_agent, 'IRIX') || strpos($user_agent, 'OSF1')) { return 'UNIX'; }
		if (strpos($user_agent, 'BTRON')) { return 'BTRON'; }
		if (strpos($user_agent, 'DreamPassport')) { return 'Dreamcast'; }
		if (strpos($user_agent, 'DoCoMo')) { return 'Docomo'; }
		if (strpos($user_agent, 'UP.Browser')) { return 'AU (KDDI)'; }
		if (strpos($user_agent, 'Vodafone') || strpos($user_agent, 'J-PHONE')) { return 'Vodafone'; }
		if (strpos($user_agent, 'DDIPOCKET') || strpos($user_agent, 'AH-K3001V')) { return 'WILLCOM'; }
		if (strpos($user_agent, 'PalmOS')) { return 'PalmOS '; }
		if (strpos($user_agent, 'PlayStation ')) { return 'PlayStation '; }

		return 'undefined';
	}
	
	function get_browser($user_agent = '') {
		if ($user_agent == '') { return 'undefined'; }

		if (preg_match('/Google.*Proxy/', $user_agent,$matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/aaacafe/', $user_agent)) { return 'Robot (AAA!CAFE)'; }
		if (preg_match('/accoona/', $user_agent)) { return 'Robot (Accoona)'; }
		if (preg_match('/aggregator:MyRSS.jp/', $user_agent)) { return 'Robot (MyRSS.jp)'; }
		if (preg_match('/ArchitextSpider/', $user_agent)) { return 'Robot (Excite)'; }
		if (preg_match('/Ask Jeeves/', $user_agent)) { return 'Robot (Ask Jeeves)'; }
		if (preg_match('/Baiduspider/', $user_agent)) { return 'Robot (Baidu)'; }
		if (preg_match('/Cerberian/', $user_agent)) { return 'Robot (Cerberian)'; }
		if (preg_match('/Comaneci_bot/', $user_agent)) { return 'Robot (i-know.jp)'; }
		if (preg_match('/Cowbot/', $user_agent)) { return 'Robot (Naver)'; }
		if (preg_match('/Convera/', $user_agent)) { return 'Robot (Convera)'; }
		if (preg_match('/Down Site Checker/', $user_agent)) { return 'Robot (Yahoo!)'; }
		if (preg_match('/Drecombot/', $user_agent)) { return 'Robot (Drecom)'; }
		if (preg_match('/emyuu_bot/', $user_agent)) { return 'Robot (Emyuu)'; }
		if (preg_match('/FAST-WebCrawler/', $user_agent)) { return 'Robot (fast.no)'; }
		if (preg_match('/findlinks/', $user_agent)) { return 'Robot (findlinks)'; }
		if (preg_match('/Gaisbot/', $user_agent)) { return 'Robot (Openfind)'; }
		if (preg_match('/gazz/', $user_agent)) { return 'Robot (NTTR)'; }
		if (preg_match('/Gigabot/', $user_agent)) { return 'Robot (Gigabot)'; }
		if (preg_match('/Slurp\.so/Goo/', $user_agent)) { return 'Robot (goo)'; }
		if (preg_match('/Googlebot/', $user_agent)) { return 'Robot (Google)'; }
		if (preg_match('/grub-client/', $user_agent)) { return 'Robot (grub-client)'; }
		if (preg_match('/Hatena Antenna/', $user_agent)) { return 'Robot (Hatena)'; }
		if (preg_match('/ia_archiver/', $user_agent)) { return 'Robot (Archiver)'; }
		if (preg_match('/iaskspider/', $user_agent)) { return 'Robot (iAsk)'; }
		if (preg_match('/\.ibm\.com/', $user_agent)) { return 'Robot (IBM)'; }
		if (preg_match('/ichiro/', $user_agent)) { return 'Robot (NTTR)'; }
		if (preg_match('/indexpert/', $user_agent)) { return 'Robot (Fresheye)'; }
		if (preg_match('/Indy Library/', $user_agent)) { return 'Robot (Indy Library)'; }
		if (preg_match('/Infoseek/', $user_agent)) { return 'Robot (Infoseek)'; }
		if (preg_match('/Inktomi/', $user_agent)) { return 'Robot (Inktomi)'; }
		if (preg_match('/livedoorCheckers/', $user_agent)) { return 'Robot (LivedoorCheckers)'; }
		if (preg_match('/Looksmart/', $user_agent)) { return 'Robot (Looksmart)'; }
		if (preg_match('/Lycos_Spider/', $user_agent)) { return 'Robot (Lycos)'; }
		if (preg_match('/MarkAgent/', $user_agent)) { return 'Robot (MarkAgent)'; }
		if (preg_match('/msnbot/', $user_agent)) { return 'Robot (MSN)'; }
		if (preg_match('/NaverRobot/', $user_agent)) { return 'Robot (Naver)'; }
		if (preg_match('/ndl-japan/', $user_agent)) { return 'Robot (ndl-japan)'; }
		if (preg_match('/NPBot/', $user_agent)) { return 'Robot (NameProtect)'; }
		if (preg_match('/Nutch/', $user_agent)) { return 'Robot (Nutch)'; }
		if (preg_match('/OmniExplorer/', $user_agent)) { return 'Robot (OmniExplorer)'; }
		if (preg_match('/onet\.pl/', $user_agent)) { return 'Robot (onet.pl)'; }
		if (preg_match('/Pockey-GetHTML/', $user_agent)) { return 'Robot (GetHTML)'; }
		if (preg_match('/psbot/', $user_agent)) { return 'Robot (Picsearch)'; }
		if (preg_match('/SBIder/', $user_agent)) { return 'Robot (SiteSell)'; }
		if (preg_match('/Scooter/', $user_agent)) { return 'Robot (AltaVista)'; }
		if (preg_match('/Sidewinder/', $user_agent)) { return 'Robot (Infoseek)'; }
		if (preg_match('/sohu-search/', $user_agent)) { return 'Robot (Sohu)'; }
		if (preg_match('/StackRambler/', $user_agent)) { return 'Robot (Rambler)'; }
		if (preg_match('/Su-Jine/', $user_agent)) { return 'Robot (Su-Jine)'; }
		if (preg_match('/TOCC/', $user_agent)) { return 'Robot (TOCC)'; }
		if (preg_match('/Ultraseek/', $user_agent)) { return 'Robot (Ultraseek)'; }
		if (preg_match('/WebCrawler/', $user_agent)) { return 'Robot (WebCrawler)'; }
		if (preg_match('/WISEbot/', $user_agent)) { return 'Robot (WISEbot)'; }
		if (preg_match('/Y!J-DSC/', $user_agent)) { return 'Robot (Yahoo!)'; }
		if (preg_match('/Y!J-BSC/', $user_agent)) { return 'Robot (Yahoo!)'; }
		if (preg_match('/Yahoo! /', $user_agent)) { return 'Robot (Yahoo!)'; }
		if (preg_match('/ZyBorg/', $user_agent)) { return 'Robot (LYCOS)'; }
		if (preg_match('/crawler/', $user_agent)) { return 'Robot (others)'; }
		if (preg_match('/robot/', $user_agent)) { return 'Robot (others)'; }
		if (preg_match('/spider/', $user_agent)) { return 'Robot (others)'; }
		if (preg_match('/WebBot/', $user_agent)) { return 'Robot (others)'; }
		if (preg_match('/Arachmo/', $user_agent)) { return 'Arachmo'; }
		if (preg_match('/aggregator:MyRSS/', $user_agent)) { return 'MyRSS.jp'; }
		if (preg_match('/bookmark\.ne\.jp/', $user_agent)) { return 'Bookmark'; }
		if (preg_match('/Curl/', $user_agent)) { return 'Curl'; }
		if (preg_match('/^Java[\d_\/\.]+$/', $user_agent)) { return 'Program (Java)'; }
		if (preg_match('/Java\(TM\).*Runtime/', $user_agent)) { return 'Program (Java)'; }
		if (preg_match('/libwww-perl/', $user_agent)) { return 'Program (Perl)'; }
		if (preg_match('/Microsoft URL Control/', $user_agent)) { return 'Program (Windows)'; }
		if (preg_match('/PerManSurfer/', $user_agent)) { return 'PerManSurfer'; }
		if (preg_match('/PHP/', $user_agent)) { return 'Program (PHP)'; }
		if (preg_match('/POE-Component/', $user_agent)) { return 'Program (Perl)'; }
		if (preg_match('/samidare/', $user_agent)) { return 'samidare'; }
		if (preg_match('/snoopy/', $user_agent)) { return 'Program (PHP)'; }
		if (preg_match('/Webdup/', $user_agent)) { return 'Webdup'; }
		if (preg_match('/WebAuto/', $user_agent)) { return 'WebAuto'; }
		if (preg_match('/WebFetch/', $user_agent)) { return 'WebFetch'; }
		if (preg_match('/WebWhacker/', $user_agent)) { return 'WebWhacker'; }
		if (preg_match('/Wget/', $user_agent)) { return 'Wget'; }
		if (preg_match('/RSS_READER/', $user_agent, $matches)) { return 'RSS_READER'; }
		if (preg_match('/Headline-Reader/', $user_agent, $matches)) { return 'Headline-Reader'; }
		if (preg_match('/http:\/\//', $user_agent)) { return 'Robot (others)'; }
		if (preg_match('/[a-z]+@[a-z\.]+/', $user_agent)) { return 'Robot (others)'; }
		if (preg_match('/Airboard.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/(DDIPOCKET;)([A-Za-z]*)/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[1]); }
		if (preg_match('/DoCoMo.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/DreamPassport.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/J-PHONE.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/jig.browser.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/NetFront.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/UP\.Browser.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Vodafone.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Camino.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Cuam.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/CubeBrowser.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Donut.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Firebird.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Firefox.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Galeon.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Hotbar.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/HotJava.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/iCab.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Konqueror.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Lunascape.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Lynx.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Maxthon/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/NetFront.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Ninja.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/OmniWeb.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Opera.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Phoenix.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Safari.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Shiira.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Sleipnir/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/Sylera.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/TulipChain.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/w3m.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/WWWC.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/compatible;[\s]+(MSIE.[0-9\.]*)/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[1]); }
		if (preg_match('/^Mozilla/', $user_agent) && preg_match('/(compatible; )([a-zA-Z \/]*[0-9\.]*)/', $user_agent, $matches))
						             { return str_replace('/', ' ', $matches[2]); }
		if (preg_match('/^Mozilla.[0-9\.]*/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }
		if (preg_match('/^([a-zA-Z\/]+.[0-9\.]*)$/', $user_agent, $matches)) { return str_replace('/', ' ', $matches[0]); }

		return '(undefined)';
	}
	
	function get_host($referer) {		
		$url = parse_url($referer);
		return 'http://' . $url['host'];
	}
}
?>