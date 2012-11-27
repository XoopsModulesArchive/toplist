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



if(strpos(getenv('REQUEST_URI'), '/modules/toplist/') === 0)
{
$oldurl = getenv('REQUEST_URI');
$newurl = str_replace("modules/toplist", "topliste", $oldurl); @header("HTTP/1.1 301 Moved Permanently");
@header("Location: $newurl");
}

include_once("../../mainfile.php");

$xoopsOption['template_main'] = 'toplist_detail.html';

include $GLOBALS['xoops']->path('header.php');

require_once("include/functions.php");
// check valid date
require_once("include/date.inc.php");
// read xoops websites today
require_once("include/sql.querys.inc.php");

// follow link
$xoopsModuleConfig['toplist_nofollow'] == 0 ? $xoopsTpl->assign('follow', 'rel="nofollow"') : $xoopsTpl->assign('follow', '');

// today
$result21								= $xoopsDB->query($sql);

#print_r($xoopsDB->fetchRow($result21));
$website	= array();

while(list($site_count, $timestamp, $url, $name, $description) = $xoopsDB->fetchRow($result21)) {
	$website[$timestamp]	= array("site_count" => $site_count, "timestamp" => $timestamp, "url" => $url, "name" => $name, "description" => $description);
}

// user today exists?
if (count($website) > 0) {
	
	$j = 0;
	foreach ($website as $key => $value) {
		
			if ($key >= $t_hour) {
				$j++;
			}
		
		$website_name				= $value['name'];
		$website_description		= $value['description'];
		$website_url				= $value['url'];
	}
	$site_count			= count($website);
	$count_last_hour	= $j;
}


$count_today 		= $site_count;
$count_week			= 0;
$count_month		= 0;
$count_six_month	= 0;
$count_year			= 0;
$count_always		= 0;
$count_days			= 0;
$highest_value		= 0;
		
#print_r($website);


$lowest_value = 10000000;
	
// history
$result1							= $xoopsDB->query($sql1);
// url is valid

#print_r($xoopsDB->fetchRow($result1));
#exit();

while(list($site_count, $timestamp, $profileid, $url, $name, $description) = $xoopsDB->fetchRow($result1)) {
	$website_history[$timestamp]	= array("site_count" => $site_count, "timestamp" => $timestamp, "profilid" => $profileid, "url" => $url, "name" => $name, "description" => $description);
}

#print_r($website_history);

// history exists?
if (count($website_history) > 0) {
	
	foreach ($website_history as $key => $value) {
		
		// online_since
		if (!isset($online_since)) {
			$online_since		= $key;
		}
		// yesterday
		if ($key == $yesterday) {
			$count_yesterday 	= $value['site_count'];
		}
		// week
		if ($key >= $week) {
			$count_week			= $count_week + $value['site_count']; 
		}
		// month
		if ($key >= $t_month) {
			$count_month		= $count_month + $value['site_count']; 
		}
		// six month
		if ($key >= $t_six_month) {
			$count_six_month	= $count_six_month + $value['site_count']; 
		}	
		// year
		if ($key >= $t_year) {
			$count_year			= $count_year + $value['site_count']; 
		}
		// always
		$count_always			= $count_always + $value['site_count']; 
			
		// count days
		$count_days++;
			
		// highest value
		$highest_value < $value['site_count'] ? $highest_value = $value['site_count'] : $highest_value = $highest_value;
			
		// lowest value
		$lowest_value < $value['site_count'] ? $lowest_value = $lowest_value : $lowest_value = $value['site_count'];
			
		// website description
		$website_description		= $value['description'];
		
		// website name
		$website_name				= $value['name'];
		
		// website url
		$website_url				= $value['url'];
	}
}

$online_since				= date("d.m.Y",$online_since);
$online_since == "01.01.1970" ? $online_since = date("d.m.Y",time()) : $online_since = $online_since;
		
$online_since_day			= $count_days+1;
		
$highest_value				= $highest_value < $count_today ? $highest_value = $count_today : $highest_value = $highest_value;
$lowest_value				= $lowest_value > $count_today ? $lowest_value = $count_today : $lowest_value = $lowest_value;
		
empty($lowest_value) ? $lowest_value = 0 : $lowest_value = $lowest_value;
		
$count_last_hour			= empty($count_last_hour) ? $count_last_hour = 0 : $count_last_hour = $count_last_hour;
$count_today				= empty($count_today) ? $count_today = 0 : $count_today = $count_today;
$count_yesterday			= empty($count_yesterday) ? $count_yesterday = 0 : $count_yesterday = $count_yesterday;
$count_week 				= $count_week + $count_today;
		
empty($count_week) ? $count_week = 0 : $count_week = $count_week;
		
$count_month				= $count_month + $count_today;
		
empty($count_month) ? $count_month = 0 : $count_month = $count_month;
		
$count_six_month			= $count_six_month + $count_today;
		
empty($count_six_month) ? $count_six_month = 0 : $count_six_month = $count_six_month;
		
$count_year					= $count_year + $count_today;
		
empty($count_year) ? $count_year = 0 : $count_year = $count_year;
		
$count_always				= $count_always + $count_today;
		
$average					= round($count_always / $online_since_day);
	 
$xoopsTpl->assign('website_name', $website_name);
$xoopsTpl->assign('website_description', $website_description);
$xoopsTpl->assign('website_url', $website_url);
$xoopsTpl->assign('online_since', $online_since);
$xoopsTpl->assign('online_since_day', $online_since_day);
$xoopsTpl->assign('highest_value', $highest_value);
$xoopsTpl->assign('lowest_value', $lowest_value);
$xoopsTpl->assign('count_last_hour', $count_last_hour);
$xoopsTpl->assign('count_today', $count_today);
$xoopsTpl->assign('count_yesterday', $count_yesterday);
$xoopsTpl->assign('count_week', $count_week);
$xoopsTpl->assign('count_month', $count_month);
$xoopsTpl->assign('count_six_month', $count_six_month);
$xoopsTpl->assign('count_year', $count_year);
$xoopsTpl->assign('count_always', $count_always);
$xoopsTpl->assign('count_average', $average);
	
$xoopsTpl->assign('xoops_pagetitle', _MD_TOPLIST_ALWAYS." ".str_replace("http://www.","",$website_name));
include(XOOPS_ROOT_PATH."/footer.php");
?>