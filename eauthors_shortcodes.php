<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2008-2009 e107 Inc
|     http://e107.org
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
+----------------------------------------------------------------------------+
*/


if (!defined('e107_INIT'))
{
	exit();
}

//e107::plugLan('signin', null);

class plugin_eauthors_eauthors_shortcodes extends e_shortcode
{

	private $use_imagecode = 0;
	private $sec;
	private $usernamePlaceholder = LAN_SIGNIN_1;
	private $allowEmailLogin;
	private $authMethod;
	private $regMode;

	function __construct()
	{

		$pref = e107::getPref();

		$this->use_imagecode = e107::getConfig()->get('logcode');
		$this->sec = e107::getSecureImg();
		$this->usernamePlaceholder = '';
		$this->allowEmailLogin = $pref['allowEmailLogin'];

		if ($pref['allowEmailLogin'] == 1)
		{
			$this->usernamePlaceholder = LAN_SIGNIN_49;
		}

		if ($pref['allowEmailLogin'] == 2)
		{
			$this->usernamePlaceholder = LAN_SIGNIN_50;
		}

		$this->regMode = (int) defset('USER_REGISTRATION');

		$this->authMethod = vartrue($pref['auth_method'], 'e107');

	}


	/**
	 *
	 * @param array $parm
	 * @return null|string
	 */
	function sc_ea_active($parm = array())
	{

		//	$request = e_REQUEST_URI;

		$ret = null;

		$mode = varset($parm['mode']);

		if ($mode === 'settings' && defset('e_PAGE') === 'usersettings.php')
		{
			return 'active';
		}
		elseif ($mode === 'profile' && defset('e_PAGE') === 'user.php')
		{
			return 'active';
		}


		return null;
	}


	function sc_ea_input_username($parm = null)
	{

		$pref = e107::getPref();

		// If logging in with email address - ignore pref and increase to 100 chars.
		$maxLength = ($this->allowEmailLogin == 1 || $this->allowEmailLogin) ? 100 : varset($pref['loginname_maxlength'], 30);
		$class = (!empty($parm['class'])) ? "class='" . $parm['class'] . "'" : "form-control tbox login user";
		return "
				<label class='sr-only' for='" . vartrue($parm['idprefix']) . "username'>" . $this->usernamePlaceholder . "</label>
				<input {$class} type='text' name='username' placeholder='" . $this->usernamePlaceholder . "' required='required' id='" . vartrue($parm['idprefix']) . "username' size='15' value='' maxlength='" . $maxLength . "' />\n";
	}



	function sc_ea_username($parm=null)
	{
		return !empty($parm['username']) ? USERNAME : '';
	}


	function sc_ea_input_password($parm = null)
	{

		$pref = e107::getPref();
		$class = (!empty($parm['class'])) ? "class='" . $parm['class'] . "'" : "form-control tbox login pass";

		$t_password = "
				<label class='sr-only' for='" . vartrue($parm['idprefix']) . "userpass'>" . LAN_PASSWORD . "</label>
				<input {$class} type='password' placeholder='" . LAN_PASSWORD . "' required='required' name='userpass' id='" . vartrue($parm['idprefix']) . "userpass' size='15' value='' maxlength='30' />\n";

		if (!USER && e107::getSession()->is('challenge') && varset($pref['password_CHAP'], 0))
		{
			$t_password .= "<input type='hidden' name='hashchallenge' id='hashchallenge' value='" . e107::getSession()->get('challenge') . "' />\n\n";
		}

		return $t_password;
	}


	function sc_ea_password_label($parm = '')
	{
		return LAN_SIGNIN_2;
	}


	function sc_ea_imagecode_number($parm = '')
	{

		if ($this->use_imagecode)
		{
			return e107::getSecureImg()->renderImage();
		}

		return null;
	}

	function sc_ea_form($parm=null)
	{
		return ($parm === 'start') ? '<form method="post" onsubmit="hashLoginPassword(this);return true" action="'.e_REQUEST_HTTP.'" accept-charset="UTF-8">' : '</form>';
	}

	function sc_ea_imagecode_box($parm = '')
	{

		if ($this->use_imagecode)
		{
			return e107::getSecureImg()->renderInput();
		}

		return null;
	}



	function sc_ea_rememberme($parm = '')
	{

		$pref = e107::getPref();
		if ($parm == "hidden")
		{
			return "<input type='hidden' name='autologin' id='autologin' value='1' />";
		}
		if (varset($pref['user_tracking']) !== "session")
		{
			return "<input type='checkbox' name='autologin' id='autologin' value='1' checked='checked' />" . ($parm ? $parm : "" . LAN_SIGNIN_6 );
		}

		return null;
	}

	function sc_ea_signup_href($parm = '')
	{

		if ($this->regMode !== 1 || $this->authMethod !== 'e107')
		{
			return null;
		}

		return e_SIGNUP;

	}

	function sc_ea_login_href($parm = '')
	{

		if ($this->regMode == 0 )
		{
			return null;
		}

		return e_LOGIN;

	}
	
	function sc_ea_resend_href($parm=null)
	{
		if ($this->regMode !== 1 || $this->authMethod !== 'e107')
		{
			return null;
		}

		return e_SIGNUP . '?resend';
	}



	function sc_ea_fpw_href($parm=null)
	{
		return SITEURL . 'fpw.php';
	}


	function sc_ea_maintenance($parm = '')
	{

		$pref = e107::getPref();

		if (ADMIN && !empty($pref['maintainance_flag']))
		{
			return LAN_SIGNIN_10;
		}

		return '';
	}


	function sc_ea_pm_nav($parm=null)
	{
		if(!e107::isInstalled('pm') )
		{
			return null;
		}

		$sc = e107::getScBatch('pm', true);

		return $sc->sc_pm_nav($parm);;


	}

	/* {EA_ADMIN_HREF} */
	function sc_ea_admin_href($parm = '')
	{
		// '<li><a href="'.e_ADMIN_ABS.'"><span class="fa fa-cogs"></span> '.LAN_SIGNIN_11.'</a></li>';
		if (ADMIN == true)
		{
			return  e_ADMIN_ABS; //  . 'admin.php' : '<a class="signin-sc admin" id="signin-sc-admin" href="' . e_ADMIN_ABS . 'admin.php">' . LAN_SIGNIN_11 . '</a>';
		}

		return null;
	}


	function sc_ea_usersettings_href($parm = null)
	{
		return e107::getUrl()->create('user/myprofile/edit', array('id' => USERID));
	}


	/**
	 * @todo- to be merged with sc_signin_profile() ?
	 * @param string $parm
	 * @return string
	 */
	function sc_ea_profile_href($parm = '')
	{
		return e107::getUrl()->create('user/profile/view', array('user_id' => USERID, 'user_name' => USERNAME));
	}



	function sc_ea_logout_href($parm = '')
	{
		return e_HTTP . 'index.php?logout';
	}



}


