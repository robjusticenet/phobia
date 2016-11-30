<?php
$widget['widget_title'] = "Kliqqi News";
$widget['widget_has_settings'] = 0;
$widget['widget_shrink_icon'] = 1;
$widget['widget_uninstall_icon'] = 0;
$widget['name'] = 'Kliqqi News';
$widget['desc'] = 'The Kliqqi News widget displays the latest news items from the <a href="http://www.kliqqi.com/blog/" target="_blank">Kliqqi CMS Blog</a>.';
$widget['version'] = 0.1;

$news_count = get_misc_data('news_count');
if ($news_count <= 0) $news_count='3';

if (isset($_REQUEST['widget']) && $_REQUEST['widget']=='kliqqi_news'){
    if(isset($_REQUEST['stories']))
		$news_count = sanitize($_REQUEST['stories'], 3);
    misc_data_update('news_count', $news_count);
}

if ($main_smarty){
    $main_smarty->assign('news_count', $news_count);
}

?>