<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title> E.R.P. Casa Madelynn</title>

<link rel="stylesheet" media="screen" href="<?=_THEME_DIRNAME_?>css/reset.css" />
<link rel="stylesheet" media="screen" href="<?=_THEME_DIRNAME_?>css/grid.css" />
<link rel="stylesheet" media="screen" href="<?=_THEME_DIRNAME_?>css/style.css" />
<link rel="stylesheet" media="screen" href="<?=_THEME_DIRNAME_?>css/messages.css" />
<link rel="stylesheet" media="screen" href="<?=_THEME_DIRNAME_?>css/forms.css" />
<link rel="stylesheet" media="screen" href="<?=_THEME_DIRNAME_?>css/general.css" />
<link rel="stylesheet" media="screen" href="<?=_THEME_DIRNAME_?>/css/tables.css" />

<!--[if lt IE 9]>
<script src="http://themes.vivantdesigns.com/streamlined/js/html5.js"></script>
<script src="http://themes.vivantdesigns.com/streamlined/js/PIE.js"></script>
<![endif]-->
<!-- jquerytools -->
<script src="<?=_THEME_DIRNAME_?>js/jquery.tools.min.js"></script>
<script src="<?=_THEME_DIRNAME_?>js/jquery.ui.min.js"></script>
<script src="<?=_THEME_DIRNAME_?>js/json.js"></script>
<!--[if lte IE 9]>
<link rel="stylesheet" media="screen" href="http://themes.vivantdesigns.com/streamlined/css/ie.css" />
<script type="text/javascript" src="http://themes.vivantdesigns.com/streamlined/js/ie.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script type="text/javascript" src="http://themes.vivantdesigns.com/streamlined/js/IE9.js"></script>
<![endif]-->

<script src="<?=_THEME_DIRNAME_?>js/global.js"></script>

<!-- script requeridos por el controlador cargado -->
<?php
foreach($css as $key => $value):
    echo $value;
endforeach;

foreach($scripts as $key => $value):
    echo $value;
endforeach;
?>

<meta charset="UTF-8">
</head>