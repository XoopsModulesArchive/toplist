<?php 
// detail
if (isset($_REQUEST['details'])) {
	
	$website_id	= $_REQUEST['details'];
	
	//SELECT HNJ28r_toplist_log.website_id, HNJ28r_toplist_log.timestamp as timestamp, HNJ28r_user_profile.profileid, HNJ28r_user_profile.url , HNJ28r_user_profile.valid as valid FROM HNJ28r_toplist_log, HNJ28r_user_profile WHERE HNJ28r_toplist_log.user_id = HNJ28r_user_profile.profileid AND valid = '1' AND HNJ28r_user_profile.profileid = '54' ORDER BY timestamp

	// today
	$sql 	= "SELECT toplist_log.website_id, toplist_log.timestamp, toplist_websites.website_url as url, toplist_websites.website_name, toplist_websites.website_description, toplist_websites.website_approve FROM ".$xoopsDB->prefix("toplist_log")." as toplist_log , ".$xoopsDB->prefix("toplist_websites"). " as toplist_websites WHERE (website_id = '$website_id') AND (toplist_websites.website_approve = '1') AND toplist_websites.id = toplist_log.website_id ORDER BY timestamp";
	// always
	$sql1	= "SELECT toplist_history.site_count as site_count, toplist_history.timestamp, toplist_websites.id as website_id, toplist_websites.website_url as url, toplist_websites.website_name, toplist_websites.website_description, toplist_websites.website_approve FROM ".$xoopsDB->prefix("toplist_history")." as toplist_history , ".$xoopsDB->prefix("toplist_websites"). " as toplist_websites WHERE (website_id = '$website_id') AND (toplist_websites.website_approve = '1') AND toplist_websites.id = toplist_history.website_id ORDER BY timestamp ASC";

} else {

	// always
	if (isset($_REQUEST['output']) AND $_REQUEST['output'] == "always") {

		// today
		$sql 	= "SELECT count(toplist_log.website_id) as visitors, toplist_log.timestamp, toplist_websites.id as website_id, toplist_websites.website_url, toplist_websites.website_name, toplist_websites.website_description, toplist_websites.website_approve FROM ".$xoopsDB->prefix("toplist_log")." as toplist_log , ".$xoopsDB->prefix("toplist_websites"). " as toplist_websites WHERE (toplist_websites.website_approve = '1') AND toplist_websites.id = toplist_log.website_id GROUP BY toplist_log.website_id ORDER BY visitors DESC";
		// always
		$sql1	= "SELECT sum(toplist_history.site_count) as visitors, toplist_history.timestamp, toplist_websites.id as website_id, toplist_websites.website_url, toplist_websites.website_name, toplist_websites.website_description, toplist_websites.website_approve FROM ".$xoopsDB->prefix("toplist_history")." as toplist_history , ".$xoopsDB->prefix("toplist_websites"). " as toplist_websites WHERE toplist_websites.website_approve = '1' AND toplist_websites.id = toplist_history.website_id GROUP BY toplist_history.website_id ORDER BY visitors DESC";

	// year	
	} elseif (isset($_REQUEST['output']) AND $_REQUEST['output'] == "year") {
	
		// today
		$sql 	= "SELECT count(toplist_log.website_id) as visitors, toplist_log.timestamp, toplist_websites.id as website_id, toplist_websites.website_url, toplist_websites.website_name, toplist_websites.website_description, toplist_websites.website_approve FROM ".$xoopsDB->prefix("toplist_log")." as toplist_log , ".$xoopsDB->prefix("toplist_websites"). " as toplist_websites WHERE (toplist_websites.website_approve = '1') AND toplist_websites.id = toplist_log.website_id GROUP BY toplist_log.website_id ORDER BY visitors DESC";
		// year
		$sql1	= "SELECT sum(toplist_history.site_count) as visitors, toplist_history.timestamp, toplist_websites.id as website_id, toplist_websites.website_url, toplist_websites.website_name, toplist_websites.website_description, toplist_websites.website_approve FROM ".$xoopsDB->prefix("toplist_history")." as toplist_history , ".$xoopsDB->prefix("toplist_websites"). " as toplist_websites WHERE (toplist_history.timestamp >= $t_year) AND (toplist_websites.website_approve = '1') AND toplist_websites.id = toplist_history.website_id GROUP BY toplist_history.website_id ORDER BY visitors DESC";

	// six month	
	} elseif (isset($_REQUEST['output']) AND $_REQUEST['output'] == "six_month") {
	
		// today
		$sql 	= "SELECT count(toplist_log.website_id) as visitors, toplist_log.timestamp, toplist_websites.id as website_id, toplist_websites.website_url, toplist_websites.website_name, toplist_websites.website_description, toplist_websites.website_approve FROM ".$xoopsDB->prefix("toplist_log")." as toplist_log , ".$xoopsDB->prefix("toplist_websites"). " as toplist_websites WHERE (toplist_websites.website_approve = '1') AND toplist_websites.id = toplist_log.website_id GROUP BY toplist_log.website_id ORDER BY visitors DESC";
		// six month
		$sql1	= "SELECT sum(toplist_history.site_count) as visitors, toplist_history.timestamp, toplist_websites.id as website_id, toplist_websites.website_url, toplist_websites.website_name, toplist_websites.website_description, toplist_websites.website_approve FROM ".$xoopsDB->prefix("toplist_history")." as toplist_history , ".$xoopsDB->prefix("toplist_websites"). " as toplist_websites WHERE (toplist_history.timestamp >= $t_six_month) AND (toplist_websites.website_approve = '1') AND toplist_websites.id = toplist_history.website_id GROUP BY toplist_history.website_id ORDER BY visitors DESC";

	// month	
	} elseif (isset($_REQUEST['output']) AND $_REQUEST['output'] == "month") {
	
		// today
		$sql 	= "SELECT count(toplist_log.website_id) as visitors, toplist_log.timestamp, toplist_websites.id as website_id, toplist_websites.website_url, toplist_websites.website_name, toplist_websites.website_description, toplist_websites.website_approve FROM ".$xoopsDB->prefix("toplist_log")." as toplist_log , ".$xoopsDB->prefix("toplist_websites"). " as toplist_websites WHERE (toplist_websites.website_approve = '1') AND toplist_websites.id = toplist_log.website_id GROUP BY toplist_log.website_id ORDER BY visitors DESC";
		// month
		$sql1	= "SELECT sum(toplist_history.site_count) as visitors, toplist_history.timestamp, toplist_websites.id as website_id, toplist_websites.website_url, toplist_websites.website_name, toplist_websites.website_description, toplist_websites.website_approve FROM ".$xoopsDB->prefix("toplist_history")." as toplist_history , ".$xoopsDB->prefix("toplist_websites"). " as toplist_websites WHERE (toplist_history.timestamp >= $t_month) AND (toplist_websites.website_approve = '1') AND toplist_websites.id = toplist_history.website_id GROUP BY toplist_history.website_id ORDER BY visitors DESC";

	// week	
	} elseif (isset($_REQUEST['output']) AND $_REQUEST['output'] == "week") {
	
		// today
		$sql 	= "SELECT count(toplist_log.website_id) as visitors, toplist_log.timestamp, toplist_websites.id as website_id, toplist_websites.website_url, toplist_websites.website_name, toplist_websites.website_description, toplist_websites.website_approve FROM ".$xoopsDB->prefix("toplist_log")." as toplist_log , ".$xoopsDB->prefix("toplist_websites"). " as toplist_websites WHERE (toplist_websites.website_approve = '1') AND toplist_websites.id = toplist_log.website_id GROUP BY toplist_log.website_id ORDER BY visitors DESC";
		// week
		$sql1	= "SELECT sum(toplist_history.site_count) as visitors, toplist_history.timestamp, toplist_websites.id as website_id, toplist_websites.website_url, toplist_websites.website_name, toplist_websites.website_description, toplist_websites.website_approve FROM ".$xoopsDB->prefix("toplist_history")." as toplist_history , ".$xoopsDB->prefix("toplist_websites"). " as toplist_websites WHERE (toplist_history.timestamp >= $week) AND (toplist_websites.website_approve = '1') AND toplist_websites.id = toplist_history.website_id GROUP BY toplist_history.website_id ORDER BY visitors DESC";

	// yesterday	
	} elseif (isset($_REQUEST['output']) AND $_REQUEST['output'] == "yesterday") {
	
		$sql 	= "SELECT toplist_history.site_count as visitors, toplist_history.timestamp, toplist_websites.id as website_id, toplist_websites.website_url, toplist_websites.website_name, toplist_websites.website_description, toplist_websites.website_approve FROM ".$xoopsDB->prefix("toplist_history")." as toplist_history , ".$xoopsDB->prefix("toplist_websites"). " as toplist_websites WHERE (toplist_history.timestamp >= $yesterday) AND (toplist_websites.website_approve = '1') AND toplist_websites.id = toplist_history.website_id GROUP BY toplist_history.website_id ORDER BY visitors DESC";

	// hour	
	} elseif (isset($_REQUEST['output']) AND $_REQUEST['output'] == "hour") {	
		
		$sql 	= "SELECT count(toplist_log.website_id) as visitors, toplist_log.timestamp, toplist_websites.id as website_id, toplist_websites.website_url, toplist_websites.website_name, toplist_websites.website_description, toplist_websites.website_approve FROM ".$xoopsDB->prefix("toplist_log")." as toplist_log , ".$xoopsDB->prefix("toplist_websites"). " as toplist_websites WHERE (toplist_log.timestamp >= $t_hour) AND (toplist_websites.website_approve = '1') AND toplist_websites.id = toplist_log.website_id GROUP BY toplist_log.website_id ORDER BY visitors DESC";

	// today	
	} else {
	
		$sql 	= "SELECT count(toplist_log.website_id) as visitors, toplist_log.timestamp, toplist_websites.id as website_id, toplist_websites.website_url, toplist_websites.website_name, toplist_websites.website_description, toplist_websites.website_approve FROM ".$xoopsDB->prefix("toplist_log")." as toplist_log , ".$xoopsDB->prefix("toplist_websites"). " as toplist_websites WHERE (toplist_websites.website_approve = '1') AND toplist_websites.id = toplist_log.website_id GROUP BY toplist_log.website_id ORDER BY visitors DESC";
	}
}
?>