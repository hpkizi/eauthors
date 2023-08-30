<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P'))
{
	e107::redirect('admin');
	exit;
}


e107::lan('elanguages', "lang_admin");
e107::lan('elanguages', true);

if (!defined("UN_TABLENAME_AUTHORS"))  define("UN_TABLENAME_AUTHORS",  "unnuke_authors");
if (!defined("UN_TABLENAME_MODULES"))  define("UN_TABLENAME_MODULES",  "unnuke_modules");
if (!defined("UN_TABLENAME_STORIES"))  define("UN_TABLENAME_STORIES",  "unnuke_stories");


define("USRLAN_251", "Leave blank for no change");
//fix for checkboxes look */

$ret  = "  
#admin-ui-edit .checkbox-inline {min-width: 300px;}
#admin-ui-edit  .checkbox-inline  {margin-left: 20px!important; } 
 
 ";

e107::css("inline", $ret);

class eauthors_adminArea extends e_admin_dispatcher
{

	protected $modes = array(

		'main'	=> array(
			'controller' 	=> 'unnuke_authors_ui',
			'path' 			=> null,
			'ui' 			=> 'unnuke_authors_form_ui',
			'uipath' 		=> null
		),


	);


	protected $adminMenu = array(

		'main/list'			=> array('caption' => _EDITADMINS, 'perm' => 'P'),
		'main/create'		=> array('caption' => _ADDAUTHOR, 'perm' => 'P'),

	    'main/div0'      => array('divider'=> true),
		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P'),
		'main/prefs'		=> array('caption' => LAN_OPTIONS, 'perm' => '0'),
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'
	);

	protected $menuTitle = 'Authors';
}





class unnuke_authors_ui extends e_admin_ui
{

	protected $pluginTitle		= _AUTHORSADMIN;
	protected $pluginName		= 'eauthors';
	//	protected $eventName		= 'eauthors-unnuke_authors'; // remove comment to enable event triggers in admin. 		
	protected $table			= 'unnuke_authors';
	protected $pid				= 'uid';
	protected $perPage			= 20;
	protected $batchDelete		= true;
	protected $batchExport     = true;
	protected $batchCopy		= true;

	//	protected $sortField		= 'somefield_order';
	//	protected $sortParent      = 'somefield_parent';
	//	protected $treePrefix      = 'somefield_title';

	//	protected $tabs				= array('tab1'=>'Tab 1', 'tab2'=>'Tab 2'); // Use 'tab'=>'tab1'  OR 'tab'=>'tab2' in the $fields below to enable. 

	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.

	protected $listOrder		= 'uid ASC';

