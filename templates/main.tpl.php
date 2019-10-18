<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="robots" content="noindex">
		<title>Automobilių dalių IS</title>
		<link rel="stylesheet" type="text/css" href="scripts/datetimepicker/jquery.datetimepicker.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="style/main.css" media="screen" />
		<script type="text/javascript" src="scripts/jquery-1.12.0.min.js"></script>
		<script type="text/javascript" src="scripts/datetimepicker/jquery.datetimepicker.full.min.js"></script>
		<script type="text/javascript" src="scripts/main.js"></script>
	</head>
	<body>
		<div id="body">
			<div id="header">
				<h3 id="slogan"><a href="index.php">Automobilių dalių IS</a></h3>
			</div>
                    
			<div id="content">
                            
				<div id="topMenu">
                                    
					<ul class="float-left">
                                           
						<li><a href="index.php?module=asmuo&action=list" title="Asmenys"<?php if($module == 'asmuo') { echo 'class="active"'; } ?>>Asmenys</a></li>
						<li><a href="index.php?module=darbuotojas&action=list" title="Darbuotojas"<?php if($module == 'darbuotojas') { echo 'class="active"'; } ?>>Darbuotojai</a></li>
						<li><a href="index.php?module=klientas&action=list" title="Klientai"<?php if($module == 'klientas') { echo 'class="active"'; } ?>>Klientai</a></li>
						<li><a href="index.php?module=dalis&action=list" title="Dalys"<?php if($module == 'dalis') { echo 'class="active"'; } ?>>Dalys</a></li>
						<li><a href="index.php?module=parduotuve&action=list" title="Partuotuve"<?php if($module == 'parduotuve') { echo 'class="active"'; } ?>>Parduotuvės</a></li>
						</ul>
					<ul class="float-right">
						<li><a href="index.php?module=report&action=list" title="Ataskaitos"<?php if($module == 'report') { echo 'class="active"'; } ?>>Ataskaitos</a></li>
					</ul>
				</div>
				<div id="contentMain">
					<?php
						// įtraukiame veiksmų failą
						if(file_exists($actionFile)) {
							include $actionFile;
						}
					?>
					<div class="float-clear"></div>
				</div>
			</div>
			<div id="footer">

			</div>
		</div>
	</body>
</html>