<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />
  <meta name="description" content="View recent online obituaries from the Charles Davis Funeral Homes in Inverness Florida." />
  <title>Citrus County Obituaries from Chas Davis Funeral Home in Inverness Florida.</title>
  <link rel="stylesheet" type="text/css" media="screen" href="styles.css" />
</head>

<body topmargin="10" marginheight="10">
 <div align="center">
 <div id="header">
  <div id="topnav">
   <a href="about_us.html">About Us</a> | 
   <a href="preplanning.html">Preplanning</a> | 
   <a href="payment.html">Prepayment</a> | 
   <a href="government.html">Government Benefits</a> | 
   <a href="pre_arrangement.html">Prearrangement</a> | 
   <a href="meaningful_funerals.html">Meaningful Funerals</a> | 
   <a href="cost_services.html">Cost &amp; Services</a> | 
   <a href="greiving_process.html">Grief Process</a> | 
   <a href="products.html">Merchandise</a>
  </div>
  <div id="topnav2">
   <a href="index.php">Home</a> | 
   <a href="mailto:chas@chasdavis.com">Contact Us</a> | 
   <a href="obituaries.php">Citrus County Obituaries</a>
  </div>
 </div>
 <div id="content">
  <h1>Obituaries</h1>
<?php
//Include Db connection script
include 'dbconn.php';

// Select items from Db
$sql = "SELECT * FROM tbl_obits ORDER BY last_name,first_name";
$result = @mysql_query($sql);
if (!$result) {
   echo("<p>Error performing query: " . mysql_error() . "</p>");
   exit();
}
while ($row = @mysql_fetch_array($result)) {
   echo "\n";
   echo "  <p><strong>".$row['first_name'];
   if (!empty($row['middle_initial'])) { echo " ".$row['middle_initial']; }
   echo " ".$row['last_name'].", ".$row['age'].", ".$row['city'].", ".$row['state']."</strong><br />\n";
   echo $row['full_text']."</p>\n";
   echo "<hr size='1' noshade='true' />\n";
}

/* Free result sets */
if (!empty($result)) { mysql_free_result($result); }
/* Closing connection */
mysql_close($dbcnx);
?>
  <p>&nbsp;</p>
  <div align="center"><table cellpadding="2" cellspacing="2" border="0"><tr>
   <td align="center" valign="bottom"><a href="golden_rule.html"><img src="images/logo-golden-rule.jpg" width="112" height="65" alt="Golden Rule" border="0" /></a></td>
   <td align="center" valign="bottom"><a href="http://www.hospiceofcitruscounty.org/" target="_blank"><img src="images/logo-hospice.jpg" width="132" height="149" alt="Hopice of Citrus County" border="0" /></a></td>
   <td align="center" valign="bottom"><a href="http://www.veteransfuneralhomes.com/" target="_blank"><img src="images/logo-veterans-family-memorial-care.jpg" width="121" height="72" alt="Veterans Family Memorial Care" border="0" /></a></td>
   <td align="center" valign="bottom"><a href="http://www.hph-hospice.org/" target="_blank"><img src="images/logo-hp-hospice.jpg" width="119" height="41" alt="Hernando Pasco Hospice" border="0" /></a></td>
   <td align="center" valign="bottom"><img src="images/vcsproviderlogo.png" width="119" height="41" alt="Hernando Pasco Hospice" border="0" />
  </tr></table></div>
 </div>
 <table id="footer" width="860" cellpadding="0" cellspacing="0" border="0">
  <tr>
   <td id="footernav" colspan="3" align="center"><a href="about_us.html">About Us</a> | 
    <a href="preplanning.html">Preplanning</a> | 
    <a href="payment.html">Prepayment</a> | 
    <a href="government.html">Government Benefits</a> | 
    <a href="pre_arrangement.html">Prearrangement</a> | 
    <a href="meaningful_funerals.html">Meaningful Funerals</a> | 
    <a href="cost_services.html">Cost &amp; Services</a> | 
    <a href="greiving_process.html">Grief Process</a> | 
    <a href="products.html">Merchandise</a><br />
    <a href="index.php">Home</a> | 
    <a href="mailto:chas@chasdavis.com">Contact Us</a> | 
    <a href="obituaries.php">Citrus County Obituaries</a>
   </td>
  </tr>
  <tr>
   <td align="left" valign="top" style="padding-left: 45px;">&copy;2011, Chas. E. Davis Funeral Home, Inc.<br />All rights reserved. <br />Reproduction in whole or in part without permission is prohibited.</td>
   <td align="center" valign="top">Chas E. Davis<br />3075 S. Florida Ave. Inverness, FL 34450<br />352-726-8944</td>
   <td align="right" valign="top" style="padding-right: 45px;">This site Designed &amp; Hosted by <br /><a href="http://www.naturecoastdesign.net" target="_blank">Nature Coast Web Design &amp; Marketing, Inc.</a></td>
  </tr>
 </table>
 </div>
</body>
</html>
