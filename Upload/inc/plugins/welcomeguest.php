<?php
/*
 * MyBB: Welcome Guest
 *
 * File: welcomeguest.php
 * 
 * Authors: Sebastian Wunderlich & Vintagedaddyo & juventiner
 *
 * MyBB Version: 1.8
 *
 * Plugin Version: 1.7
 *
 * 
 */

// Disallow direct access to this file for security reasons

if(!defined("IN_MYBB"))
{
    die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

$plugins->add_hook('index_start','welcomeguest');
$plugins->add_hook('portal_start','welcomeguest');

function welcomeguest_info()
{
   global $lang;

    $lang->load("welcomeguest");
    
    $lang->welcomeguest_Desc = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="float:right;">' .
        '<input type="hidden" name="cmd" value="_s-xclick">' . 
        '<input type="hidden" name="hosted_button_id" value="AZE6ZNZPBPVUL">' .
        '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">' .
        '<img alt="" border="0" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" width="1" height="1">' .
        '</form>' . $lang->welcomeguest_Desc;

    return Array(
        'name' => $lang->welcomeguest_Name,
        'description' => $lang->welcomeguest_Desc,
        'website' => $lang->welcomeguest_Web,
        'author' => $lang->welcomeguest_Auth,
        'authorsite' => $lang->welcomeguest_AuthSite,
        'version' => $lang->welcomeguest_Ver,
        'compatibility' => $lang->welcomeguest_Compat
    );
}

function welcomeguest_activate()
{
	require_once MYBB_ROOT.'/inc/adminfunctions_templates.php';
	find_replace_templatesets('index','#'.preg_quote('{$welcomeguest}
').'#i','',0);
	find_replace_templatesets('portal','#'.preg_quote('{$welcomeguest}
').'#i','',0);
	find_replace_templatesets('index','#'.preg_quote('{$forums}').'#i','{$welcomeguest}
{$forums}');
	find_replace_templatesets('portal','#'.preg_quote('{$announcements}').'#i','{$welcomeguest}
{$announcements}');
}

function welcomeguest_deactivate()
{
	require_once MYBB_ROOT.'/inc/adminfunctions_templates.php';
	find_replace_templatesets('index','#'.preg_quote('{$welcomeguest}
').'#i','',0);
	find_replace_templatesets('portal','#'.preg_quote('{$welcomeguest}
').'#i','',0);
}

function welcomeguest_lang()
{
	global $lang;
	$lang->load("welcomeguest");
}

function welcomeguest()
{
	global $mybb;

	if($mybb->user['usergroup']==1)
	{
		global $theme,$lang,$welcomeguest;
		welcomeguest_lang();
		$welcomeguest='<table border="0" cellspacing="'.$theme['borderwidth'].'" cellpadding="'.$theme['tablespace'].'" class="tborder">
	<thead>
		<tr>
			<td class="thead">
				<strong>'.$lang->welcomeguest_header.'</strong>
			</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="trow1"><span class="smalltext">'.$lang->welcomeguest_message.'</span></td>
		</tr>
	</tbody>
</table>
<br />';
	}
}

?>