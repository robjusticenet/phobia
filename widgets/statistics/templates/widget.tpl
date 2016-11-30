{checkActionsTpl location="tpl_kliqqi_admin_stats_widget_start"}
<table class="table table-condensed table-striped" style="margin-bottom:0;">
	{if $sw_version eq "1"}
		<tr>
			<td>
				<strong>
				{#KLIQQI_Statistics_Widget_Version#}:
				</strong>
			</td>
			<td>
				{$version_number}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td>
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Member#}:
				</strong>
			</td>
			<td>
				<a href="{$URL_user, $last_user}" title="{#KLIQQI_Visual_AdminPanel_Latest_User#}">{$last_user}</a>
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td title="Total including disabled, spammer and user_enabled = disabled users">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Members#}:
				</strong>
			</td>
			<td>
				<strong>{$users_total}</strong>
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Members_Admins#}:
				</strong>
			</td>
			<td>
				{$admin_users_count}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Members_Moderators#}:
				</strong>
			</td>
			<td>
				{$moderator_users_count}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Members_Normal#}:
				</strong>
			</td>
			<td>
				{$normal_users_count}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="{if $moderated_users_count gt 0}background-color:#d9534f;{/if}padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Members_Disabled#}:
				</strong>
			</td>
			<td {if $moderated_users_count gt 0}style="background-color:#d9534f"{/if}>
				{if $moderated_users_count ne ''}{$moderated_users_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="{if $spammer_users_count gt 0}background-color:#d9534f;{/if}padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Members_Spammers#}:
				</strong>
			</td>
			<td {if $spammer_users_count gt 0}style="background-color:#d9534f"{/if}>
				{if $spammer_users_count ne ''}{$spammer_users_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	
	
	{if $sw_groups eq "1"}
		<tr>
			<td>
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Groups#}:
				</strong>
			</td>
			<td>
				<strong>{$grouptotal}</strong>
			</td>
		</tr>
	{/if}
	{if $sw_groups eq "1"}
		<tr>
			<td style="padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Groups_Enabled#}:
				</strong>
			</td>
			<td>
				{$enabled_groups_count}
			</td>
		</tr>
	{/if}
	{if $sw_groups eq "1"}
		<tr>
			<td style="{if $disabled_groups_count gt 0}background-color:#d9534f;{/if}padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Groups_Disabled#}:
				</strong>
			</td>
			<td {if $disabled_groups_count gt 0}style="background-color:#d9534f"{/if}>
				{if $disabled_groups_count ne ''}{$disabled_groups_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	{if $sw_links eq "1"}
		<tr>
			<td>
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Submissions#}:
				</strong>
			</td>
			<td>
				<strong>{$total_submissions}</strong>
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Published#}:
				</strong>
			</td>
			<td>
				{$published_submissions_count}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_New#}:
				</strong>
			</td>
			<td>
				{$new_submissions_count}
			</td>
		</tr>
	{/if}
		{if $sw_members eq "1"}
		<tr>
			<td style="{if $moderated_submissions_count gt 0}background-color:#d9534f;{/if}padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Moderated#}:
				</strong>
			</td>
			<td {if $moderated_submissions_count gt 0}style="background-color:#d9534f"{/if}>
				{if $moderated_submissions_count ne ''}{$moderated_submissions_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="{if $discarded_submissions_count gt 0}background-color:#d9534f;{/if}padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Discarded#}:
				</strong>
			</td>
			<td {if $discarded_submissions_count gt 0}style="background-color:#d9534f"{/if}>
				{if $discarded_submissions_count ne ''}{$discarded_submissions_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="{if $spam_submissions_count gt 0}background-color:#d9534f;{/if}padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Spam#}:
				</strong>
			</td>
			<td {if $spam_submissions_count gt 0}style="background-color:#d9534f"{/if}>
				{if $spam_submissions_count ne ''}{$spam_submissions_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="{if $abuse_submissions_count gt 0}background-color:#d9534f;{/if}padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Abuse#}:
				</strong>
			</td>
			<td {if $abuse_submissions_count gt 0}style="background-color:#d9534f"{/if}>
				{if $abuse_submissions_count ne ''}{$abuse_submissions_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="{if $duplicate_submissions_count gt 0}background-color:#d9534f;{/if}padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Duplicate#}:
				</strong>
			</td>
			<td {if $duplicate_submissions_count gt 0}style="background-color:#d9534f"{/if}>
				{if $duplicate_submissions_count ne ''}{$duplicate_submissions_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="{if $page_submissions_count gt 0}background-color:#d9534f;{/if}padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Page#}:
				</strong>
			</td>
			<td {if $page_submissions_count gt 0}style="background-color:#d9534f"{/if}>
				{if $page_submissions_count ne ''}{$page_submissions_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td>
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Votes#}:
				</strong>
			</td>
			<td>
				{$votes}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Votes_links_Upvoted#}:
				</strong>
			</td>
			<td>
				{if $upvote_links_count ne ''}{$upvote_links_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Votes_links_Downvoted#}:
				</strong>
			</td>
			<td>
				{if $downvote_links_count ne ''}{$downvote_links_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Votes_Comments_Upvoted#}:
				</strong>
			</td>
			<td>
				{if $upvote_comments_count ne ''}{$upvote_comments_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td style="padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Votes_Comments_Downvoted#}:
				</strong>
			</td>
			<td>
				{if $downvote_comments_count ne ''}{$downvote_comments_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	{if $sw_comments eq "1"}
		<tr>
			<td>
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Comments#}:
				</strong>
			</td>
			<td>
				<strong>{$comments}</strong>
			</td>
		</tr>
	{/if}
	{if $sw_comments eq "1"}
		<tr>
			<td style="padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Published#}:
				</strong>
			</td>
			<td>
				{$published_comments_count}
			</td>
		</tr>
	{/if}
	{if $sw_comments eq "1"}
		<tr>
			<td style="{if $moderated_comments_count gt 0}background-color:#d9534f;{/if}padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Moderated#}:
				</strong>
			</td>
			<td {if $moderated_comments_count gt 0}style="background-color:#d9534f"{/if}>
				{if $moderated_comments_count ne ''}{$moderated_comments_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	{if $sw_comments eq "1"}
		<tr>
			<td style="{if $discarded_comments_count gt 0}background-color:#d9534f;{/if}padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Discarded#}:
				</strong>
			</td>
			<td {if $discarded_comments_count gt 0}style="background-color:#d9534f"{/if}>
				{if $discarded_comments_count ne ''}{$discarded_comments_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	{if $sw_comments eq "1"}
		<tr>
			<td style="{if $spam_comments_count gt 0}background-color:#d9534f;{/if}padding-left:40px">
				<strong>
				{#KLIQQI_Statistics_Widget_Front_Spam#}:
				</strong>
			</td>
			<td {if $spam_comments_count gt 0}style="background-color:#d9534f"{/if}>
				{if $spam_comments_count ne ''}{$spam_comments_count}{else} 0{/if}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td>
				<strong>
				{#KLIQQI_Statistics_Widget_PHP_Version#}:
				</strong>
			</td>
			<td>
				{if $phpver eq "1"}{php}
					if( function_exists( "phpversion" ) ){
						print phpversion();
					}else{
						print 'Unknown';
					}
				{/php}{/if}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td>
				<strong>
				{#KLIQQI_Statistics_Widget_MySQL_Version#}:
				</strong>
			</td>
			<td>
				{php}
					{* Redwine: Fix to the Statistics Widget to accurately get the MySql Version. https://github.com/Pligg/pligg-cms/commit/1ed283f70f5e8c08c1b2bdc34e6c61c40ef7b01a *}
					/* Redwine: creating a mysqli connection */
					$mysqli = new mysqli(EZSQL_DB_HOST,EZSQL_DB_USER,EZSQL_DB_PASSWORD,EZSQL_DB_NAME);
					/* check connection */
					if (mysqli_connect_errno()) {
						printf("Connect failed: %s\n", mysqli_connect_error());
						exit();
					}
					 
					/* print server version */
					printf("%s\n", $mysqli->server_info);
					 
					/* close connection */
					$mysqli->close();
				{/php}
			</td>
		</tr>
	{/if}
	{if $sw_members eq "1"}
		<tr>
			<td>
				<strong>
				{#KLIQQI_Statistics_Widget_DB_Size#}:
				</strong>
			</td>
			<td>
				{$dbsize}
			</td>
		</tr>
	{/if}
	{checkActionsTpl location="tpl_kliqqi_admin_stats_widget_intable"}
</table>
{checkActionsTpl location="tpl_kliqqi_admin_stats_widget_end"}