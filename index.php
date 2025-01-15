<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
    <link rel="stylesheet" href="./index.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="bg-warning">

    <div class="container mt-5 bg-info-subtle rounded-4">
    <form method="post">
        <div class="mb-3">
            <label class="form-label mt-4">First Name</label>
            <input class="form-control" name="firstName" id="firstName">
          </div>
    
          <div class="mb-3">
            <label class="form-label">last Name</label>
            <input class="form-control" name="lastName">
          </div>
    
          
        <div class="mb-3">
            <label class="form-label">User Name</label>
            <input type="text" class="form-control" name="userName" id="userName">
          </div>
    
        <div class="mb-3">
            <label  class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
          </div>
    
        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" oninput="confirmPassowrdonInput()" onchange="confirmPassowrdonChange()">
            <i class="fa-solid fa-eye" onclick="onclickShowIcon()" id="showIcon"></i>
            <i class="fa-solid fa-eye-slash" onclick="onclickHideIcon()" id="hideIcon"></i>
          </div>
    
        <button name="submit" type="submit" class="btn btn-primary mb-4">Submit</button>
      </form>
<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "charoltte";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  // die("Connection failed: " . $conn->connect_error);
  echo $conn->connect_error;
}
// $submit = $_POST['submit'];

function sendMai($firstName, $userName){



    require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'shaik949131@gmail.com';                 // SMTP username
$mail->Password = 'tsoi sdur laxz vbhn';              // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('shaik949131@gmail.com', 'Mailer');
$mail->addAddress($firstName, $userName);     // Add a recipient
// $mail->addAddress('ellen@example.com');               // Name is optional
// $mail->addReplyTo('info@example.com', 'Information');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'test mail..';
$mail->Body    = 'This is the HTML message body <b>in bold!' . $userName . '</b>';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

}

if (isset($_POST['submit'])){
 $firstName  = $_POST['firstName'];
 $lastName  = $_POST['lastName'];
 $userName  = $_POST['userName'];
 $password  = $_POST['password'];
 $confirmPassword  = $_POST['confirmPassword'];



echo "onClick submit button";
 echo $firstName;
 echo $lastName;
 echo $userName;
 echo $password;
 echo $confirmPassword;

 $sql = "INSERT INTO `registrationform`(firstName, `lastName`, `userName`, `password`) VALUES ('$firstName', '$lastName', '$userName','$password')";

 $sqlInsertStatus = $conn->query($sql);
 if($sqlInsertStatus){



  sendMai($firstName , $userName);
  echo "<script>Swal.fire({title: 'User register done',icon: 'success',draggable: true});</script>";

 }
}

?>
      <script>
        
        function onclickSubmit(event){
            event.preventDefault(); 
            // var el= document.getElementById("firstName");
            // var firstName =;
            var lastName = document.getElementsByName("lastName")[0].value;  
            var userName = document.getElementsByName("userName")[0].value;
            var password = document.getElementsByName("password")[0].value;
            var confirmPassword = document.getElementsByName("confirmPassword")[0].value;
            

            var objToStr='';
            var userList = {                    
                firstName : document.getElementById("firstName").value,
                lastName: lastName,
                userName: userName,
                password: password,
                confirmPassword: confirmPassword
            }

            objToStr = JSON.stringify(userList)
            console.log("localStorageItem", objToStr);
           
            if(confirmPassword == password){

              if(localStorage.getItem(userName)){
                console.log("user already there!")

                Swal.fire({
                    title: "User already register",
                    icon: "error",
                    draggable: true
                    });
            }

            else{
                localStorage.setItem(userName, objToStr);
                 window.location.href = "./login.html";}
              
            }

            else{
              Swal.fire({
                    icon: "error",
                    text: "Password not match",
                  });
              
              console.log("password not match")
            }
            
        }

        function onclickShowIcon(){
          console.log("icon visible")

          var confirmPassword = document.getElementsByName("confirmPassword")[0];
          console.log(confirmPassword);

         var cPassword = confirmPassword.type="text";
          console.log(cPassword);

          document.getElementById("showIcon").style.display = "none";
          document.getElementById("hideIcon").style.display = "inline";

        }

        function onclickHideIcon(){
          console.log("hide password");
          var confirmPassword = document.getElementById("confirmPassword");
          console.log(confirmPassword);

          confirmPassword.type="password";
          document.getElementById("hideIcon").style.display = "none";
          document.getElementById("showIcon").style.display = "inline";
        }


      






























        function confirmPassowrdonChange(){
          console.log("onchangeEvent");
        }

        
        function confirmPassowrdonInput(){
          console.log("confirmPassowrdonInput");
          document.getElementById("showIcon").style.display="inline";
        }


        
      </script>
    </div>
</body>
</html>