	protected $fields 		= array(
		'checkboxes'              => array('title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => 'value', 'class' => 'center', 'toggle' => 'e-multiselect', 'readParms' => [], 'writeParms' => [],),
		'uid'                     => array('title' => 'Uid', 'type' => 'number', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
		
		'user_id' =>  array('title' => LAN_USER, 'type' => 'dropdown', 'data' => 'int', 'readParms' => [], 'writeParms' => ['default' => '']   ),  

		'aid'                     => array(
			'title' => _ADMINID,
			'type' => 'method', 'data' => 'safestr', 'width' => 'auto', 'validate' => true, 'help' => _REQUIRED, 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',
		),

		'name'                    => array(
			'title' => _UN_AUTHORS_LOGIN, 'type' => 'method',
			'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'validate' => true, 'help' => _REQUIREDNOCHANGE, 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',
		),
		'url'                     => array('title' => _URL, 'type' => 'url', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => '', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
		'email'                   => array('title' => _EMAIL, 'type' => 'email', 'data' => 'safestr', 'width' => 'auto', 'inline' => true, 'help' => _REQUIRED, 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
		'pwd'                     => array('title' => LAN_PASSWORD, 'type' => 'method', 'data' => 'safestr', 'width' => 'auto', 'help' => '', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
		'counter'                 => array('title' => 'Counter', 'type' => 'number', 'data' => 'int', 'noedit' => true, 'width' => 'auto', 'help' => '', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
		'radminsuper'             => array('title' => _SUPERUSER, 'type' => 'method', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
		'admlanguage'             => array(
			'title' => _LANGUAGES, 'type' => 'method',
			'data' => 'safestr', 'width' => 'auto', 'help' => '', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',
			'filter' => false, 'batch' => false,
		),
		'auth_modules'			  => array('title' => _PERMISSIONS, 'type' => 'method', 'data' => false),
		'admincreated'            => array('title' => LAN_EFAU_INPUTBYADMIN, 'type' => 'boolean', 'data' => 'int', 'width' => 'auto', 'help' => '', 'readParms' => [], 'writeParms' => [], 'class' => 'left', 'thclass' => 'left',),
		'options'                 => array('title' => _FUNCTIONS, 'type' => 'method', 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => 'value', 'readParms' => [], 'writeParms' => [],),
	);

	protected $fieldpref = array('name', 'radminsuper', 'admlanguage', 'admincreated');


	//	protected $preftabs        = array('General', 'Other' );
	protected $prefs = array(
		'userlist' => array("title"=> "Limit authors as e107 users", "type"=> "boolean", "data"=>"int", 
					"help"=>"With ON author name will be limited to e107 user list. OFF - manually entered name")
	);


	public function init()
	{
		
		$users = e107::getForm()->userlist('aid', null, array('return' => 'array'));
		$this->fields['user_id']['writeParms']['optArray'] = $users;

		// Set drop-down values (if any). 
		//	$this->fields['admlanguage']['writeParms']['optArray'] = array('admlanguage_0','admlanguage_1', 'admlanguage_2'); // Example Drop-down array. 

	}

	private function beforePassword($new_data, $old_data, $id = NULL)
	{

		$tp = e107::getParser();

		if (empty($new_data['pwd']))
		{
			$new_data['pwd'] = $old_data['pwd'];
		}
		else
		{

			$savePassword = $new_data['pwd'];

			$new_data['pwd'] = md5($savePassword);
		}
 
		return $new_data;
	}

	private function beforeAuthModules($new_data, $old_data, $id = NULL)
	{
 
		$chng_name = $new_data['name'];
		$old_name = $old_data['name'];
		$auth_modules = $new_data['auth_modules'];
		$rows = e107::getDb()->retrieve("SELECT mid, admins FROM #" . UN_TABLENAME_MODULES, true);
		/* create at first rights without this user */
		foreach($rows AS $row) {
			$admins = explode(",", $row['admins']);
			$adm = "";
			for ($a = 0; $a < sizeof($admins); $a++)
			{
				if ($admins[$a] != $chng_name and $admins[$a] != "" and $admins[$a] != $old_name)
				{
					$adm .= $admins[$a] . ",";
				}
			}
			e107::getDb()->gen("UPDATE #" . UN_TABLENAME_MODULES . " SET admins='" . $adm . "' WHERE mid='" . $row['mid'] . "'");
		}

		/* create new rights */
		if (is_array($auth_modules))
		{
			for ($i = 0; $i < sizeof($auth_modules); $i++)
			{
				$row = e107::getDb()->retrieve("SELECT mid, admins FROM #" . UN_TABLENAME_MODULES . " WHERE mid='" . $auth_modules[$i] . "'");
	
				$admins = explode(",", $row['admins']);
				for ($a = 0; $a < sizeof($admins); $a++)
				{
					if ($admins[$a] == $chng_name)
					{
						$dummy = 1;
					}
				}
				if ($dummy != 1)
				{
					$adm = $row['admins'] . $chng_name;
					e107::getDb()->gen("UPDATE #" . UN_TABLENAME_MODULES . " SET admins='" . $adm . ",' WHERE mid='" . $auth_modules[$i] . "'");
				}
				$dummy = "";
			}
		}
	}	

	// ------- Customize Create --------

	public function beforeCreate($new_data, $old_data)
	{
		$new_data = $this->beforePassword($new_data, $old_data);
		$new_data = $this->beforeAuthModules($new_data, $old_data);
		return $new_data;
	}

	/**
	 * User defined pre-delete logic  'etrigger_delete[' . $id . ']',
	 */

	public function beforeDelete($data, $id)
	{
		$mes = e107::getMessage();

		$del_aid = $data['aid'];

		$text = "";
		$stories = "";

		$sids = e107::getDb()->retrieve("SELECT sid FROM #" . UN_TABLENAME_STORIES . " WHERE aid='" . $del_aid . "'", true);
		foreach ($sids as $sid)
		{
			$stories .=  $sid['sid'] . ", ";
		}

		if ($sid != "")
		{
			$text = "<b>" . _PUBLISHEDSTORIES . "</b>: " . $stories . " ";
			$mes->addError($text);
			return false;
		}

		if ($data['name'] == "God")
		{
			$text =   _MAINACCOUNT;
			$mes->addError($text);
			return false;
		}

		/* remove access from modules */
		$rows = e107::getDb()->retrieve("SELECT mid, admins FROM " . UN_TABLENAME_MODULES);
		foreach ($rows as $row)
		{
			$admins = explode(",", $row['admins']);
			$adm = "";
			for ($a = 0; $a < sizeof($admins); $a++)
			{
				if ($admins[$a] != $del_aid and $admins[$a] != "")
				{
					$adm .= $admins[$a] . ",";
				}
			}
			e107::getDb()->gen("UPDATE " . UN_TABLENAME_MODULES . " SET admins='" . $adm . "' WHERE mid='" . $row['mid'] . "'");
		}

		$mes->addSuccess("Author was succesfully removed from modules administration");
		return true;

		//return true;
	}

	// ------- Customize Update --------

	public function beforeUpdate($new_data, $old_data, $id)
	{
 
		$new_data = $this->beforePassword($new_data, $old_data);
		 
		$this->beforeAuthModules($new_data, $old_data);
 
		return $new_data; 
	}

	public function afterCreate($new_data, $old_data, $id)
	{
		$auth_modules = $new_data['auth_modules'];
		if(is_array($auth_modules)) {
			$add_name = $new_data['name'];
			for ($i = 0; $i < sizeof($auth_modules); $i++)
			{
				$row = e107::getDb()->retrieve("SELECT admins, mid FROM " . UN_TABLENAME_MODULES . " WHERE mid='" . $auth_modules[$i] . "'");
				$adm = $row['admins'] . $add_name;
				e107::getDb()->gen("UPDATE " . UN_TABLENAME_MODULES . " SET admins='" . $adm . ",' WHERE mid='" . $auth_modules[$i] . "'");
			}
		}

		// do something
	}

	public function onCreateError($new_data, $old_data)
	{
		// do something		
	}

	public function afterUpdate($new_data, $old_data, $id)
	{
		// do something
		
	}

	public function onUpdateError($new_data, $old_data, $id)
	{
		// do something		
	}

	// left-panel help menu area. (replaces e_help.php used in old plugins)
	public function renderHelp()
	{
		$caption = LAN_HELP;
		$text = "";
		switch ($this->getAction())
		{
			case  "list":
				$text = _GODNOTDEL;;
				break;
			case  "create":
				break;
			case  "edit":
				break;
		}


		return array('caption' => $caption, 'text' => $text);
	}
}



class unnuke_authors_form_ui extends e_admin_form_ui
{

	function admlanguage($curVal, $mode, $parm)
	{
		$action = $this->getController()->getAction();
		$text = "";
		//not supported yet
		if ($mode == 'read')
		{
			$text = _ALL;
		}
		if ($mode == 'write')
		{

			$text .= $this->renderElement('admlanguage', $curVal, array('type' => 'hidden'));
		}
		return $text;
	}

	function radminsuper($curVal, $mode, $parm)
	{
		$name = $this->getController()->getFieldVar('name');
		$text = "";

		if ($name != "God") {
			$sel1 = 1;
		}
		$sel1 = $curVal;

		if ($mode == 'read')
		{
			$text .= $this->renderValue('radminsuper', $sel1, array('type' => 'boolean'));
		}

		if ($mode == "write") {
			$text .= $this->renderElement('radminsuper', $sel1, array('type' => 'boolean'));
			$text .= "<br><i>" . _SUPERWARNING . "</i>";
		}


		return $text;

	}

	function aid($curVal, $mode, $parm)
	{
		$action = $this->getController()->getAction();

		if ($mode == 'read')
		{
			$a_aid = $curVal;

			$name =$this->getController()->getFieldVar('name');

			if ($name == "God")
			{
				return $a_aid . " <i>(" . _MAINACCOUNT . ")</i>";
			}
			else
			{
				return $a_aid;
			}
		}
		if ($mode == 'write')
		{
			$text  = '';
			if ($action == 'create')
			{
 
				
				$text .= $this->renderElement('aid', $curVal, array(
					'type' => 'text', 'writeParms' => ['maxlength' => 30, 'size' => 30],
					));
				
				 
			}
			else
			{
				$name = $this->getController()->getFieldVar('name');
				$text .= $this->renderElement('aid', $curVal, array(
					'type' => 'text', 'writeParms' => ['maxlength' => 30, 'size' => 30],
				));

				$text .= $this->renderElement('name', $curVal, array('type' => 'hidden'));
			}

			return $text;
		}
	}
 

	function name($curVal, $mode, $parm)
	{

		$action = $this->getController()->getAction();
		$text = "";
		if ($mode == 'read')
		{
			$a_aid = $this->getController()->getListModel()->get('aid');

			$name = substr($curVal, 0, 25);

			if ($name == "God")
			{
				$text .=   $a_aid . " <i>(" . _MAINACCOUNT . ")</i> ";
			}
			else
			{
				$text .= " $a_aid  ";
			}
			return $curVal;
		}

		if ($mode == 'write')
		{
			$text  = '';
			if ($action == 'create')
			{

				$text .= $this->renderElement('name', $curVal, array('type' => 'text', 'writeParms' => ['maxlength' => 50, 'size' => 30],  'help' => _REQUIREDNOCHANGE));
			    $text .= "<br>". _REQUIREDNOCHANGE;
			}
			else
			{

				$text  = $curVal;
			}
			return $text;
		}
	}

	function auth_modules($curVal, $mode, $parm)
	{

		$action = $this->getController()->getAction();
		$text = '';
		$curVal = array();
		$values = array();
		if ($mode == "write")
		{

			$rows = e107::getDb()->retrieve("SELECT mid, title, admins FROM #" . UN_TABLENAME_MODULES . " ORDER BY title ASC", true);

			/* get list of available modules */
			foreach ($rows as  $row)
			{

				$title = str_replace("_", " ", $row['title']);
				if (
					file_exists(e_ROOT . "modules/" . $row['title'] . "/admin/index.php")
					and file_exists(e_ROOT . "modules/" . $row['title'] . "/admin/links.php")
					and file_exists(e_ROOT . "modules/" . $row['title'] . "/admin/case.php")
				)
				{
					$values[$row['mid']] = $title;
				}
			}
 
 
			if ($action == 'create')
			{
				$curVal = array(); /* nothing is checked */
				if($values) {
					$text .= $this->renderElement('auth_modules', $curVal, array('type' => 'checkboxes', 'writeParms' => [
						'optArray' => $values,
						'inline' => true,  'useKeyValues' => 1
					]));
				}
				else {
					$text .= "No modules";
				}
			}
			elseif($action == 'edit') 
			{

				$author['name'] = $this->getController()->getFieldVar('name');

				if ($author['name'] != "God")
				{

					foreach ($rows as  $row)
					{
	 
						$admins = explode(",", $row['admins']);
						$sel = "";
						for ($i = 0; $i < sizeof($admins); $i++)
						{
		 
							if ($author['name'] == $admins[$i])
							{
								$curVal[] = $row['mid'];
							}
						}
					}
 
					$curVal = implode(",",$curVal);
					if ($values)
					{
						$text .= $this->renderElement('auth_modules', $curVal, array('type' => 'checkboxes', 'writeParms' => [
							'optArray' => $values,
							'inline' => true,  'useKeyValues' => 1
						]));
					}
					else {
						$text .= "No modules";
					}
				}
				else {
					$sel1 = "checked";
					$text .= $this->renderElement('auth_modules[]', $sel1, array('type' => 'hidden'));  
				}
 
			}

		}
		return $text;
	}

	function pwd($curval, $mode)
	{
	 
		if ($mode == 'read')
		{
			if (empty($curval))
			{
				return "No password!";
			}

			// if(getperms('0'))
			{

				$type = e107::getUserSession()->getHashType($curval, 'array');

				$num = $type[0];

				$styles = array(0 => 'label-danger', 1 => 'label-warning', 3 => 'label-success');

				return "<span class='label label-password " . $styles[$num] . "'>md5</span>";
			}
		}
		if ($mode == 'write')
		{

			return $this->password('pwd', '', 128, array('size' => 50, 'class' => 'tbox e-password', 
			'placeholder' => USRLAN_251, 'generate' => 1, 'strength' => 1, 'required' => 0, 'autocomplete' => 'new-password'));
		}
	}


	function options($parms, $value, $id, $attributes)
	{
		$tp = e107::getParser();

		if ($attributes['mode'] == 'read')
		{
			parse_str(str_replace('&amp;', '&', e_QUERY), $query); //FIXME - FIX THIS
			$query['action'] = 'edit';
			$query['id'] = $id;
			$query = http_build_query($query, '', '&amp;');

			$text = "<a href='" . e_SELF . "?{$query}' class='action btn btn-success' title='" . LAN_EDIT . "' data-toggle='tooltip' data-bs-toggle='tooltip' data-placement='left'>
						" . $tp->toIcon('fa-edit.glyph') . "</a>";

			$name = $this->getController()->getListModel()->get('name');

			if ($name == "God")
			{
				$text .= "";
			}
			else
			{

				/* 
				<button type="submit" name="menu_delete[2]" data-placement="left" value="2" id="menu-delete-2-2" class="action delete btn btn-danger" title="Delete [ ID: 2 ]" data-confirm="Are you sure?"><i class="fa fa-trash-alt"></i></button>
				*/
				$text .= $this->submit_image(
					'etrigger_delete[' . $id . ']',
					$id,
					'delete',
					LAN_DELETE . ' [ ID: ' . $id . ' ]',
					array('class' => 'action delete btn btn-danger ', 'icon' => $tp->toIcon('fa-trash.glyph'))
				);
			}
			return $text;
		}
	}
}


new eauthors_adminArea();

require_once(e_ADMIN . "auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN . "footer.php");
exit;
