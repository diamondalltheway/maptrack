<?php
error_reporting(E_ALL & ~E_NOTICE);
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<center>
<body>
<font face="Calibri">
<form method="POST" enctype="multipart/form-data" name="melissa_lookup" style="font-family: Calibri; font-size: 11" action="md_index.php">
	<center>
	<table cellSpacing="0" cellPadding="3" width="700" border="0" style="font-family: calibri,sans-serif; font-size: 11pt" id="table1">
		
		<tr>
			<td bgColor=#66E0C2 align="center" colSpan="2">Name Details Results</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Gender of the first detected name">
					Gender&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="NameDetails_Gender" size="40" name="NameDetails_Gender" value="<?php echo $NameDetails_Gender ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Gender of the second detected name">
					Gender 2&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="NameDetails_Gender2" size="40" name="NameDetails_Gender2" value="<?php echo $NameDetails_Gender2 ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Greeting inserted before a recipient">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Salutation&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="NameDetails_Salutation" size="40" name="NameDetails_Salutation" value="<?php echo $NameDetails_Salutation ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="Prefix of first detected name (i.e. 'Dr.', 'Mr.', 'Ms.', etc.)">
					Prefix&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="NameDetails_Prefix" size="40" name="NameDetails_Prefix" value="<?php echo $NameDetails_Prefix ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The first name of the first detected name">
					First Name&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="NameDetails_NameFirst" size="40" name="NameDetails_NameFirst" value="<?php echo $NameDetails_NameFirst ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The middle name of the first detected name">
					Middle Name&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="NameDetails_NameMiddle" size="40" name="NameDetails_NameMiddle" value="<?php echo $NameDetails_NameMiddle ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The last name of the first detected name">
					Last Name&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="NameDetails_NameLast" size="40" name="NameDetails_NameLast" value="<?php echo $NameDetails_NameLast ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The suffix of the first detected name (i.e. 'Jr.', 'Sr.', 'III', etc.)">
					Suffix&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="NameDetails_Suffix" size="40" name="NameDetails_Suffix" value="<?php echo $NameDetails_Suffix ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The prefix of the second detected name (i.e. 'Dr.', 'Mr.', 'Ms.', etc.)">
					Prefix 2&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="NameDetails_Prefix" size="40" name="NameDetails_Prefix" value="<?php echo $NameDetails_Prefix ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The first name of the second detected name">
					First Name 2&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="NameDetails_First2" size="40" name="NameDetails_First2" value="<?php echo $NameDetails_First2 ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The middle name of the second detected name">
					Middle Name 2&nbsp;
				</span>
			</td>
			<td aligm="left">
				<input id="NameDetails_Middle2" size="40" name="NameDetails_Middle2" value="<?php echo $NameDetails_Middle2 ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The last name of the second detected name">
					Last name 2&nbsp;
				</span>
			</td>
			<td>
				<input id="NameDetails_Last2" size="40" name="NameDetails_Last2" value="<?php echo $NameDetails_Last2 ?>">
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<span title="The suffix of the second detected name">
					Suffix 2&nbsp;
				</span>
			</td>
			<td align="left">
				<input id="NameDetails_Suffix2" size="40" name="NameDetails_Suffix2" value="<?php echo $NameDetails_Suffix2 ?>">
			</td>
		</tr>
		<tr>
		</tr>
	</table>
	</center>
	
	
	
		
		<?php
		if (isset($return_content)) {
			echo '<tr><td bgColor="#EAEAEA" colSpan="2">';
			echo '<br>------------- BEGIN SERVER RESPONSE -------------<br>'. $server_response . '<br>------------- END SERVER RESPONSE -------------<br><br>';
			echo '<br>------------- BEGIN SOAP RECORDSET -------------<br>'. $record_content . '<br>------------- END XML RECORDSET -------------<br><br>';
			echo '<br>------------- AVAILABLE VARS -------------<br>';
			printa($output_array);
			echo '------------- END AVAILABLE VARS -------------<br><br>';
			echo '</tr></td>';
			$CustomerID;
		}
		?>
		
	</table>
	</center>

</form>
</font>
</body>
</html>