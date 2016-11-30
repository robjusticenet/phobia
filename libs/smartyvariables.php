<?php

if(!defined('mnminclude')){header('Location: ../error_404.php');die();}

include mnminclude.'extra_fields_smarty.php';

$main_smarty->compile_dir = mnmpath."cache/";
$main_smarty->template_dir = mnmpath."templates/";
$main_smarty->cache_dir = mnmpath."cache/";
//global $current_user;

// determine if we're in root or another folder like admin
if(!defined('lang_loc')){
	$pos = strrpos($_SERVER["SCRIPT_NAME"], "/");
	$path = substr($_SERVER["SCRIPT_NAME"], 0, $pos);
	if ($path == "/"){$path = "";}
	
	if($path != my_kliqqi_base){
		define('lang_loc', '..');
	} else {
		define('lang_loc', '.');
	}
}

// Check if a .maintenance file exists in the Kliqqi root directory
$maintenance_file = "./.maintenance";
if(file_exists($maintenance_file)){
	$main_smarty->assign('maintenance_mode', 'true');
} else {
	$main_smarty->assign('maintenance_mode', 'false');
}

$main_smarty->config_dir = "";
$main_smarty->force_compile = false; // has to be off to use cache
$main_smarty->config_load(lang_loc . "/languages/lang_" . kliqqi_language . ".conf");

if(isset($_GET['id']) && is_numeric($_GET['id'])){$main_smarty->assign('request_id', $_GET['id']);}
if(isset($_GET['category']) && sanitize($_GET['category'], 3) != ''){$main_smarty->assign('request_category', sanitize($_GET['category'], 3));}
if(isset($_GET['search']) && sanitize($_GET['search'], 3) != ''){$main_smarty->assign('request_search', sanitize($_GET['search'], 3));}
if(isset($_POST['username']) && sanitize($_POST['username'], 3) != ''){$main_smarty->assign('login_username', sanitize($_POST['username'], 3));}

$main_smarty->assign('votes_per_ip', votes_per_ip);
$main_smarty->assign('dblang', $dblang);
$main_smarty->assign('kliqqi_language', kliqqi_language);
$main_smarty->assign('user_logged_in', $current_user->user_login);
$main_smarty->assign('user_id', $current_user->user_id);
if ($current_user->authenticated == true) {
	$main_smarty->assign('user_level', $current_user->user_level);
	$current_user_level = $current_user->user_level; /* Redwine: user_level is not part oof the $current_user array when user is not auhtenticated (logged in), hence this variable to be used on line 74. otherwise, generating a Notice in case user is not authenticated. */
}else{
	$main_smarty->assign('user_level', "");
	$current_user_level = ''; /* Redwine: user_level is not part oof the $current_user array when user is not auhtenticated (logged in), hence this variable to be used on line 74. otherwise, generating a Notice in case user is not authenticated. */
}
$main_smarty->assign('user_authenticated', $current_user->authenticated);
$main_smarty->assign('Enable_Tags', Enable_Tags);
$main_smarty->assign('Enable_Live', Enable_Live);
$main_smarty->assign('Voting_Method', Voting_Method);
$main_smarty->assign('my_base_url', my_base_url);
$main_smarty->assign('my_kliqqi_base', my_kliqqi_base);
$main_smarty->assign('Allow_User_Change_Templates', Allow_User_Change_Templates);
$main_smarty->assign('urlmethod', urlmethod);
$main_smarty->assign('UseAvatars', do_we_use_avatars());
$main_smarty->assign('Allow_Friends', Allow_Friends);
$main_smarty->assign('Pager_setting', Auto_scroll);

if($current_user->user_login){
	$main_smarty->assign('Current_User_Avatar', $avatars = get_avatar('all', "", "", "", $current_user->user_id));
	$main_smarty->assign('Current_User_Avatar_ImgSrc', $avatars['small']);
}

//groups
$main_smarty->assign('enable_group', enable_group);
$main_smarty->assign('group_submit_level', group_submit_level);
$group_submit_level = group_submit_level;
if(group_submit_level == $current_user_level || group_submit_level == 'normal' || $current_user_level == 'admin')
	$main_smarty->assign('group_allow', 1);

$main_smarty->assign('SearchMethod', SearchMethod);
$main_smarty = SetSmartyURLs($main_smarty);
if ($main_smarty->get_template_vars('tpl_center'))
    $main_smarty->display('blank.tpl');
