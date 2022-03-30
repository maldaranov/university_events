<?php
    if (isset($_POST['submit'])) {
        require 'server.php'; // grab the database

        // INPUT
        $firstname = $_POST['firstName'];
        $lastname = $_POST['lastName'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPass = $_POST['confirmPassword'];
        $roleId = 0;

        // check for empty fields
        if (empty($firstname)) {
            // is firstname field empty
            header("location: ../register.php?error=emptyfield&firstname=".$firstname);
            exit();
        } elseif (empty($lastname)) {
            // is lastname field empty
            header("location: ../register.php?error=emptyfield&lastname=".$lastname);
            exit();
        } elseif (empty($email)) {
             // is email field empty
             header("location: ../register.php?error=emptyfield&email=".$email);
             exit();
            // is username field empty
        } elseif (empty($username)) {
            header("location: ../register.php?error=emptyfield&username=".$username);
            exit();
            // is password field empty
        } elseif (empty($password)) {
            header("location: ../register.php?error=emptyfield&password=".$password);
            exit();
            // is confirmPass field empty
        } elseif (empty($confirmPass)) {
            header("location: ../register.php?error=emptyfield&confirmPass=".$confirmPass);
            exit(); 

        // fields' character restrictions
        } elseif (!preg_match("/^[a-zA-Z0-9]*/",$username)) {
            header("location: ../register.php?error=invalidusername&username=".$username);
            exit();
            // restrict the firstname to the a-zA-Z
        } elseif (!preg_match("/^[a-zA-Z]*/", $firstname)) {
            header("location: ../register.php?error=invalidfirstname&firstName=".$firstName);
            exit();
            // restrict the lastname to the a-zA-Z
        } elseif (!preg_match("/^[a-zA-Z]*/", $lastname)) {
            header("location: ../register.php?error=invalidlastname&lastName=".$lastName);
            exit();

        
        // check if password is the same as confirmPass
        } elseif ($password !== $confirmPass) {
            header("location: ../register.php?error=passwordsdonotmatch&:".$confirmPass."<->".$confirmPass);
            exit();

        // REGISTRATION
        } else {
            // create a query
            $query = "SELECT username FROM user WHERE username = ?";
            // create a statement
            $stmt = mysqli_stmt_init($db);
            // check is statement was prepared
            if (!mysqli_stmt_prepare($stmt, $query)) {
                header("location: ../register.php?error=sqlerror");
                exit();
            } else {
                // CHECK: USERNAME EXISTS
                    // bind the parameters to the statement that we want to check in the databaase
                mysqli_stmt_bind_param($stmt, "s", $username);
                    // execute the previously set $stmt statement
                mysqli_stmt_execute($stmt); 
                    // stores the result from the database in the $stmt
                mysqli_stmt_store_result($stmt);
                    // count the rows in the resulting $stmt
                $rowCount = mysqli_stmt_num_rows();
                // if there is already such username (rowCount > 0), then error
                if (rowCount > 0) {
                    header("location: ../register.php?error=usernametaken");
                    exit();

                // REGISTER
                } else {
                    // create a query
                    $query = "INSERT INTO user (username, password, email, firstName, lastName, roleId) VALUES (?, ?, ?, ?, ?, ?)";
                    // create a statement
                    $stmt = mysqli_stmt_init($db);
                    // check if statement was prepared
                    if (!mysqli_stmt_prepare($stmt, $query)) {
                        header("location: ../register.php?error=sqlerror");
                        exit();
                    } else {
                        // * hash the password and bind it if you want it hashed
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        // insert all the data from the registration form into the database
                        mysqli_stmt_bind_param($stmt, "sssssi", $username, $password, $email, $firstname, $lastname, $roleId);
                        mysqli_stmt_execute($stmt);
                        header("location: ../login.php?success=registered");
                        exit();
                    }
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
?>