<?php
// ------------------------------------------------------------------------- //
//                XOOPS - PHP Content Management System                      //
//                       <http://www.xoops.org/>                             //
// ------------------------------------------------------------------------- //
// Based on:                                                                     //
// myPHPNUKE Web Portal System - http://myphpnuke.com/                               //
// PHP-NUKE Web Portal System - http://phpnuke.org/                               //
// Thatware - http://thatware.org/                                             //
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

        include_once 'admin_header.php';
        include XOOPS_ROOT_PATH.'/class/xoopsformloader.php';


        if (isset($_GET['op']) && $_GET['op'] == 'Siteshow') {
        $op = 'Siteshow';
        }
        if (isset($_GET['op']) && $_GET['op'] == 'Siteeedit') {
        $op = 'Siteedit';
        }        
        if (isset($_GET['op']) && $_GET['op'] == 'Siteblock') {
        $op = 'Siteblock';
        }
        if (isset($_GET['op']) && $_GET['op'] == 'Siteapprove') {
        $op = 'Siteapprove';
        }
        if (isset($_POST['op']) && $_POST['op'] == 'Sitesave') {
        $op = 'Sitesave';
        }

/*********************************************************/
/* Ephemerids Functions to have a Historic Ephemerids    */
/*********************************************************/

function Choice() {

        global $xoopsModule;
        xoops_cp_header();

        echo '<table class="outer" width="100%"><tr><td class="even">';
        echo "<a href='../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$xoopsModule ->getVar('mid')."'>"._AM_TOPLIST_CONFIG."</a><br />";
        echo "<a href='index.php?op=Siteshow'>"._AM_TOPLIST_EDIT."</a><br />";
        echo '</td></tr></table>';
        xoops_cp_footer();
}

function Siteblock($block=0) {

        global $xoopsDB;

        if (isset($_POST['block']) && $_POST['block'] == 1) {
        
        $result = $xoopsDB->queryF("UPDATE ".$xoopsDB->prefix("toplist_websites")." SET website_approve = 0 WHERE id=".$xoopsDB->quoteString($_POST['id'])."");
        redirect_header("index.php?op=Siteshow",2,_AM_TOPLIST_BLOCKTRUE);
        exit();
        }
        else {
        xoops_cp_header();
        xoops_confirm(array('id' => $_GET['id'], 'block' => 1), 'index.php?op=Siteblock', _AM_TOPLIST_SUREBLOCKSITE);
        xoops_cp_footer();
        }
}

function Siteapprove() {

        global $xoopsDB;

       $result = $xoopsDB->queryF("UPDATE ".$xoopsDB->prefix("toplist_websites")." SET website_approve = 1 WHERE id=".$xoopsDB->quoteString($_GET['id'])."");

        redirect_header("index.php?op=Siteshow",2,_AM_TOPLIST_APPROVETRUE);
        exit();
}



function Sitesave() {

        global $xoopsDB;

        $id 					= $_POST['id'];
        $website_name			= $_POST['website_name'];
        $website_url			= $_POST['website_url'];
        $website_description	= $_POST['website_description'];
        $website_approve		= $_POST['website_approve'];
        
       
        $xoopsDB->query("UPDATE ".$xoopsDB->prefix('toplist_websites')." SET website_name = '".$website_name."', website_url = '".$website_url."', website_description = '".$website_description."', website_approve = '".$website_approve."' WHERE id = '".$id."'");
        redirect_header("index.php?op=Siteshow",3,_AM_TOPLIST_MSGMOD.$_POST['approved']);
        exit();
}

