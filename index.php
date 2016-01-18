<?php
// ------------------------------------------------------------------------- //
//                XOOPS - PHP Content Management System                      //
//                       <http://www.xoops.org/>                             //
// ------------------------------------------------------------------------- //
// Based on:								     //
// myPHPNUKE Web Portal System - http://myphpnuke.com/	  		     //
// PHP-NUKE Web Portal System - http://phpnuke.org/	  		     //
// Thatware - http://thatware.org/					     //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------- //

#if(strpos(getenv('REQUEST_URI'), '/modules/toplist/') === 0)
#{
#$oldurl = getenv('REQUEST_URI');
#$newurl = str_replace("modules/toplist", "topliste", $oldurl); @header("HTTP/1.1 301 Moved Permanently");
#@header("Location: $newurl");
#}

include_once("../../mainfile.php");

$xoopsOption['template_main'] = 'toplist_index.html';
include $GLOBALS['xoops']->path('header.php');

require_once("include/user_agent_data.class.php");
require_once("include/xoops.php");

require_once("include/functions.php");
// check valid date
require_once("include/date.inc.php");
// read xoops websites today
require_once("include/sql.querys.inc.php");

// defination vari
$websites 		= array();
$websites1		= array();

$max_links		= $xoopsModuleConfig['toplist_view_entries'];
// follow link
$xoopsModuleConfig['toplist_nofollow'] == 0 ? $xoopsTpl->assign('follow', 'rel="nofollow"') : $xoopsTpl->assign('follow', '');

#if (isset($_SERVER["HTTP_REFERER"]) || $_SERVER['HTTP_HOST'] == str_replace("http://","",XOOPS_URL)) {
	
	$user_agent_data					= new user_agent_data();
	$user_agent_data->user_agent		= $_SERVER["HTTP_USER_AGENT"];
	$user_agent_data->referer			= $_SERVER["HTTP_REFERER"];
	$user_agent_data->ip				= $_SERVER["REMOTE_ADDR"];
	
	$agent								= $user_agent_data->get_os($user_agent_data->user_agent);
	$browser							= $user_agent_data->get_browser($user_agent_data->user_agent);
	
	$referer							= $user_agent_data->get_referer_host($user_agent_data->referer);
	$referer == "http://" ? $referer 	= XOOPS_URL : $referer = $referer;
		
	$ip									= $user_agent_data->ip;
	$time								= time();
	
	// check user id 
	$sql_referer						= "SELECT toplist.user_id, toplist.website_url, toplist.id as website_id, toplist.website_approve, users.uid FROM ".$xoopsDB->prefix("toplist_websites")." as toplist, ".$xoopsDB->prefix("users")." as users WHERE (toplist.website_url = '$referer' OR toplist.website_url = '$referer/') AND (toplist.user_id = users.uid) AND toplist.website_approve = '1'";
	$result								= $xoopsDB->query($sql_referer) or exit("Error");
	$valid_userid						= $xoopsDB->fetchArray($result);
	
	// write new website in db
	if (empty($valid_userid['website_url'])) {
		
		// websites exists - not approved
		$sql_referer						= "SELECT toplist.user_id, toplist.website_url, toplist.id as website_id, toplist.website_approve, users.uid FROM ".$xoopsDB->prefix("toplist_websites")." as toplist, ".$xoopsDB->prefix("users")." as users WHERE (toplist.website_url = '$referer' OR toplist.website_url = '$referer/') AND (toplist.user_id = users.uid) AND toplist.website_approve = '0'";
		$result								= $xoopsDB->query($sql_referer) or exit("Error");
		$valid_userid						= $xoopsDB->fetchArray($result);
		
		// website not exists
		if (empty($valid_userid['website_id'])) {
			$result						= $xoopsDB->queryF("insert into ".$xoopsDB->prefix("toplist_websites")." set website_name = '$referer', website_url = '$referer', user_id = '1', website_description = '$referer', website_approve = '0'");
		}
		
	} else {

		$website_id 					= $valid_userid['website_id'];
	
		// unique_record exists?
 		$result							= $xoopsDB->query("SELECT user_ip, website_id FROM ".$xoopsDB->prefix("toplist_log")." WHERE website_id = '$website_id' AND user_ip = '$ip'") or exit("Error");								
		$unique_record					= $xoopsDB->fetchArray($result);
		
		// record exists?
		if (empty($unique_record['website_id'])) {
			$result						= $xoopsDB->queryF("insert into ".$xoopsDB->prefix("toplist_log")." set website_id = '$website_id', user_agent = '$browser', user_ip = '$ip', user_os = '$agent', timestamp = '$time' ") or exit("Error");	
		}
	
		// exlude own page
		#if ($referer != XOOPS_URL AND $_SERVER['REDIRECT_URL'] != "/topliste/") {
		
		if ($referer != XOOPS_URL."/") {
			require_once("include/picture.php");
			exit();
		}
			
		#}
	}
