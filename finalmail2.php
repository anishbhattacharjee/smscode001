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
$query12 = mysqli_query($conn1, "SELECT * 
FROM serverstatus
WHERE id IN (SELECT id FROM serverstatus WHERE date = (SELECT MAX(date) FROM serverstatus))
ORDER BY id DESC
");
    
 $message ='';

$data   = $query12->fetch_all(MYSQLI_ASSOC);
//   while ($row=mysqli_fetch_array($query12)) {
       
       //echo nl2br("\n\n");     
       foreach ($data as $row)
{
       $string_version = implode('-->', $row);
       // echo $string_version;
       // echo nl2br("\n\n");  
       $message .=("\n\n").
           
           
("ID2 - ")  .$row['id'].(" | ")
           .
("WEBSITE NAME - ")
.$row['website_name'].(" | ")
           .
("  STATUS -  ")
.$row['status'].(" | ")
                 .
("  DATE  - ")
.$row['date'];


       }


mail($toEmail,
         'SERVER STATUS',
          $message,
         'From: anishjiodgp@gmail.com');
 }

?>