<?php


$servername = "bigperl.cqhgvggnarsv.us-east-2.rds.amazonaws.com";
$username = "root";
$password = "bigperlroot";
$dbname = "sms";

// Create connection
$conn1 = new mysqli($servername, $username, $password, $dbname);

$sql7 = mysqli_query($conn1, "SELECT email_id FROM notification_table");
while($email=mysqli_fetch_array($sql7)){
     $string_version = implode('-->', $email);
    $toEmail =$email['email_id'];
     
//Email complete Table
 // $query12 = mysqli_query($conn1, "SELECT * FROM serverstatus order by id desc");
$query12 = mysqli_query($conn1, "SELECT website_name,date,GROUP_CONCAT( status) status1 FROM serverstatus WHERE id IN (SELECT id FROM serverstatus WHERE date = (SELECT MAX(date) FROM serverstatus)) GROUP BY website_name
");
    
 $message ='';
$message='<html>
    <head>
       </head>
    <body>
    <table  border="1">
     <tr><th style="width:300px;">WEBSITE NAME</th><th  style="width:500px;">STATUS</th><th  style="width:100px;">DATE</th></table>
    </body>
    </html>'   ;
$data   = $query12->fetch_all(MYSQLI_ASSOC);
//   while ($row=mysqli_fetch_array($query12)) {
       
       //echo nl2br("\n\n");     
       foreach ($data as $row)
{
       $string_version = implode('-->', $row);
       // echo $string_version;
       // echo nl2br("\n\n");  
         $message .= '
    <html>
    <head>
      
    </head>
    <body>
     <table  border="1">
     <tr><td style="width:300px;">'.$row['website_name'].'</td><td style="width:500px;">'.$row['status1'].'</td><td style="width:100px;">'.$row['date'].'</td></tr> </table>
     </body>
    </html>' ;
           
           $headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
$headers .= "From: SERVER_STATUS <anishjiodgp@gmail.com>\r\n";

       }
      // echo $message;

mail($toEmail,
         'SERVER STATUS',
          $message,
       $headers);
 }

?>