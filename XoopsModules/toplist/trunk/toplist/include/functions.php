<?php
function copyright() {
	include(XOOPS_ROOT_PATH."/modules/toplist/xoops_version.php");
	$copyright = "Toplist ".$modversion['version']." by <a href='http://www.webmystar.org'>Xoops Toplist</a>";
	return ($copyright);
}
?>