function Siteedit($id) {

        global $xoopsDB, $xoopsModule;
        $myts =& MyTextSanitizer::getInstance();
        xoops_cp_header();

        $result=$xoopsDB->query("SELECT id, user_id, website_name, website_url, website_description, website_approve FROM ".$xoopsDB->prefix("toplist_websites")." WHERE id = $id ");
        list($id, $user_id, $website_name, $website_url, $website_description, $website_approve) = $xoopsDB->fetchRow($result);

        /*
        if($user_id !=0 ) {
        $disabled="readonly='readonly'";
        }
		*/
        
        $edform = new XoopsThemeForm(_AM_TOPLIST_EDITENTRY, "toplist", "index.php");
        $edformuname = new XoopsFormText(_AM_TOPLIST_SITENAME, "website_name", 75, 75, $website_name);
        #$edformuname->setExtra(''.$disabled.'');
        $edform->addElement($edformuname);

        $edformemail = new XoopsFormText(_AM_TOPLIST_URL, "website_url", 75, 75, $website_url);
        #$edformemail->setExtra(''.$disabled.'');
        $edform->addElement($edformemail); 

        $edformmessage = new XoopsFormDhtmlTextArea(_AM_TOPLIST_DSC, 'website_description', $website_description, 10, 50);
        $edform->addElement($edformmessage);
        
        $edformapprove = new XoopsFormRadioYN(_AM_TOPLIST_APPROVE, 'website_approve', $website_approve, _YES, _NO);
        $edform->addElement($edformapprove);
        
        $op_hidden = new XoopsFormHidden("op", "Sitesave");
        $edform->addElement($op_hidden);
        
        $idmsg_hidden = new XoopsFormHidden("id", $_GET['id']);
        $edform->addElement($idmsg_hidden);
        
        $submit_button = new XoopsFormButton("", "dbsubmit", _SUBMIT, "submit");
        $edform->addElement($submit_button);
        
        $edform->display();
        

        xoops_cp_footer();
}

function Siteshow() {

        global $xoopsDB;
        $myts =& MyTextSanitizer::getInstance();
        xoops_cp_header();

		echo "<table border='0' width='90%' class='outer' align='center'>
        <tr>
        	<td class='even'><b>"._AM_TOPLIST_NUM."</b></td>
        	<td class='odd'><b>"._AM_TOPLIST_SITENAME."</b></td>
        	<td class='even'><b>"._AM_TOPLIST_URL."</b></td><td class='odd'><b>"._AM_TOPLIST_DSC."</b></td>
        	<td class='even'><b>"._AM_TOPLIST_ACTION."</b></td>
        </tr>";


        $result=$xoopsDB->query("SELECT id, user_id, website_name, website_url, website_description, website_approve FROM ".$xoopsDB->prefix("toplist_websites")." ORDER BY id DESC");
        $nbmessage=$xoopsDB->getRowsNum($result);

		$i = 0;
        while (list($id, $user_id, $website_name, $website_url, $website_description, $website_approve) = $xoopsDB->fetchRow($result)) {

        $message = "";
        $title	 = "";
        	
        $message=$myts->htmlSpecialChars($message, 0, 1, 1);
        $title=$myts->htmlSpecialChars($title, 0, 0, 0);

                if($website_approve == 0) $approve="<a href='index.php?op=Siteapprove&amp;id=$id'>"._AM_TOPLIST_APPROVE."</a> | ";
                else $approve="";
		$i++;
		
		$website_description = substr ($website_description, 0, 30 );
		
        echo "<tr>
        <td class='odd'>$i.)</td>
        <td class='odd'>$website_name&nbsp;</td>
        <td class='odd'>$website_url&nbsp;</td>
        <td class='even'>$website_description&nbsp;</td>
        
        <td class='odd'>".$approve."<a href='index.php?op=Siteeedit&amp;id=$id'>"._AM_TOPLIST_EDIT."</a> | <a href='index.php?op=Siteblock&amp;id=$id'>"._AM_TOPLIST_BLOCK."</a></td>
        </tr>";
        $nbmessage--;
        }

        echo "</table>";

        xoops_cp_footer();
}


switch($op) {
        case "Sitesave":
                Sitesave();
                break;
        case "Siteedit":
                Siteedit($_GET["id"]);
                break;
        case "Siteapprove":
                Siteapprove();
                break;
        case "Siteblock":
                Siteblock();
                break;

        case "Siteshow":
                Siteshow();
                break;
        default:
                Choice();
                break;
}

?>
