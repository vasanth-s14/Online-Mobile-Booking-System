<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
?>
<html>
<head>
    <title>Register</title>
    <style>
        * {
            font-family: sans-serif;
        }
        #f1 {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            width: 45%;
            border-radius: 5%;
            margin: auto;
            margin-top: 50px;
        }
        .a1 {
            height: 30px;
            width: 200px;
        }
        label {
            font-size: 20px;
            margin-left: 5px;
        }
        #s1 {
            height: 35px;
            width: 150px;
            background-color: #FF8C00;
            font-weight: bold;
            border-color: #FF8C00;
            font-size: 17px;
        }
        #p1 {
            color: red;
        }
    </style>
</head>
<body style="background-image:url('https://static.vecteezy.com/system/resources/previews/001/370/039/non_2x/online-shopping-concept-with-mobile-phone-free-vector.jpg')">
<div id="f1">
    <form style="margin-left:10%;padding:20px;" method="POST">
        <h1>Register</h1>
        <label>Name</label><br><br>
        <input type="text" name="reg" class="a1" placeholder="Name"><br><br>
        <label>Password</label><br><br>
        <input type="password" name="pass1" class="a1" placeholder="Password" id="ps1" onkeyup="pass()">
        <span style="color:red;" id="pr1"></span><br><br>
        <label>Confirm Password</label><br><br>
        <input type="password" name="pass2" class="a1" placeholder="Confirm Password" id="ps2" onkeyup="check()">
        <span style="color:red;" id="pr2"></span><br><br>
        <label>Phone Number</label><br><br>
        <input type="number" name="dep" placeholder="Phone Number" class="a1" id="phone" onkeyup="depi();">
        <p id="p1"></p><br>
        <label>Email</label><br><br>
        <input type="email" name="email" placeholder="Gmail" class="a1" id="email"><br><br>
        <input type="submit" href="Login.php" value="Create Account" name="submit" id="s1">
    </form>
</div>

<?php
if(isset($_POST["submit"])){
    session_start();
    $conn = new mysqli("localhost", "root", "", "Mobile_store");

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST["reg"];
    $pass1 = $_POST["pass1"];
    $pass2 = $_POST["pass2"];
    $ph = $_POST["dep"];
    $email = $_POST["email"];
    $c = rand(1, 999);
    $cus = $name . $c;

    // Validate password and phone number before proceeding
    if($pass1 !== $pass2) {
        echo "<p style='color:red;'>Passwords do not match</p>";
        exit;
    }

    if(strlen($ph) != 10) {
        echo "<p style='color:red;'>Phone number must be 10 digits</p>";
        exit;
    }

    // Load Composer's autoloader
    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                  // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';             // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                         // Enable SMTP authentication
        $mail->Username   = 'vasanth100ff@gmail.com';     // SMTP username
        $mail->Password   = 'eyoi gfep mxmk fyyp';        // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                          // TCP port to connect to

        //Recipients
        $mail->setFrom('vasanth100ff@gmail.com');
        $mail->addAddress($email); // Add a recipient

        //Content
        $mail->isHTML(true);                              // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'Hello <b>' . $name . '</b>, your unique code is <b>' . $cus . '</b>';
        $mail->AltBody = 'Your unique code is ' . $cus;

        $mail->send();
        echo 'Message has been sent';
        $mail->smtpClose();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Prepare and execute the SQL query
    $sql = $conn->prepare("INSERT INTO details (Name, Password, Phone_no, customer_id, email) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("sssss", $name, $pass1, $ph, $cus, $email);
    $sql->execute();

    if($sql){
        echo "<p style='color:green;'>Account created successfully</p>";
    } else {
        echo "<p style='color:red;'>Error creating account: " . $conn->error . "</p>";
    }
    if($sql) {
        // Redirect to Login.php if account creation is successful
        header("Location: Login.php");
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo "<p style='color:red;'>Error creating account: " . $conn->error . "</p>";
    }
    $conn->close();
   
}
?>

<script>
function depi() {
    var a = document.getElementById("phone").value;
    if (a.length > 10) {
        document.getElementById("p1").innerHTML = "Enter 10 numbers only";
        document.getElementById("phone").style.border = "5px solid red";
    } else {
        document.getElementById("p1").innerHTML = "";
        document.getElementById("phone").style.border = "5px solid green";
    }
}

function pass() {
    var b = document.getElementById("ps1").value;
    var ch3, ch4, format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/, format1 = /\d/;
    if (format.test(b)) {
        ch3 = true;
    } else {
        ch3 = false;
    }
    if (format1.test(b)) {
        ch4 = true;
    } else {
        ch4 = false;
    }
    if (b.length < 6 || !ch3 || !ch4) {
        document.getElementById("pr1").innerHTML = "!! Invalid password";
        document.getElementById("ps1").style.border = "5px solid red";
    } else {
        document.getElementById("pr1").innerHTML = "";
        document.getElementById("ps1").style.border = "5px solid green";
    }
}

function check() {
    var d = document.getElementById("ps1").value;
    var e = document.getElementById("ps2").value;
    if (d != e) {
        document.getElementById("pr2").innerHTML = "!! Mismatch Password";
        document.getElementById("ps2").style.border = "5px solid red";
    } else {
        document.getElementById("pr2").innerHTML = "";
        document.getElementById("ps2").style.border = "5px solid green";
    }
}
</script>
</body>
</html>
