<?php
$modversion['name'] = "Toplist";
$modversion['version'] = 0.19;
$modversion['description'] = "Toplist";
$modversion['credits'] = "Sven Seidel<br>http://www.webmystar.org";
$modversion['author'] = "Sven Seidel";
$modversion['help'] = "";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "images/slogo.png";
$modversion['dirname'] = "toplist";

$modversion['status_version'] = "Beta";
$modversion['developer_website_url'] = "http://www.webmystar.org";
$modversion['developer_website_name'] = "Webmystar";
$modversion['developer_email'] = "sven.seidel@webmystar.de";
$modversion['status'] = "Beta";
$modversion['date'] = "06/11/2012";

$modversion['sqlfile']['mysql']		= "sql/mysql.sql";
// tables
$i=0;
$modversion['tables'][$i] 			= "toplist_log";
$i++;
$modversion['tables'][$i] 			= "toplist_history";
$i++;
$modversion['tables'][$i] 			= "toplist_websites";

//Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Menu
$modversion['hasMain'] = 1;

// Templates
$i=0; $i++;
$modversion['templates'][$i]['file'] = 'toplist_index.html';
$modversion['templates'][$i]['description'] = '';
$i++;
$modversion['templates'][$i]['file'] = 'toplist_detail.html';
$modversion['templates'][$i]['description'] = '';
$i++;
$modversion['templates'][$i]['file'] = 'toplist_add.html';
$modversion['templates'][$i]['description'] = '';
$i++;
$modversion['templates'][$i]['file'] = 'toplist_code.html';
$modversion['templates'][$i]['description'] = '';
$i++;
$modversion['templates'][$i]['file'] = 'toplist_navi.html';
$modversion['templates'][$i]['description'] = '';

// CONFIG stuff
$i=0; $i++;
$modversion['config'][$i]['name'] = 'toplist_nofollow';
$modversion['config'][$i]['title'] = '_MI_TOPLIST_FOLLOW';
$modversion['config'][$i]['description'] = '_MI_TOPLIST_FOLLOWDSC';
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 0;
$modversion['config'][$i]['category'] = 'settings';

$i++;
$modversion['config'][$i]['name'] = 'toplist_view_entries';
$modversion['config'][$i]['title'] = '_MI_TOPLIST_VIEW_ENTRIES';
$modversion['config'][$i]['description'] = '_MI_TOPLIST_VIEW_ENTRIESDSC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 15;
?>
