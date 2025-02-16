<!DOCTYPE html>
<html lang="{$locale}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    {if !empty($title)}
        <title>{$title|html} - {$APPLICATION_NAME|html}</title>
    {else}
        <title>{$APPLICATION_NAME|html}</title>
    {/if}
    <meta name="description" content="{__('Generic', 'Selectorrr is an online service for planning an appointment or make a decision quickly and easily.')}" />

    {if isset($favicon)}
        <link rel="icon" href="{$favicon|resource}">
    {/if}

    <link rel="stylesheet" href="{'css/bootstrap.min.css'|resource}">
    <link rel="stylesheet" href="{'css/datepicker3.css'|resource}">
    <link rel="stylesheet" href="{'css/style.css'|resource}">
    <link rel="stylesheet" href="{'css/frama.css'|resource}">
    <link rel="stylesheet" href="{'css/print.css'|resource}" media="print">
    {if $provide_fork_awesome}
        <link rel="stylesheet" href="{'css/fork-awesome.min.css'|resource}">
    {/if}
    <script type="text/javascript" src="{'js/jquery-1.12.4.min.js'|resource}"></script>
    <script type="text/javascript" src="{'js/bootstrap.min.js'|resource}"></script>
    <script type="text/javascript" src="{'js/bootstrap-datepicker.js'|resource}"></script>
    {if 'en' != $locale}
    <script type="text/javascript" src="{$locale|datepicker_path|resource}"></script>
    {/if}
    <script type="text/javascript" src="{'js/core.js'|resource}"></script>

    {block name="header"}{/block}
	<link rel="stylesheet" type="text/css" media="all" href="https://cdn.piraten.tools/libs/piratentools/1.0.0/css/bootstrap-diff-de.css" />
	<link rel="stylesheet" type="text/css" media="all" href="https://cdn.piraten.tools/fonts/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" media="all" href="https://cdn.piraten.tools/libs/piratentools/1.0.0/css/piratentools.css" />
    <link rel="stylesheet" type="text/css" media="all" href="https://cdn.piraten.tools/libs/piratentools/1.0.0/css/piratnew.css" />
    <link rel="stylesheet" href="{'css/spickerrr.css'|resource}">
</head>
<body>
{if $use_nav_js}
    <script src="https://framasoft.org/nav/nav.js" type="text/javascript"></script>
{/if}
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand logo" href="https://piraten.tools/">
				<img src="https://cdn.piraten.tools/img/Logo_Piraten-Tools.svg">
				<div>PIRATEN</div>
				<div>TOOLS</div>
			</a>
			<a class="brand" href="/">Selectorrr</a>
			{if count($langs)>1}
				<form method="post" action="" class="hidden-print pull-right">
					<div class="input-group input-group-sm">
						<select name="lang" class="form-control" title="{__('Language selector', 'Select the language')}" >
						{foreach $langs as $lang_key=>$lang_value}
							<option lang="{substr($lang_key, 0, 2)}" {if substr($lang_key, 0, 2)==$locale}selected{/if} value="{$lang_key|html}">{$lang_value|html}</option>
						{/foreach}
						</select>
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default btn-sm" title="{__('Language selector', 'Change the language')}">OK</button>
						</span>
					</div>
				</form>
			{/if}
		</div>
	</div>
</div>

<div class="snap-content">

<div id="content">

<div class="container ombre">

{include file='header.tpl'}

{block name=main}{/block}

</main>
</div> <!-- .container -->
</div> <!-- #content -->
</div> <!-- .snap-content -->

<script type="text/javascript" src="https://cdn.piraten.tools/libs/piratentools/1.0.0/js/toolsmenu.js"></script>
{if isset($tracking_code)}
    {$tracking_code}
{/if}
</body>
</html>
