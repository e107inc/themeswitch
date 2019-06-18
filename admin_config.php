<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

// e107::lan('themeswitch',true);


class themeswitch_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'themeswitch_ui',
			'path' 			=> null,
			'ui' 			=> 'themeswitch_form_ui',
			'uipath' 		=> null
		),
		

	);	
	
	
	protected $adminMenu = array(
			
		'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),	

		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P')
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = 'ThemeSwitch';
}




				
class themeswitch_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'ThemeSwitch';
		protected $pluginName		= 'themeswitch';
	//	protected $eventName		= 'themeswitch-'; // remove comment to enable event triggers in admin. 		
		protected $table			= '';
		protected $pid				= '';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
	//	protected $batchCopy		= true;		
	//	protected $sortField		= 'somefield_order';
	//	protected $orderStep		= 10;
	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= ' DESC';
	
		protected $fields 		= NULL;		
		
		protected $fieldpref = array();
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
			'switch_layout'         => array('title'=> 'Switching of layouts via URL query', 'tab'=>0, 'type'=>'userclass', 'data'=>'int', 'writeParms'=>array('default'=>e_UC_NOBODY), 'help'=>'Use elay=xxxx'),
			'switch_language'		=> array('title'=> 'Limit Switching to Specific Languages', 'tab'=>0, 'type'=>'checkboxes', 'data' => 'str', 'help'=>'Leave all unchecked to ignore user language.'),

			'switch_userclass'		=> array('title'=> 'Userclass Switching', 'tab'=>0, 'type'=>'method', 'data' => 'str', 'help'=>''),

		);

	
		public function init()
		{
			// Set drop-down values (if any).
			e107::getMessage()->addInfo("For best results, use only themes which utilize common layout names. eg. jumbotron_home etc. ");

			$this->prefs['switch_language']['writeParms']['optArray'] = e107::getLanguage()->installed('abbr');
			$this->prefs['switch_language']['writeParms']['useKeyValues'] = 1;
	
		}

		
		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			// do something
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			// do something	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		
		
			
	/*	
		// optional - a custom page.  
		public function customPage()
		{
			$text = 'Hello World!';
			$otherField  = $this->getController()->getFieldVar('other_field_name');
			return $text;
			
		}
	*/
			
}
				


class themeswitch_form_ui extends e_admin_form_ui
{
	function switch_userclass($curval, $mode)
	{

		$dirs = e107::getFile()->get_dirs(e_THEME);

		sort($dirs);

		$default = e107::pref('core', 'sitetheme');

		$text = "<table class='table table-striped table-bordered'>";

	//	$cur = json_decode($curval);

		foreach($dirs as $theme)
		{
			$name = "switch_userclass[".$theme."]";

			$value = !empty($curval[$theme]) ? $curval[$theme] : false;

			if($theme == $default)
			{
				$text .= "<tr>
					<td>".$theme."</td><td><span class='label label-warning'>Default</a></td></tr>";
			}
			else
			{
				$text .= "<tr>
					<td>".$theme."</td><td>".$this->userclass($name,$value,'dropdown','options=nobody,admin,main,classes,no-excludes')."</td></tr>";

			}


		}

		$text .= "</table>";

		return $text;




	}

	function switch_style($curval, $mode)
	{
		$default = e107::pref('core', 'sitetheme');



		return $this->checkboxes('switch_language', $list, $curval, array('useKeyValues'=>1));


	}
}		
		
		
new themeswitch_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>