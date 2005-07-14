<?php
/**
 * $Horde: shout/users/add.php,v 1.0 2005/07/14 01:06:48 ben Exp $
 *
 * Copyright 2005 Ben Klang <ben@alkaloid.net>
 *
 * See the enclosed file LICENSE for license information (GPL). If you
 * did not receive this file, see http://www.horde.org/licenses/gpl.php.
 */
@define('SHOUT_BASE', dirname(__FILE__) . '/..');
require_once SHOUT_BASE . '/lib/User.php';
require_once 'Horde/Variables.php';

$RENDERER = &new Horde_Form_Renderer();

$empty = '';
$wereerrors = 0;

$vars = &Variables::getDefaultVariables($empty);
$formname = $vars->get('formname');

$title = _("System Settings");

$UserDetailsForm = &Horde_Form::singleton('UserDetailsForm', $vars);
$UserDetailsFormValid = $UserDetailsForm->validate($vars, true);

$UserDetailsForm->open($RENDERER, $vars, 'index.php', 'post');
$UserDetailsForm->preserveVarByPost($vars, "section");
$UserDetailsForm->preserve($vars);
$RENDERER->beginActive($UserDetailsForm->getTitle());
$RENDERER->renderFormActive($UserDetailsForm, $vars);
$RENDERER->submit();
$RENDERER->end();
$UserDetailsForm->close($RENDERER);