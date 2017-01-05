<?php
/**
 * @package     toy_database
 * @subpackage  toy_database
 *
 * @copyright   Copyright (C) 2016 Andy Brown
 */
$debug=0;

// call this to trigger a PDF print/page display
// idea is this will be in a separate popup/browser window that user can then print
// or choose print to file/PDF it themselves

// This script needs to be able to take whatever query and display it formatted
// it will also be called without joomla components so init joomla first

// revision 05/01/17 - this wont really work. So go to plan B and take in the type to display, all
// sql and display code will be in this file (duplicate really of the display options in the individual
// admin files)

define( '_JEXEC', 1 );
define('JPATH_BASE', dirname(__FILE__)."/../../.." );//this is when we are in the root,means path to Joomla installation
define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );

$app = JFactory::getApplication('site');
$app->initialise();
$db = JFactory::getDBO();// Joomla database object
$jinput = JFactory::getApplication()->input;
$config = JFactory::getConfig();

$disp = $jinput->get('disp', '', 'RAW'); // disp is the display type (categories,members,toys,requests)

// push out the headers, display, etc
?>
<HTML>
<HEAD>
<TITLE>Toy library database - printout view</TITLE>
<style>
    /**
    * Eric Meyer's Reset CSS v2.0 (http://meyerweb.com/eric/tools/css/reset/)
    * http://www.cssportal.com
    */
    html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
    a, abbr, acronym, address, big, cite, code,
    del, dfn, em, img, ins, kbd, q, s, samp,
    small, strike, strong, sub, sup, tt, var,
    b, u, i, center,
    dl, dt, dd, ol, ul, li,
    fieldset, form, label, legend,
    table, caption, tbody, tfoot, thead, tr, th, td,
    article, aside, canvas, details, embed,
    figure, figcaption, footer, header, hgroup,
    menu, nav, output, ruby, section, summary,
    time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
    }
    /* HTML5 display-role reset for older browsers */
    article, aside, details, figcaption, figure,
    footer, header, hgroup, menu, nav, section {
    display: block;
    }
    body {
    line-height: 1;
    }
    ol, ul {
    list-style: none;
    }
    blockquote, q {
    quotes: none;
    }
    blockquote:before, blockquote:after,
    q:before, q:after {
    content: '';
    content: none;
    }
    table {
    border-collapse: collapse;
    border-spacing: 0;
    }
    
body {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 13px;
    color:#333
}

p {
    padding: 10px;
}

#wrapper {
    margin: 0 auto;
    width: 1000px;
}

#headerwrap {
    width: 1000px;
    float: left;
    margin: 0 auto;
}

#header {
    height: 75px;
    background: #B0DAFF;
    border-radius: 10px;
    border: 1px solid #9cc6eb;
    margin: 5px;
}

#contentwrap {
    width: 1000;
    float: left;
    margin: 0 auto;
}

#content {
    background: #FFFFFF;
    border-radius: 10px;
    border: 1px solid #ebebeb;
    margin: 5px;
}

#footerwrap {
    width: 1000px;
    float: left;
    margin: 0 auto;
    clear: both;
}

#footer {
    height: 40px;
    background: #B0DAFF;
    border-radius: 10px;
    border: 1px solid #9cc6eb;
    margin: 5px;
    font-size: 40%;
}
    
</style>
</HEAD>
<BODY>
<div id="wrapper">
<div id="headerwrap">
        <div id="header">
            <center><p>Toy library Database for <?=$config->get('sitename')?></p></center>
        </div>
        </div>
<?php 

switch($disp) {
	case "categories":
		echo "<p>Toy Category display</p>";
		echo "</div></div>";
		echo "<div id='contentwrap'><div id='content'>";
		
		$query = $db->getQuery(true);
		$query
		->select('*')
		->from($db->quoteName('#__toydatabase_equipment_category'))
		->order($db->quoteName('category') . ' ASC');
		
		$db->setQuery($query);
		$row = $db->loadAssocList('id');
		?>
				
				<table width=85% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
				<tr><td width=30%><B>Category name</B></td></tr>
				<?php
				if (!empty($row)) {
					// print_r($row);
					foreach ($row as $row_key=>$row_value) {
						echo "<tr>";
						echo "<td>".$row_value["category"]."</td></tr>\n";
					};
				} else {
					// no rows or toys in database found
					echo "<tr><td colspan=1 align=center><B>Sorry - No categories found</B></td></tr>\n";
				};
		?>
						</table>
<?php 
		break;
	case "members":
		break;
	case "toys":
		break;
	case "requests":
		break;
	default:
		// nothing should get here so give blank
		echo "";
		break;
};
?>
</div>
        </div>
        <div id="footerwrap">
        <div id="footer">
            <center><p>Toy library database (C)<?=date("Y")?> Andy Brown broadcast-tech.co.uk</p></center>
        </div>
        </div>
    </div>
</body>
</html>