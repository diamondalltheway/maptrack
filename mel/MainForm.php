

<?php
error_reporting(E_ALL & ~E_NOTICE);
?>

	<HTML>
  <HEAD>
**If you should have any comments, suggestions or improvements to these samples, we welcome you to contact us at SampleCode@melissadata.com also please visit our
developers bulletin board at forum.melissadata.com.**
  <meta http-equiv="Content-Language" content="en-us">
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
  <title>Melissa Data Lookup Form</title>
	</head>

  <TITLE>Melissa Data Property WebService Sample</TITLE>

  <BODY>


<form method="POST" name="melissa_lookup" style="font-family: Arial; font-size: 9" action="PropertyWSXML.php">
	<center>


	<table cellSpacing="0" cellPadding="3" width="600" border="0" style="font-family: arial,sans-serif; font-size: 10pt" id="table1">
		<tr>
			<td bgColor="silver" align="middle" colSpan="2">Enter Information </td>
		</tr>

		<tr>
			<td align="right" bgColor="skyblue">Customer ID&nbsp;</td>
			<td align="left" bgColor="lightgoldenrodyellow">
			<input id="CustomerID" size="20" name="CustomerID" value="<?php echo $CustomerID ?>"></td>
		</tr>
		<tr>
			<td align="right" bgColor="skyblue">AddressKey&nbsp;</td>
			<td align="left" bgColor="lightgoldenrodyellow">
			<input size="32" name="AddressKey" value="<?php echo $AddressKey ?>"></td>
		</tr>
		<tr>
			<td align="right" bgColor="skyblue">FIPS&nbsp;</td>
			<td align="left" bgColor="lightgoldenrodyellow">
			<input size="6" name="FIPS" value="<?php echo $FIPS ?>"></td>
		</tr>
		<tr>
			<td align="right" bgColor="skyblue">APN&nbsp;</td>
			<td align="left" bgColor="lightgoldenrodyellow">
			<input name="APN" size="10" value="<?php echo $APN ?>"></td>
		</tr>
		
		<tr>
			<td align="right" bgColor="skyblue">Property Detail Only&nbsp;</td>
			<td align="left" bgColor="lightgoldenrodyellow">
			<input name="OptPropertyDetail" type="checkbox" value="true" <?php echo $DetailOnly ?>></td>
		</tr>
		
		<tr>
			<td align="right" bgColor="skyblue">&nbsp;</td>
			<td align="left" bgColor="lightgoldenrodyellow">&nbsp;</td>
		</tr>

		<tr>
			<td align="middle" bgColor="silver" colSpan="2">
			<input type="submit" value="Submit" name="PropertyWS">&nbsp;<input type="submit" value="Insert Sample Address" name="Insert">
			&nbsp;<input type="submit" value="Clear" name="Clear"></td>
		</tr>

	</table>
	</center>
	<p>&nbsp;</p>
	
	 <table border="0" align="center"> 
         
                    <th><P>XML Response:<BR><textarea  rows="30" name="responseXML" cols="100" readonly="readonly" value = <?php echo $responseXML?>></textarea></th>
             
           
      
</form>



</BODY>
</HTML>