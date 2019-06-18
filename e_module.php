<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2014 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Related configuration module - News
 *
 *
*/

if (!defined('e107_INIT')) { exit; }


//var_dump(USERTHEME);

if(e_ADMIN_AREA !== true) // prevents inclusion of JS/CSS/meta in the admin area.
{
	$switchThemePref = e107::pref('themeswitch', 'switch_userclass');

	$switchThemeLanPref = e107::pref('themeswitch', 'switch_language');

	$switchLayoutPref = e107::pref('themeswitch', 'switch_layout', e_UC_NOBODY);

	if(!empty($_GET['elay']) && ($switchLayoutPref != e_UC_NOBODY) && check_class($switchLayoutPref))
	{
		$elay = filter_var($_GET['elay'], FILTER_SANITIZE_STRING);
		define('THEME_LAYOUT', $elay);
	}
	elseif(defset('e_PAGE') === 'news.php' && !empty($_GET['tpl']) && ($switchLayoutPref != e_UC_NOBODY) && check_class($switchLayoutPref))
	{
		$nlay = filter_var($_GET['tpl'], FILTER_SANITIZE_STRING);
		define('NEWS_LAYOUT', $nlay);
	}

	if(!empty($switchThemePref) && (empty($switchThemeLanPref) || in_array(e_LAN,$switchThemeLanPref)))
	{
		foreach($switchThemePref as $thm=>$val)
		{
			if(intval($val) === e_UC_NOBODY)
			{
				continue;
			}

			if(check_class($val) && !empty($thm))
			{
				define('USERTHEME',$thm);
				break;
			}

		}
	}


//	var_dump(USERTHEME);
//	define('USERTHEME', 'sba');

}



?>