#}

// user today
$result								= $xoopsDB->query($sql);

#print_r($xoopsDB->fetchRow($result));
#exit();

$i = 1;
while(list($visitors, $timestamp, $profileid, $url, $name, $description) = $xoopsDB->fetchRow($result)) {
	
	$websites[]	= array("place" => $i, "visitors" => $visitors, "url" => $url, $url => $url, "profilid" => $profileid, "name" => $name, "description" => $description);
	$i++;
}



if ((isset($_REQUEST['output']) AND $_REQUEST['output'] != "today") AND (isset($_REQUEST['output']) AND  $_REQUEST['output'] != "yesterday") AND (isset($_REQUEST['output']) AND  $_REQUEST['output'] != "hour")) {

	$result1								= $xoopsDB->query($sql1);
	
	$i = 1;
	while(list($visitors, $timestamp, $profileid, $url, $name, $description) = $xoopsDB->fetchRow($result1)) {
		$websites1[]	= array("place" => $i, "visitors" => $visitors, "url" => $url, $url => $url, "profilid" => $profileid, "name" => $name, "description" => $description);
		$i++;
	}

	$new_array = array_merge($websites,$websites1);
	
	#print_r($new_array);
	
	for ($i = 0; $i<count($new_array);$i++) {
		
		$url 		 	  = $new_array[$i]['url'];
		
		$websites2[$url] = array("visitors"				 => $new_array[$i]['visitors'],
			                          "url"					 => $new_array[$i]['url'],
						  			  $new_array[$i]['url']  => $new_array[$i]['url'],
						  			  "profilid" 			 => $new_array[$i]['profilid'],
						  			  "uname"				 => $new_array[$i]['uname'],
						  			  "name"				 => $new_array[$i]['name'],
						  			  "description"			 => $new_array[$i]['description']
									  );
	}
	
	$websites2	= array_values($websites2);
	
	arsort($websites2);
	$websites2	= array_values($websites2);
	
	for ($i=0;$i<count($websites2);$i++) {
	
		$websites2[$i]['place'] = $i+1;
	}
	
	$websites = array();
	$websites = $websites2;
}

isset($websites) ? $websites = $websites : $websites = array();

$index = 0;

// count index
for ($i=0;$i<=count($websites);$i=$i+$max_links) {
	$index++;
}
// output
!isset($_REQUEST['output']) ? $_REQUEST['output'] = "today" : $_REQUEST['output'] = $_REQUEST['output'];

if ($_REQUEST['output'] == "today") {
	$headline			= _MD_TOPLIST_TODAY;
} elseif ($_REQUEST['output'] == "hour") {
	$headline			= _MD_TOPLIST_HOUR;
} elseif ($_REQUEST['output'] == "yesterday") {
	$headline			= _MD_TOPLIST_YESTERDAY;
} elseif ($_REQUEST['output'] == "week") {
	$headline			= _MD_TOPLIST_WEEK;
} elseif ($_REQUEST['output'] == "month") {
	$headline			= _MD_TOPLIST_MONTH;
} elseif ($_REQUEST['output'] == "six_month") {
	$headline			= _MD_TOPLIST_SIX_MONTH;
} elseif ($_REQUEST['output'] == "year") {
	$headline			= _MD_TOPLIST_YEAR;
} else {
	$headline			= _MD_TOPLIST_ALWAYS;
}

 
// slice array
!isset($_REQUEST['site']) || $_REQUEST['site'] == 1 ? $_REQUEST['site'] = 0 : $_REQUEST['site'] = $_REQUEST['site']-1;

#echo $_REQUEST['site'];

$websites = array_slice($websites,$_REQUEST['site']*$max_links,$max_links);
#print_r($websites);

$xoopsTpl->assign('index', $index);

#print_r($websites);

$xoopsTpl->assign('websites', $websites);
$xoopsTpl->assign('headline', $headline);

$xoopsTpl->assign('xoops_pagetitle', _MD_TOPLIST_NAME." ".$headline);
include(XOOPS_ROOT_PATH."/footer.php");
?>
