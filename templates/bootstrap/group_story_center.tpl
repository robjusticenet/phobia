{************************************
***** Individual Group Template *****
*************************************}
<!-- group_story_center.tpl -->
{if $enable_group eq "true"}
	{checkActionsTpl location="tpl_kliqqi_group_start"}
	{include file=$the_template."/group_summary.tpl"}
	{checkActionsTpl location="tpl_kliqqi_group_end"}
	<ul id="storytabs" class="nav nav-tabs">
		{checkActionsTpl location="tpl_kliqqi_group_sort_start"}
		<li {if $groupview eq "published"}class="active"{/if}>
			<a href="{$groupview_published}">
				<span>{#KLIQQI_Visual_Group_Published#}</span>
				{if $group_published_rows}
					<span class="badge badge-gray">{$group_published_rows}</span>
				{/if}
			</a>
		</li>
		<li {if $groupview eq "new"}class="active"{/if}>
			<a href="{$groupview_new}">
				<span>{#KLIQQI_Visual_Group_New#}</span>
				{if $group_new_rows}
					<span class="badge badge-gray">{$group_new_rows}</span>
				{/if}
			</a>
		</li>
		<li {if $groupview eq "shared"}class="active"{/if}>
			<a href="{$groupview_sharing}">
				<span>{#KLIQQI_Visual_Group_Shared#}</span>
				{if $group_shared_rows}
					<span class="badge badge-gray">{$group_shared_rows}</span>
				{/if}
			</a>
		</li>
		<li {if $groupview eq "members"}class="active"{/if}>
			<a href="{$groupview_members}">
				<span class="active">{#KLIQQI_Visual_Group_Member#}</span>
				{*
				{if $group_members}
					<span class="badge badge-gray">{$group_members}</span>
				{/if}
				*}
			</a>
		</li>
		{checkActionsTpl location="tpl_kliqqi_group_sort_end"}
	</ul>
	<div class="tab-content" id="tabbed">
		{*Redwine: added conditional statement to display a message if no articles are published in the group*}
		{if $groupview eq "published"}
			{if !empty($group_display)}
				{$group_display}
				<div style="clear:both;"></div>
				{$group_story_pagination}
			{else}
				<strong>{#KLIQQI_Visual_Group_No_Published_Stories#}</strong>
			{/if}
		{elseif $groupview eq "new"}
			{*Redwine: added conditional statement to display a message if no New articles are available*}
			{if !empty($group_display)}
				{$group_display}
				<div style="clear:both;"></div>
				{$group_story_pagination}
			{else}
				<strong>{#KLIQQI_Visual_Group_No_New_Stories#}</strong>
			{/if}
		{elseif $groupview eq "shared"}
			{*Redwine: added conditional statement to display a message if no articles are yet shared to this Group*}
			{if !empty($group_shared_display)}
				{$group_shared_display}
				<div style="clear:both;"></div>
				{$group_story_pagination}
			{else}
				<strong>{#KLIQQI_Visual_Group_No_Shared_Stories#}</strong>
			{/if}
		{elseif $groupview eq "members"}
			<br />
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th style="width:32px">&nbsp;</th>
						<th>Username</th>
{* Redwine: Roles and permissions and Groups fixes *}
						{*if $is_group_admin*}
							<th style="width:100px;">Role</th>
							<th style="width:75px;">Edit</th>
							<th style="width:105px;">Activation</th>
						{*/if*}
					</tr>
				</thead>
				<tbody>
					{$member_display}
				</tbody>
			</table>
		{/if}
	</div>
{/if}
<!--/group_story_center.tpl -->