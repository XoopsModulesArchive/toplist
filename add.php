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

include_once("../../mainfile.php");

if (!$xoopsUser) {
	redirect_header( XOOPS_URL.'/user.php', 3, _MD_TOPLIST_SITE_MSG_NO_USER);
} 

$xoopsOption['show_cblock'] = 1;
$xoopsOption['template_main'] = "toplist_add.html";
include $GLOBALS['xoops']->path('header.php');

if (isset($_POST['action'])) {
	
	if (!empty($_POST['name'])) {
	
		$user_id 				= $xoopsUser->getVar('uid');
		$website_name			= stripslashes($_REQUEST['name']);
		$website_url			= $_REQUEST['url'];
		$website_description	= stripslashes($_REQUEST['description']);
		$website_approve		= 0;
	
		$result	= $xoopsDB->queryF("insert into ".$xoopsDB->prefix("toplist_websites")." set user_id = '$user_id', website_name = '$website_name', website_url = '$website_url', website_description = '$website_description', website_approve = '$website_approve' ") or 
		redirect_header( XOOPS_URL.'/modules/toplist/', 3, _MD_TOPLIST_SITE_MSG_FALSE);	
	
		redirect_header( XOOPS_URL.'/modules/toplist/', 3, _MD_TOPLIST_SITE_MSG_CHECKING);
		exit();
	} else {
		redirect_header( XOOPS_URL.'/modules/toplist/add.php', 3, _MD_TOPLIST_SITE_MSG_FALSE);	
	}
}
include $GLOBALS['xoops']->path('footer.php');
?>