$the_template = The_Template;
$main_smarty->assign('the_template', The_Template);
$main_smarty->assign('tpl_head', $the_template . '/head');
$main_smarty->assign('tpl_body', $the_template . '/body');
$main_smarty->assign('tpl_first_sidebar', $the_template . '/sidebar');
$main_smarty->assign('tpl_second_sidebar', $the_template . '/sidebar2');
$main_smarty->assign('tpl_header', $the_template . '/header');
$main_smarty->assign('tpl_footer', $the_template . '/footer');

// Admin Template
$main_smarty->assign('tpl_header_admin', '/header');

//remove this after we eliminate the need for do_header
$canIhaveAccess = 0;
$canIhaveAccess = $canIhaveAccess + checklevel('admin');
if($canIhaveAccess == 1){$main_smarty->assign('isadmin', 1);}
$canIhaveAccess = $canIhaveAccess + checklevel('moderator');
if($canIhaveAccess == 1){$main_smarty->assign('isadmin', 1);}

/* Redwine: I removed the block of code that was before this and which runs 3 queries and added the below block with only one query. */

/* Redwine: all submissions status. Also added a varibale to hold the total of published and new to be used in the sidebar stats module */
$sidebar_stats_stories = 0;
$stats = $db->get_results('select link_status, count(*) total from '.table_links. ' group by link_status');
$total_submissions = 0;
$published_submissions_count = 0;
$new_submissions_count = 0;
$moderated_submissions_count = 0;
$abuse_submissions_count = 0;
$discarded_submissions_count = 0;
$duplicate_submissions_count = 0;
$page_submissions_count = 0;
$spam_submissions_count = 0;
if ($stats) {
	foreach($stats as $row) {
		if ($row->link_status == 'published') {
			$published_submissions_count = $row->total;
			$main_smarty->assign('published_submissions_count', $published_submissions_count);
			$total_submissions += $row->total;
			$sidebar_stats_stories += $row->total;
		}elseif ($row->link_status == 'new') {
			$new_submissions_count = $row->total;
			$main_smarty->assign('new_submissions_count', $new_submissions_count);
			$total_submissions += $row->total;
			$sidebar_stats_stories += $row->total;
		}elseif ($row->link_status == 'moderated') {
			$moderated_submissions_count = $row->total;
			$main_smarty->assign('moderated_submissions_count', $moderated_submissions_count);
			$total_submissions += $row->total;
		}elseif ($row->link_status == 'abuse') {
			$abuse_submissions_count = $row->total;
			$main_smarty->assign('abuse_submissions_count', $abuse_submissions_count);
			$total_submissions += $row->total;
		}elseif ($row->link_status == 'discard') {
			$discarded_submissions_count = $row->total;
			$main_smarty->assign('discarded_submissions_count', $discarded_submissions_count);
			$total_submissions += $row->total;
		}elseif ($row->link_status == 'duplicate') {
			$duplicate_submissions_count = $row->total;
			$main_smarty->assign('duplicate_submissions_count', $duplicate_submissions_count);
			$total_submissions += $row->total;
		}elseif ($row->link_status == 'page') {
			$page_submissions_count = $row->total;
			$main_smarty->assign('page_submissions_count', $page_submissions_count);
			$total_submissions += $row->total;
		}elseif ($row->link_status == 'spam') {
			$spam_submissions_count = $row->total;
			$main_smarty->assign('spam_submissions_count', $spam_submissions_count);
			$total_submissions += $row->total;
		}
	}
}
$main_smarty->assign('total_submissions', $total_submissions);
$main_smarty->assign('sidebar_stats_stories', $sidebar_stats_stories);
/* Redwine: all user levels */
$users_total = 0;
/* Redwine: added a variable to hold the total of active users that will be used in the sidebar stats module */
$sidebar_stats_members = 0;
$moderated_users_count = 0;
$spammer_users_count = 0;
$admin_users_count = 0;
$moderator_users_count = 0;
$normal_users_count = 0;
$usersstats = $db->get_results("select  user_level, count(*) as TTL, 'DISABLED' as LEVEL from " . table_users. " where (user_level = 'normal' OR user_level = 'Spammer') AND user_enabled=0 group by user_level, user_enabled UNION select user_level, count(*) as ENB, 'ENABLED' as LEVEL
from " . table_users . " where user_enabled = 1 group by user_level, user_enabled");
foreach($usersstats as $user) {
	if ($user->LEVEL == 'DISABLED' && $user->user_level == 'normal') {
		$moderated_users_count = $user->TTL;
		$main_smarty->assign('moderated_users_count', $moderated_users_count);
		$users_total += $user->TTL;
	}elseif ($user->LEVEL == 'DISABLED' && $user->user_level == 'Spammer') {	
		$spammer_users_count = $user->TTL;
		$main_smarty->assign('spammer_users_count', $spammer_users_count);
		$users_total += $user->TTL;
	}elseif ($user->LEVEL == 'ENABLED') {
		$tempVariable = "$".$user->user_level . "_users_count";
		$smartyTempVariable  = str_replace("$", "", $tempVariable);
		$tempVariable = $user->TTL;
		$main_smarty->assign($smartyTempVariable, $tempVariable);
		$users_total += $user->TTL;
		$sidebar_stats_members += $user->TTL;
	}
}
$main_smarty->assign('users_total', $users_total);
$main_smarty->assign('sidebar_stats_members', $sidebar_stats_members);
/* Get the last user to sign up */
/* Redwine: Changed the query to get the last legitimate (excluding spammers) user to sign up */
$last_user = $db->get_var("SELECT user_login FROM " . table_users . " where user_level != 'Spammer' ORDER BY user_id DESC LIMIT 1");
$main_smarty->assign('last_user', $last_user); 
/* Redwine: added the query to get the version and removed 16 duplicate queries from all admin and some other files */
// read the mysql database to get the kliqqi version
$kliqqi_version = kliqqi_version();
$main_smarty->assign('version_number', $kliqqi_version); 
/* Redwine: redundant query */
/*// Count variable for moderated comments
$moderated_comments_count = $db->get_var('SELECT count(*) from ' . table_comments . ' where comment_status = "moderated";');
$main_smarty->assign('moderated_comments_count', $moderated_comments_count);*/
/* Redwine: get the votes count breakdown by vote type (links, comments) and vote value (upvote & downvote */
$all_votes = $db->get_results('SELECT `vote_type`, count(*) total, `vote_value` FROM ' .table_votes. ' group by `vote_type`, `vote_value`');
$votes = 0;
$upvote_links_count = 0;
$downvote_links_count = 0;
$upvote_comments_count = 0;
$downvote_comments_count = 0;
if ($all_votes) {
	foreach($all_votes as $details) {
		if ($details->vote_type == 'links' && $details->vote_value == 10) {
			$upvote_links_count = $details->total;
			$main_smarty->assign('upvote_links_count', $upvote_links_count);
			$votes += $details->total;
		}elseif ($details->vote_type == 'links' && $details->vote_value == -10) {
			$downvote_links_count = $details->total;
			$main_smarty->assign('downvote_links_count', $downvote_links_count);
			$votes += $details->total;
		}elseif ($details->vote_type == 'comments' && $details->vote_value == 10) {
			$upvote_comments_count = $details->total;
			$main_smarty->assign('upvote_comments_count', $upvote_comments_count);
			$votes += $details->total;
		}elseif ($details->vote_type == 'comments' && $details->vote_value == -10) {
			$downvote_comments_count = $details->total;
			$main_smarty->assign('downvote_comments_count', $downvote_comments_count);
			$votes += $details->total;
		}
	}
}
$main_smarty->assign('votes', $votes);
/* Redwine: added variables to hold the total votes on links and comments to use in the sidebar stats module */
$main_smarty->assign('sidebar_links_votes', $upvote_links_count + $downvote_links_count);
$main_smarty->assign('sidebar_stats_comment_votes', $upvote_comments_count + $downvote_comments_count);
/* get the comments count, with a breakdown by comment status */
$all_comments = $db->get_results('select `comment_status`, count(*) total from ' . table_comments . ' group by `comment_status`');
$comments = 0;
$published_comments_count = 0;
$moderated_comments_count = 0;
$discarded_comments_count = 0;
$spam_comments_count = 0;
if ($all_comments) {
	foreach($all_comments as $comstatus) {
		if ($comstatus->comment_status == 'published') {
			$published_comments_count = $comstatus->total;
			$main_smarty->assign('published_comments_count', $published_comments_count);
			$comments += $comstatus->total;
		}elseif ($comstatus->comment_status == 'moderated') {
			$moderated_comments_count = $comstatus->total;
			$main_smarty->assign('moderated_comments_count', $moderated_comments_count);
			$comments += $comstatus->total;
		}elseif ($comstatus->comment_status == 'discard') {
			$discarded_comments_count = $comstatus->total;
			$main_smarty->assign('discarded_comments_count', $discarded_comments_count);
			$comments += $comstatus->total;
		}elseif ($comstatus->comment_status == 'spam') {
			$spam_comments_count = $comstatus->total;
			$main_smarty->assign('spam_comments_count', $spam_comments_count);
			$comments += $comstatus->total;
		}
	}
}
$main_smarty->assign('comments', $comments);
/* getting the breakdown of Groups by group_status */
$all_groups = $db->get_results('SELECT `group_status`, count(*) total FROM ' . table_groups. ' group by `group_status`');
$grouptotal = 0;
$enabled_groups_count = 0;
$disabled_groups_count = 0;
if ($all_groups) {
	foreach($all_groups as $grpstatus) {
		if ($grpstatus->group_status == 'Enable') {
			$enabled_groups_count = $grpstatus->total;
			$main_smarty->assign('enabled_groups_count', $enabled_groups_count);
			$grouptotal += $grpstatus->total;
		}elseif ($grpstatus->group_status == 'disable') {
			$disabled_groups_count = $grpstatus->total;
			$main_smarty->assign('disabled_groups_count', $disabled_groups_count);
			$grouptotal += $grpstatus->total;
		}
	}
}
$main_smarty->assign('grouptotal', $grouptotal);
/* Redwine: redundant query */
/*// Count variable for moderated groups
$moderated_groups_count = $db->get_var('SELECT count(*) from ' . table_groups . ' where group_status = "disable";');
$main_smarty->assign('moderated_groups_count', $moderated_groups_count);*/

// Count the number of errors
$error_log_path = mnminclude.'../logs/error.log';
$error_log_content = file_get_contents($error_log_path);
$error_count = preg_match_all('/\[(\d{2})-(\w{3})-(\d{4}) (\d{2}:\d{2}:\d{2})/', $error_log_content, $matches);
$main_smarty->assign('error_count', $error_count);

// Count number of file backups
$admin_backup_dir = "../admin/backup/";
if (glob($admin_backup_dir . "*.sql") != false) {
	$sqlcount = count(glob($admin_backup_dir . "*.sql"));
} else {
	$sqlcount = 0;
}
if (glob($admin_backup_dir . "*.zip") != false) {
	$zipcount = count(glob($admin_backup_dir . "*.zip"));
} else {
	$zipcount = 0;
}
$main_smarty->assign('backup_count', $sqlcount+$zipcount);
$backup_count = $sqlcount+$zipcount;

// Count moderated total
$moderated_total_count = $disabled_groups_count+$moderated_users_count+$moderated_comments_count+$moderated_submissions_count+$error_count+$backup_count;
$main_smarty->assign('moderated_total_count', $moderated_total_count);

//count installed module with updates available
$res_update_mod=$db->get_results('SELECT folder from ' . table_modules . ' where latest_version>version');
$num_update_mod=0;
if(count($res_update_mod)>0){
foreach($res_update_mod as $modules_folders){
	if (file_exists(mnmmodules . $modules_folders->folder))
			$num_update_mod++;
 }
}
$main_smarty->assign('in_no_module_update_require', $num_update_mod);

$res_for_update=$db->get_var("select var_value from " . table_config . "  where var_name = 'uninstall_module_updates'");
$data_for_update_uninstall_mod=$res_for_update;
//count uninstalled modules with updates available
$main_smarty->assign('un_no_module_update_require', $data_for_update_uninstall_mod);

//count total module updates required
$total_update_required_mod=$num_update_mod+$data_for_update_uninstall_mod;
$main_smarty->assign('total_update_required_mod', $total_update_required_mod);

$vars = '';
check_actions('all_pages_top', $vars);

// setup the sorting links on the index page in smarty
$kliqqi_category = isset($_GET['category']) ? sanitize($_GET['category'], 3) : '';
if($kliqqi_category != ''){
	$main_smarty->assign('index_url_recent', getmyurl('maincategory', $kliqqi_category));
	$main_smarty->assign('index_url_today', getmyurl('index_sort', 'today', $kliqqi_category));
	$main_smarty->assign('index_url_yesterday', getmyurl('index_sort', 'yesterday', $kliqqi_category));
	$main_smarty->assign('index_url_week', getmyurl('index_sort', 'week', $kliqqi_category));
	$main_smarty->assign('index_url_month', getmyurl('index_sort', 'month', $kliqqi_category));
/* Redwine: add an additional Sort by from the sort button to sort the stories of the current month */
	$main_smarty->assign('index_url_curmonth', getmyurl('index_sort', 'curmonth', $kliqqi_category));
	$main_smarty->assign('index_url_year', getmyurl('index_sort', 'year', $kliqqi_category));
	$main_smarty->assign('index_url_alltime', getmyurl('index_sort', 'alltime', $kliqqi_category));
	
	$main_smarty->assign('index_url_upvoted', getmyurl('index_sort', 'upvoted', $kliqqi_category));
	$main_smarty->assign('index_url_downvoted', getmyurl('index_sort', 'downvoted', $kliqqi_category));
	$main_smarty->assign('index_url_commented', getmyurl('index_sort', 'commented', $kliqqi_category));
	
	$main_smarty->assign('cat_url', getmyurl("maincategory"));
}	
else {
	$main_smarty->assign('index_url_recent', getmyurl('index'));
	$main_smarty->assign('index_url_today', getmyurl('index_sort', 'today'));
	$main_smarty->assign('index_url_yesterday', getmyurl('index_sort', 'yesterday'));
	$main_smarty->assign('index_url_week', getmyurl('index_sort', 'week'));
	$main_smarty->assign('index_url_month', getmyurl('index_sort', 'month'));
/* Redwine: add an additional Sort by from the sort button to sort the stories of the current month */
	$main_smarty->assign('index_url_curmonth', getmyurl('index_sort', 'curmonth'));
	$main_smarty->assign('index_url_year', getmyurl('index_sort', 'year'));
	$main_smarty->assign('index_url_alltime', getmyurl('index_sort', 'alltime'));
	
	$main_smarty->assign('index_url_upvoted', getmyurl('index_sort', 'upvoted'));
	$main_smarty->assign('index_url_downvoted', getmyurl('index_sort', 'downvoted'));
	$main_smarty->assign('index_url_commented', getmyurl('index_sort', 'commented'));

}
//group sort smarty
$main_smarty->assign('group_url_newest', getmyurl('group_sort', 'newest'));
$main_smarty->assign('group_url_oldest', getmyurl('group_sort', 'oldest'));
$main_smarty->assign('group_url_members', getmyurl('group_sort', 'members'));
$main_smarty->assign('group_url_name', getmyurl('group_sort', 'name'));

// setup the links
if ($current_user->user_id > 0 && $current_user->authenticated) 
{
	$login=$current_user->user_login;
	$main_smarty->assign('user_url_personal_data', getmyurl('user', $login));
	$main_smarty->assign('user_url_news_sent', getmyurl('user2', $login, 'history'));
	$main_smarty->assign('user_url_news_published', getmyurl('user2', $login, 'published'));
	$main_smarty->assign('user_url_news_unpublished', getmyurl('user2', $login, 'new'));
	$main_smarty->assign('user_url_news_voted', getmyurl('user2', $login, 'voted'));
	$main_smarty->assign('user_url_news_upvoted', getmyurl('user2', $login, 'upvoted'));
	$main_smarty->assign('user_url_news_downvoted', getmyurl('user2', $login, 'downvoted'));
	$main_smarty->assign('user_url_commented', getmyurl('user2', $login, 'commented'));
	$main_smarty->assign('user_url_saved', getmyurl('user2', $login, 'saved'));
	$main_smarty->assign('user_url_setting', getmyurl('profile'));
	$main_smarty->assign('user_url_friends', getmyurl('user_friends', $login, 'following'));
	$main_smarty->assign('user_url_friends2', getmyurl('user_friends', $login, 'followers'));
	$main_smarty->assign('user_url_add', getmyurl('user_friends', $login, 'addfriend'));
	$main_smarty->assign('user_url_remove', getmyurl('user_friends', $login, 'removefriend'));
	$main_smarty->assign('user_rss', getmyurl('rssuser', $login));
	$main_smarty->assign('URL_Profile', getmyurl('user_edit', $login));
	$main_smarty->assign('user_url_member_groups', getmyurl('user2', $login, 'member_groups	'));
	$main_smarty->assign('isAdmin', checklevel('admin'));
	$main_smarty->assign('isModerator', checklevel('moderator'));
}
?>
