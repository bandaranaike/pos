<?php
function connect_db()
{
	mysql_connect('localhost','lankabus_theonep','theoneproperties');
	mysql_select_db('lankabus_theoneproperties');
}

?>