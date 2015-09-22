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
	<div id="criteria" style="float:right; margin:25px 60px 0 0; padding:5px 5px 5px 5px; height:65px; background-color:#F2F6A9;"><!--   -->
	<form name="criteria_sel" action="#">
	<div style='padding-bottom:5px; padding-left:35px;'>Select date range for Obituaries
		<select onchange="javascript:location.href='obits2.php?dr='+this.value">
<?php
// Build SELECT element
/*****************************************************************************
******************************************************************************
******************************************************************************
   Need to insert trailing comments below as array elements 0 on 10/01/2012... wh
   Build php code to dynamically create these dates
******************************************************************************
******************************************************************************
*****************************************************************************/
$quarter=array("2013-10","2013-07","2013-04","2013-01","2012-10","2012-07","2012-04","2012-01","2011-10","2011-07","2011-04");//"2013-10",
$quarter2=array("2013 Oct - Dec","2013 Jul - Sep","2013 Apr - Jun","2013 Jan - Mar","2012 Oct - Dec","2012 Jul - Sep","2012 Apr - Jun","2012 Jan - Mar","2011 Oct - Dec","2011 Jul - Sep","2011 Apr - Jun");//"2012 Oct - Dec",

$selected="";
$i=0;
while($quarter[$i]){
	if($quarter[$i]==$_GET['dr']){
		$selected=" selected='selected'";
	}
	print "	 <option value='".$quarter[$i]."' ".$selected.">".$quarter2[$i]."</option>";
	$selected="";
	$i++;
}
print "	 </select>";
print "	 </div>";
print "	 <span style='padding:5px 5px 10px 0;'> Or Search by Last Name  <input type='text' id='ln_search' name='search' /><input type='submit' value='Search' onclick=\"javascript:location.href='obits2.php?ln='+criteria_sel.ln_search.value\" /></span><br />";
print "	 <span style='font-size:12px; font-style:italic; float:right; padding-right:5px;'>For best results, enter at least the first 3 letters of the last name.</span>";
print "	 </form>";
print "	</div>";
print "</div>";
print " <div id='content'>";

//Check for passed arguments
if($_GET['search']){
	// Last name search
	$ln_len=strlen($_GET['search']);
	$sql="SELECT * FROM tbl_obits WHERE mid(last_name, 1, ".$ln_len.") = '".$_GET['search']."' ORDER BY last_name,first_name";
	$criteria="For Last Names begining with '".ucfirst ($_GET['search'])."'." ;

	} elseif($_GET['dr']) {
	// Date range search in the form of YYYY-MM. "-01" is concatenated to the $_GET value
	$arg=$_GET['dr'];
	$ndate = date("Y-m-d",strtotime(date("Y-m-d", strtotime($arg."-01")) . " +3 month"));
	$sql="SELECT * FROM tbl_obits WHERE dod >= '".$_GET['dr']."-01' AND dod < '".$ndate."' ORDER BY last_name,first_name";
	
	$stdate=date("F j, Y",	mktime(0, 0, 0, substr($_GET['dr'],5,2), 1, substr($_GET['dr'],0,4)));
	$enddate=date("F j, Y",	mktime(0, 0, -86400, substr($ndate,5,2), 1, substr($ndate,0,4)));
	$criteria="For the period ".$stdate." through ".$enddate.".";
	
	}else{
	// Default Behavior: Past 3months
	$ndate = date("Y-m-d",strtotime(date("Y-m-d", strtotime(date ("Y-m-d"))) . " -3 month"));	
	$sql="SELECT * FROM tbl_obits WHERE dod <= '".date ("Y-m-d")."' AND dod >= '".$ndate."' ORDER BY last_name,first_name";
	$criteria="For the Last 3 Months." ;
	}

print "<h1>Obituaries<br />";
print "<span style='font-size:10pt;'>".$criteria."</span></h1>";

//print $sql;


//Include Db connection script
include 'dbconn.php';

// Original generic SQL
// Select items from Db
//$sql = "SELECT * FROM tbl_obits ORDER BY last_name,first_name";

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
   echo stripslashes ( $row['full_text'])."</p>\n";
   echo "<hr size='1' noshade />\n";
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
