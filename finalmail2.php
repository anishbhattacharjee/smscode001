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
//           $message .=("\n\n").
//("ID2  ")  .("               WEBSITE NAME ")
//           .
//  ("                                             STATUS             ")
//.("                                               DATE             ").("\n\n")
//           .
//$row['id'].("            ")
//.$row['website_name'].("                                      ")
//                 .
//$row['status'].("                                  ")
//.$row['date'].("\n\n");
            
//    $message ="<html>
//<head>
//  <title>Birthday Reminders for August</title>
//</head>
//<body>
//  <p>Here are the birthdays upcoming in August!</p>
//  <table>
//    <tr>
//      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
//    </tr>
//    <tr>
//      <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
//    </tr>
//    <tr>
//      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
//    </tr>
//  </table>
//</body>
//</html>";
//$headers  = 'MIME-Version: 1.0' . "\r\n";
//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$headers .= 'From: anishjiodgp@gmail.com' . "\r\n";

       }
       echo $message;

mail($toEmail,
         'SERVER STATUS',
          $message,
         'From: anishjiodgp@gmail.com');
 }

?>