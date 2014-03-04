<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sorting Items on the fly using jQuery UI, PHP & MySQL</title>
<link rel="stylesheet" href="themes/base/jquery.ui.all.css">
	<script src="jquery-1.10.2.js"></script>
	<script src="ui/jquery.ui.core.js"></script>
	<script src="ui/jquery.ui.widget.js"></script>
	<script src="ui/jquery.ui.mouse.js"></script>
	<script src="ui/jquery.ui.sortable.js"></script>
	<link rel="stylesheet" href="demos.css">
	<style>
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
	#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
	#sortable li span { position: absolute; margin-left: -1.3em; }
	</style>
<script>
$(document).ready(function() {
$("#sortable").sortable({
update : function () {
serial = $('#sortable').sortable('serialize');
$.ajax({
url: "sort_menu.php",
type: "post",
data: serial,
error: function(){
alert("theres an error with AJAX");
}
});
}
});
}
);
</script>
</head>
<body>
<h1>Menu List</h1>

<?php
// Connecting to Database
$hostname="localhost";
$user_name="root";
$password="";
mysql_connect($hostname, $user_name, $password) or die ('Cant Connceto to MySQL');

// Selecting Database
$db_name="sort";
mysql_select_db($db_name) or die ('Cant select Database');

// Getting menu items from DB
$result = mysql_query("SELECT * FROM `menu` ORDER BY `sort` ASC") or die(mysql_error());
?>
<ul id="sortable">
<?php
while($row = mysql_fetch_array($result)) {
echo '<li class="ui-state-default" id="menu_' . $row['id'] . '"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>'.$row['title'].'</li>';
//echo '<li id="menu_' . $row['id'] . '">' . $row['title'] . "</li>\n";
}
?>
</ul>
</body>
</html>