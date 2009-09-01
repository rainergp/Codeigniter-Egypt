<?php
$ci =& get_instance();
add( 'assets/edit panel/style.css' );
add('dojo/dojo/dojo.js');
add( 'jquery/jquery.js' );
add( 'assets/fancybox/jquery.fancybox.js' );
add( 'assets/fancybox/jquery.fancybox.css' );
$local = base_url();
$url = site_url('admin/app').'/';
$logout = site_url( 'logout' );

$links = array(
"toggle images"=>"vunsyToggle('img:not(.trigger img,.panel img)');",
"toggle links"=>"vunsyToggle('a:not(.trigger,.panel a)');",
"toggle tables"=>"vunsyToggle('table:not(.trigger table, .panel table)');",
"toggle vunsy edit buttons"=>"vunsyToggle('.vunsyCtrl').toggle();"
);
$links_text = '';
foreach( $links as $key=>$value )
{
	$links_text .= "<a href=\"#\" onclick=\"{$value}\" >
	<img 
		src=\"{$local}assets/admin/jquery/{$key}.png\" 
		title=\"{$key}\"
		>{$key}</a>";
}

$XHR_URL = site_url('admin/app/editmode/'.(($ci->vunsy->edit_mode())?'viewmode':'editmode'));

$scripts = <<<EOT

<script type="text/javascript">

function vunsyButtonToggler(){
		$(".panel").toggle("fast");
		$(this).toggleClass("active");
		return false;
}
	
function vunsyToggle(selector)
{
	$(selector).toggle();
	vunsyButtonToggler();
}

$(function (){
	$(".trigger").click(vunsyButtonToggler);
});

$(
	function()
	{
		$("a.iframe").fancybox({
			frameWidth: 700,
			frameHeight: 450,
		}); 
	}
);

function admin_editmode_toolbar()
{
	dojo.xhrGet({
		url: "{$XHR_URL}",
		load: function(args,response)
		{
			document.location.reload();
		}
	});
}
</script>
EOT;
add( $scripts );
?>


<div class="panel">
<a href="<?="{$local}"?>kfm" class="iframe"  title="My Computer">
	<img src="<?="{$local}"?>assets/admin/kfm.png" /> My computer
</a>
<a href="<?="{$url}"?>user manager" class="iframe" title="Users manager" >
	<img src="<?="{$local}"?>assets/admin/users.png" /> User manager
</a>
<a href="<?="{$url}"?>section manager" class="iframe"  title="Sections manager">
	<img src="<?="{$local}"?>assets/admin/section.png" /> Sections manager
</a>
<a href="<?="{$url}"?>Package manager" class="iframe" title="Package manager" >
	<img src="<?="{$local}"?>assets/admin/software.png" /> Package manager
</a>
<a href="<?="{$url}"?>software manager" class="iframe"  title="Software manager">
	<img src="<?="{$local}"?>assets/admin/software.png" /> Software manager
</a>

<br />
<?="{$links_text}"?>

<br />
<a href="javascript:admin_editmode_toolbar()" >
	<img src="<?="{$local}"?>assets/admin/editmode.png" title="Editmode toggle" /> Editmode toggle
</a>
<a href="<?="{$logout}"?>" >
	<img src="<?="{$local}"?>assets/admin/logout.png" title="Logout" /> Logout
</a>
</div>
<a class="trigger" href="#"></a>

