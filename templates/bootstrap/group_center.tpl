{************************************
******* Groups Main Template ********
*************************************}
<!-- group_center.tpl -->
{if $enable_group eq "true"}
	{if $pagename eq "groups"}
		<div class="well group_explain">
			<div class="group_explain_inner">
				<h2>Groups</h2>
				<div class="group_explain_description">
					{#KLIQQI_Visual_Group_Explain#}
				</div>
				{if $group_allow eq "1"}
					<div class="create_group">
						<form>
{* Redwine: Roles and permissions and Groups fixes. Fix the button when user met group creation quota *}
							<input type="button" value="{#KLIQQI_Visual_Submit_A_New_Group#}" onclick="window.location.href='{$URL_submit_groups}'" class="{if empty($error_max)}btn btn-success{else}btn btn-danger disabled strike-through" title="{#KLIQQI_Visual_Submit_A_New_Group_Error#}{/if}">
						</form>
					</div>
				{/if}
				<div class="search_groups">
					<div class="input-append">
						<form action="{$my_kliqqi_base}/groups.php" method="get"	{if $urlmethod eq 2}onsubmit="document.location.href = '{$my_base_url}{$my_kliqqi_base}/groups/search/' + encodeURIComponent(this.keyword.value); return false;"{/if}>
							<input type="hidden" name="view" value="search">
							{if !empty($get.keyword)}
								{assign var=searchboxtext value=$get.keyword}
							{else}
								{assign var=searchboxtext value=''}
							{/if}
							<div class="col-md-8">
								<input type="text" class="form-control" name="keyword" value="{$searchboxtext}" placeholder="{#KLIQQI_Visual_Search_SearchDefaultText#}" onfocus="if(this.value == '{$searchboxtext}') {ldelim}this.value = '';{rdelim}" onblur="if (this.value == '') {ldelim}this.value = '{$searchboxtext}';{rdelim}">
							</div>
							<div class="col-md-4">
								<button class="btn btn-primary" type="submit">{#KLIQQI_Visual_Group_Search_Groups#}</button>
							</div>
						</form>
					</div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
	{/if}
	{if !empty($get.keyword)}
		{if !empty($group_display)}
			<legend>{#KLIQQI_Visual_Search_SearchResults#} &quot;{$search}&quot;</legend>
		{else}
			<legend>{#KLIQQI_Visual_Search_NoResults#} &quot;{$search}&quot;</legend>
		{/if}
	{/if}
	{if !empty($group_display)}{$group_display}{/if}
	<div style="clear:both;"></div>
	{if !empty($group_pagination)}{$group_pagination}{/if}
{/if}
   {if $enable_group neq "true"}
       {literal}
			<script type="text/javascript">
			   <!--
			   window.location="{/literal}{$my_base_url}{$my_kliqqi_base}/error_404.php{literal}";
			   //-->
			</script>
      {/literal}
   {/if}
<!-- group_center.tpl -->