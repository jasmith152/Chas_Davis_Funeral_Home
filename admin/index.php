<?php
$cfgProgDir = 'phpSecurePages/';
include($cfgProgDir . "secure.php");

// Set some more variables
$PHP_SELF = $_SERVER['PHP_SELF'];
if (!empty($_GET['id'])) { $id = $_GET['id']; }
if (!empty($_POST['id'])) { $id = $_POST['id']; }
if (!empty($_GET['action'])) { $action = $_GET['action']; }
if (!empty($_POST['action'])) { $action = $_POST['action']; }
if (!empty($_GET['msg'])) { $msg = $_GET['msg']; }
if (!empty($_POST['msg'])) { $msg = $_POST['msg']; }
if (!empty($_GET['error'])) { $error = $_GET['error']; }
if (!empty($_POST['error'])) { $error = $_POST['error']; }

//Include Db connection script
include '../dbconn.php';

if (empty($action)) {
   // Display current items
   $page_title = "All Current Obituaries";
   include 'header.php';
 echo "<h1>$page_title</h1>\n";
 if (!empty($msg)) {
    echo "<p class='msg'>$msg</p>\n";
 }
 echo "<div align='center'><table width='90%' border='0' cellpadding='2' cellspacing='2'>\n";
 echo " <tr>\n";
 echo "  <td><div class='column_header'>Name</div></td>\n";
 echo "  <td><div class='column_header'>Age</div></td>\n";
 echo "  <td><div class='column_header'>Location</div></td>\n";
 echo "  <td><div class='column_header'>Edit/Delete</div></td>\n";
 echo " </tr>\n";

 // Select items from Db
 $sql = "SELECT id,last_name,first_name,city,state,age FROM tbl_obits";
 $sql .= " ORDER BY last_name,first_name";
 $result = @mysql_query($sql);
 if (!$result) {
    echo("<p>Error performing query: " . mysql_error() . "</p>");
    exit();
 }
 while ($row = @mysql_fetch_array($result)) {
    echo " <tr>\n";
    echo "  <td><div class='column_data'>".$row['last_name'].", ".$row['first_name']."</div></td>\n";
    echo "  <td><div class='column_data'>".$row['age']."</div></td>\n";
    echo "  <td><div class='column_data'>".$row['city'].", ".$row['state']."</div></td>\n";
    echo "  <td><div class='column_data_centered'><a href='$PHP_SELF?action=edit&id=".$row['id']."'>Edit</a> <a href='$PHP_SELF?action=delete&id=".$row['id']."' onclick=\"confirmMsg('".$row['id']."');return false;\">Delete</a></div></td>\n";
    echo " </tr>\n";
 }

 echo "</table></div>\n";
 echo "<h2>Add New Obituary</h2>\n";
   echo "<p class='instructions'>Required fields indicated by *.</p>\n";
   echo "    <form action='$PHP_SELF' method='post' name='obituary'>\n";
   echo "    <table width='550' cellspacing='2' cellpadding='2' border='0'>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'>*Last Name </td>\n";
   echo "      <td align='left' valign='top'><input type='text' size='20' name='Last_Name' /></td>\n";
   echo "     </tr>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'>*First Name </td>\n";
   echo "      <td align='left' valign='top'><input type='text' size='20' name='First_Name' /></td>\n";
   echo "     </tr>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'>Middle Initial </td>\n";
   echo "      <td align='left' valign='top'><input type='text' size='2' name='Middle_Initial' /></td>\n";
   echo "     </tr>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'>City </td>\n";
   echo "      <td align='left' valign='top'><input type='text' size='20' name='City' /></td>\n";
   echo "     </tr>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'>State </td>\n";
   echo "      <td align='left' valign='top'><input type='text' size='4' name='State' /></td>\n";
   echo "     </tr>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'>*Age </td>\n";
   echo "      <td align='left' valign='top'><input type='text' size='2' name='Age' /></td>\n";
   echo "     </tr>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'>*Date of Death</td>\n";
   echo "      <td align='left' valign='top'><input type='text' size='10' name='dod' /> (YYYY/MM/DD)</td>\n";
   echo "     </tr>\n";
   echo "      <td colspan='2' align='left' valign='top'>Full Obituary Text<br /><br />\n";
   echo "       <textarea name='full_text' rows='6' cols='60'></textarea>\n";
   echo "      </td>\n";
   echo "     </tr>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'></td>\n";
   echo "      <td align='left' valign='top'><input type='submit' name='submit' value='Save Changes' /> &nbsp; <input type='reset' name='reset' value='Cancel Changes' /></td>\n";
   echo "     </tr>\n";
   echo "    </table>\n";
   echo "    <input type='hidden' name='action' value='insert' />\n";
   echo "    </form>\n";
 // Include footer nav
 include 'footer.php';

} else {
 // Execute requested action
 switch ($action) {

  // *** Edit ***
  case 'edit':
   // Edit actions go here
   $page_title = "Edit Item";
   include 'header.php';
   
   // Select item from Db
   $sql_edit = "SELECT * FROM tbl_obits WHERE id = '$id'";
   $result_edit = @mysql_query($sql_edit);
   if (!$result_edit) {
      echo("<p>Error performing query: " . mysql_error() . "</p>");
      exit();
   }
   $row_edit = @mysql_fetch_array($result_edit);
   
   echo "<h1>$page_title</h1>\n";
   /* Debugging info
   echo "<p>\n";
   echo "sql_edit: $sql_edit<br />\n";
   echo "</p>\n"; */
   if (!empty($msg)) { echo "<p class='msg'>$msg</p>\n"; }
   if (!empty($error)) { echo "<p class='error'>$error</p>\n"; }
   echo "<p class='instructions'>Required fields indicated by *.</p>\n";
   echo "    <form action='$PHP_SELF' method='post' name='obituary'>\n";
   echo "    <table width='550' cellspacing='2' cellpadding='2' border='0'>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'>*Last Name </td>\n";
   echo "      <td align='left' valign='top'><input type='text' size='20' name='Last_Name' value='".$row_edit['last_name']."' /></td>\n";
   echo "     </tr>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'>*First Name </td>\n";
   echo "      <td align='left' valign='top'><input type='text' size='20' name='First_Name' value='".$row_edit['first_name']."' /></td>\n";
   echo "     </tr>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'>Middle Initial </td>\n";
   echo "      <td align='left' valign='top'><input type='text' size='2' name='Middle_Initial' value='".$row_edit['middle_initial']."' /></td>\n";
   echo "     </tr>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'>City </td>\n";
   echo "      <td align='left' valign='top'><input type='text' size='20' name='City' value='".$row_edit['city']."' /></td>\n";
   echo "     </tr>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'>State </td>\n";
   echo "      <td align='left' valign='top'><input type='text' size='4' name='State' value='".$row_edit['state']."' /></td>\n";
   echo "     </tr>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'>*Age </td>\n";
   echo "      <td align='left' valign='top'><input type='text' size='2' name='Age' value='".$row_edit['age']."' /></td>\n";
   echo "     </tr>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'>*Date of Death </td>\n";
   echo "      <td align='left' valign='top'><input type='text' size='10' name='dod' />  (YYYY/MM/DD)</td>\n";
   echo "     </tr>\n";
   echo "     <tr>\n";
   echo "      <td colspan='2' align='left' valign='top'>Full Obituary Text<br /><br />\n";
   echo "       <textarea name='full_text' rows='6' cols='60'>".$row_edit['full_text']."</textarea>\n";
   echo "      </td>\n";
   echo "     </tr>\n";
   echo "     <tr>\n";
   echo "      <td align='right' valign='top'></td>\n";
   echo "      <td align='left' valign='top'><input type='submit' name='submit' value='Save Changes' /> &nbsp; <input type='reset' name='reset' value='Cancel Changes' /></td>\n";
   echo "     </tr>\n";
   echo "    </table>\n";
   echo "    <input type='hidden' name='id' value='$id' />\n";
   echo "    <input type='hidden' name='action' value='update' />\n";
   echo "    </form>\n";
   
   // Include footer nav
   include 'footer.php';
   
  break;

  // *** Insert ***
  case 'insert':
   // Update actions go here
   //Check for errors
   if (empty($_POST['Last_Name']) || empty($_POST['First_Name']) || empty($_POST['Age']) || empty($_POST['dod'])) {
      header("Location: $PHP_SELF?id=$id&action=edit&error=Required field missing.");
      exit;
   }
      /* Debugging info
      $msg .= "file_name: $file_name<br />";
      $msg .= "uploadfile: $uploadfile<br />"; */
      
      //Prepare variables for the Db
      
      // Insert the data
      $sql = "INSERT INTO tbl_obits SET 
         last_name='".addslashes($_POST['Last_Name'])."',
         first_name='".addslashes($_POST['First_Name'])."',
         middle_initial='".addslashes($_POST['Middle_Initial'])."',
         age='".addslashes($_POST['Age'])."',
         city='".addslashes($_POST['City'])."',
         state='".addslashes($_POST['State'])."',
		 dod='".addslashes($_POST['dod'])."',
         full_text='".addslashes($_POST['full_text'])."'";
      if (mysql_query($sql)) {
         $msg .= "Obituary has been created.";
         header("Location: $PHP_SELF?msg=$msg");
         exit;
      } else {
         $error = "There was a problem adding this obituary: " . mysql_error();
      }
  break;

  // *** Update ***
  case 'update':
   // Update actions go here
   //Check for errors
   if (empty($_POST['Last_Name']) || empty($_POST['First_Name']) || empty($_POST['Age']) || empty($_POST['dod'])) {
      header("Location: $PHP_SELF?id=$id&action=edit&error=Required field missing.");
      exit;
   }
      /* Debugging info
      $msg .= "file_name: $file_name<br />";
      $msg .= "uploadfile: $uploadfile<br />"; */
      
      //Prepare variables for the Db
      
      // Insert the data
      $sql = "UPDATE tbl_obits SET 
         last_name='".addslashes($_POST['Last_Name'])."',
         first_name='".addslashes($_POST['First_Name'])."',
         middle_initial='".addslashes($_POST['Middle_Initial'])."',
         city='".addslashes($_POST['City'])."',
         state='".addslashes($_POST['State'])."',
         age='".addslashes($_POST['Age'])."',
		 dod='".addslashes($_POST['dod'])."',
         full_text='".addslashes($_POST['full_text'])."'";
      $sql .= " WHERE id = '$id'";
      if (mysql_query($sql)) {
         $msg .= "Obituary has been updated.";
         header("Location: $PHP_SELF?msg=$msg");
         exit;
      } else {
         $error = "There was a problem updating this obituary: " . mysql_error();
      }
  break;

  // *** Delete ***
  case 'delete':
   // Delete actions go here
   $sql_delete = "DELETE FROM tbl_obits WHERE id='$id'";
   if (@mysql_query($sql_delete)) {
      header("Location: $PHP_SELF?msg=Item deleted.");
      exit;
   } else {
      echo("<p class='error'>Error deleting item: " . mysql_error() . "</p>");
   }

  break;
  default:
   header("Location: ".$PHP_SELF);
  break;
 }
}

/* Free result sets */
if (!empty($result)) { mysql_free_result($result); }
if (!empty($result_edit)) { mysql_free_result($result_edit); }
/* Closing connection */
mysql_close($dbcnx);
?>
