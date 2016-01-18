<?php

$hour			= date("H");
$day			= date("d");
$month			= date("m"); 
$year			= date("Y");

$t_hour			= mktime($hour-1,0,0,$month,$day,$year);
$today			= mktime(0,0,0,$month,$day,$year);
$tomorrow		= mktime(0,0,0,$month,$day+1,$year);
$yesterday		= mktime(0,0,0,$month,$day-1,$year);
$week			= mktime(0,0,0,$month,$day-6,$year);

$t_month		= mktime(0,0,0,$month-1,$day,$year);
$t_six_month	= mktime(0,0,0,$month-6,$day,$year);
$t_year			= mktime(0,0,0,$month,$day,$year-1);

$history_array	= array();

#echo $today."<br>".$tomorrow;

// last id in database
$sql			= "SELECT id, timestamp FROM ".$xoopsDB->prefix("toplist_log")." ORDER BY id DESC LIMIT 1";
$result			= $xoopsDB->query($sql) or exit("Error");
$last_timestamp	= $xoopsDB->fetchArray($result);

// last timestamp
if ($last_timestamp['timestamp'] < $today) {
	
	$sql 	= "SELECT count(".$xoopsDB->prefix("toplist_log").".website_id) as visitors, ".$xoopsDB->prefix("toplist_log").".website_id FROM ".$xoopsDB->prefix("toplist_log")."
			GROUP BY ".$xoopsDB->prefix("toplist_log").".website_id ORDER BY visitors DESC";
	
	$result	= $xoopsDB->query($sql);
	
	while(list($visitors, $user_id) = $xoopsDB->fetchRow($result)) {
		
		$history_array[] = array("website_id" 	=> $user_id,
								 "site_count"	=> $visitors,
								 "timestamp"	=> $yesterday);
	}
	
	for ($i=0;$i<count($history_array);$i++) {
		$sql_history_write	= "insert into ".$xoopsDB->prefix("toplist_history")." set website_id = '".$history_array[$i]['website_id']."', site_count = '".$history_array[$i]['site_count']."', timestamp = '$yesterday'";
		$result	= $xoopsDB->queryF($sql_history_write);
	}
	
	// delete toplist_log
	$result	= $xoopsDB->queryF("TRUNCATE ".$xoopsDB->prefix("toplist_log"));
	
} 
?>