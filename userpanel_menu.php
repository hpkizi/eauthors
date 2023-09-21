<?php

/*
* Copyright (c) e107 Inc e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
* $Id: e_shortcode.php 12438 2011-12-05 15:12:56Z secretr $
*
* Featurebox shortcode batch class - shortcodes available site-wide. ie. equivalent to multiple .sc files.
*/

if (!defined('e107_INIT'))
{
    exit;
}

$text = '';

// START LOGGED CODE
if (USER == TRUE || ADMIN == TRUE)
{

    $sc = e107::getScBatch('eauthors', 'eauthors');

    $template = e107::getTemplate('eauthors', 'userpanel', 'signout');
 
    $sc->wrapper('userpanel');
    $caption = e107::getParser()->parseTemplate($template['caption'], true, $sc);
    $text = e107::getParser()->parseTemplate($template['panel'], true, $sc);

    e107::getRender()->tablerender($caption, $text, 'login');
}
else
{

}

 


 