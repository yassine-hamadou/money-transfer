<?php
include '../includes/db.php'; // include db connection
include '../includes/functions.php';  // include functions 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


session_start();

if (isset($_POST["signup"])) {
    // Validate and sanitize user input
    $fn = filter_var($_POST["fname"], FILTER_SANITIZE_STRING);
    $ln = filter_var($_POST["lname"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
    $dob = filter_var($_POST["dob"], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
    $nationality = filter_var($_POST["nationality"], FILTER_SANITIZE_STRING);
    $state = filter_var($_POST["state"], FILTER_SANITIZE_STRING);
    $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
    $accBal = 0;
    $cvc = random_int(100000, 100000000);

    // Prepare the SQL statement using a prepared statement
    $stmt = mysqli_prepare($db, "SELECT * FROM customer WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    // Handle errors and display user-friendly error message if query fails
    if (!$stmt) {
        $error = mysqli_error($db);
        echo "Oops! An error occurred: " . $error;
    } else {
        $result = mysqli_stmt_get_result($stmt);

        // Add user to database if they are not already registered
        if (mysqli_num_rows($result) == 0) {

//            $mailObj = new PHPMailer;
//            $to = $email;
//            $subject = "Your CVC Code";
//            $msg = "Hello $fn, Your account was created successfully. This is your ".$cvc." You will need to enter your CVC code during transactions. Please make sure you do not loose it and keep it secret. Thank you!";
//            $mailObj->AddAddress($to, $fn);
//            $mailObj->SetFrom('yassinehamadou@gmail.com', 'BORNASEND');
//            $mailObj->Subject = $subject;
//            $mailObj->AltBody = 'To view the message, please use an HTML compatible email viewer!';
//            $mailObj->MsgHTML($msg);
//
//            // SMTP Settings
//            $mailObj->isSMTP();                                      // Set mailer to use SMTP
//            $mailObj->Host = 'smtp.gmail.com;smtp.gmail.com';  // Specify main and backup SMTP servers
//            $mailObj->SMTPAuth = true;                               // Enable SMTP authentication
//            $mailObj->Username = 'yassinehamadou1@gmail.com';                 // SMTP username
//            $mailObj->Password = 'Yassine134666';                           // SMTP password
//            $mailObj->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//            $mailObj->Port = 587;

//            if(!$mailObj->Send())
//    {
//        $_SESSION["error_msg"] = "Account not created, CVC!";
//        header("Location: ../html/signupa.php?error=notcreated");
//        exit();
//    }
//    else
//    {
            $stmt = mysqli_prepare($db, "INSERT INTO customer (f_name, l_name, email, phone, dob, addr, nation, state, pwd, acct_bal, cvc) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssssssssssi", $fn, $ln, $email, $phone, $dob, $address, $nationality, $state, $pwd, $accBal, $cvc);
            mysqli_stmt_execute($stmt);

            // Handle errors and display user-friendly error message if insert fails
            if (!$stmt) {
                mysqli_stmt_close($stmt);
                mysqli_close($db);
                $error = mysqli_error($db);
                echo "Oops! An error occurred: " . $error;
            } else {
                mysqli_stmt_close($stmt);
mysqli_close($db);
                $_SESSION["success_msg"] = "Account created successfully!";
                header("Location: ../html/loginpage.php?error=none");
                exit();
            }
        } else {
            echo "User is already registered.";
        }
//    }
    }






//    if () {
//    } else {
//    }
    
    //generating cvc code
//    try {
//        $cvc = random_int(100000, 100000000);
//    } catch (Exception $e) {
//        echo "error";
//        exit();
//    }
    
//    $mailObj = new PHPMailer;
//    $to = $email;
//    $subject = "Your CVC Code";
//    $msg = "Hello $fn, Your account was created successfully. This is your ".$cvc." You will need to enter your CVC code during transactions. Please make sure you do not loose it and keep it secret. Thank you!";
//    $mailObj->AddAddress($to, $fn);
//    $mailObj->SetFrom('yassinehamadou@gmail.com', 'BORNASEND');
//    $mailObj->Subject = $subject;
//    $mailObj->AltBody = 'To view the message, please use an HTML compatible email viewer!';
//    $mailObj->MsgHTML($msg);
//
//    // SMTP Settings
//    $mailObj->isSMTP();                                      // Set mailer to use SMTP
//    $mailObj->Host = 'smtp.gmail.com;smtp.gmail.com';  // Specify main and backup SMTP servers
//    $mailObj->SMTPAuth = true;                               // Enable SMTP authentication
//    $mailObj->Username = 'yassinehamadou1@gmail.com';                 // SMTP username
//    $mailObj->Password = 'Yassine134666';                           // SMTP password
//    $mailObj->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//    $mailObj->Port = 587;

//    if(!$mailObj->Send())
//    {
//        $_SESSION["error_msg"] = "Account not created, CVC!";
//        header("Location: ../html/signupa.php?error=notcreated");
//        exit();
//    }
//    else
//    {
//        create_user($db, $fn, $ln, $email, $phone, $dob, $address, $nationality, $state, $pwd, $accBal, $cvc);
//    }
}

else {
    header("Location: ../html/signupa.php");
    exit();
}
