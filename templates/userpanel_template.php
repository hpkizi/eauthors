<?php

// Do not use constants.. use {LAN=xxx} instead.
// Template compatible with Bootstrap 5 only.

$USERPANEL_TEMPLATE = [];


$USERPANEL_WRAPPER['signin']['SIGNIN_SIGNUP_HREF'] = '<li class="nav-item"><a class="nav-link" href="{---}">{LAN=SIGNIN_3}</a></li>';

$USERPANEL_TEMPLATE['signin'] = '
			<ul class="navbar-nav nav-right">
				{SIGNIN_SIGNUP_HREF}
				<li class="divider-vertical"></li>
				<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" data-toggle="dropdown">{LAN=SIGNIN_51} <strong class="caret"></strong></a>
					<div class="dropdown-menu col-sm-12" style="min-width:250px; padding: 15px; padding-bottom: 0px;">
					
					{SIGNIN_FORM=start}
					<p>{SIGNIN_INPUT_USERNAME}</p>
					<p>{SIGNIN_INPUT_PASSWORD}</p>
	
					<div class="form-group"></div>
					{SIGNIN_IMAGECODE_NUMBER}
					{SIGNIN_IMAGECODE_BOX}
					
					<div class="checkbox">		
					<label class="string optional" for="bs3-autologin"><input style="margin-right: 10px;" type="checkbox" name="autologin" id="bs3-autologin" value="1">
					{LAN=SIGNIN_6}</label>
					</div>
					<div class="d-grid gap-2" style="padding-bottom:15px">
					<input class="btn btn-primary btn-block" type="submit" name="userlogin" id="bs3-userlogin" value="{LAN=SIGNIN_51}">			
					<a href="{SIGNIN_FPW_HREF}" class="btn btn-default btn-secondary btn-sm  btn-block">{LAN=SIGNIN_4}</a>
					<a href="{SIGNIN_RESEND_LINK=href}" class="btn btn-default btn-secondary btn-sm  btn-block">{LAN=SIGNIN_40}</a>
					</div>
					{SIGNIN_FORM=end}
					</div>
				
				</li>
	
			</ul>';


/*
<li><a href="jobs-my-resume.html">
<i class="far fa-file-alt" aria-hidden="true"></i> 
<span>My Resume</span></a></li>
*/
$USERPANEL_WRAPPER['EA_ADMIN_HREF'] = '<li>
<a href="{---}">
<i class="fa fa-cogs" aria-hidden="true"></i>{LAN=SIGNIN_11}</a></li>';
$USERPANEL_WRAPPER['EA_MAINTENANCE'] = '<div class="alert alert-danger">{---}</div> '
;
$USERPANEL_WRAPPER['signout']['SIGNIN_PM_NAV'] = '<li class="dropdown dropdown-pm">{---}</li>';

 
$USERPANEL_TEMPLATE['signout']['panel'] = ' 
{EA_MAINTENANCE}
	<ul>
		
		{EA_ADMIN_HREF}
		<li>
			<a href="{EA_USERSETTINGS_HREF}"><span class="fa fa-cog"></span> {LAN=LAN_SETTINGS}</a>
		</li>
		<li>
			<a href="{EA_PROFILE_HREF}"><span class="far fa-user"></span> {LAN=SIGNIN_13}</a>
		</li>
		<li>
			<a href="{EA_LOGOUT_HREF}"><span class="fas fa-sign-out-alt"></span> {LAN=LAN_LOGOUT}</a></li>
 
	</ul>
 
		';

$USERPANEL_TEMPLATE['signout']['caption'] = '
<div class="candidate-detail text-center">
	<div class="canditate-des">
		{USER_AVATAR: w=500&h=500&crop=1&shape=circle}
	</div>
	<div class="candidate-title">
		<div class="">
			<h4 class="m-b5">'.USERNAME. ' </h4>
			<p class="m-b0"> Web developer </p>
		</div>
	</div>
</div>';