<!--model-->
<?php
    include 'pdo_AUTHENTICATION.php';
    if(isset($_POST['email']) && isset($_POST['password']))
    {
        //hash password
        //store hash password and sanitized email
        $hashedPassword = hash("md5",$_POST['password']);
        
        $sql = "INSERT INTO user_account(email,passwordHash) values (:email,:hashedPassword);";
        try
        {
            $stmt = $pdo_authentication->prepare($sql);
            $stmt->execute(array(
                ':email' => $_POST['email'],
                ':hashedPassword' => $hashedPassword));
            echo "Signup successful! Welcome Aboard $_POST[email] ";
        }
        catch(Exception $ex)
        {
            echo ("Internal Error, contact support");
            error_log("sql error". $ex->getMessage());
        }
            
        //authenticate email
    }
?>

<!--view-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
    <style>
        /* This is our style for the invalid fields */
        input:valid {
            border-color: blue;
            background-color: #ADD8E6;
        }
        input:invalid {
        border-color: #900;
        background-color: #fdd;
        }

        input:focus:invalid {
        outline: none;
        }

        /* This is the style of our error messages */
        .error {
        width: 100%;
        padding: 0;

        font-size: 80%;
        color: white;
        background-color: #900;
        border-radius: 0 0 5px 5px;

        box-sizing: border-box;
        }

        .error.active {
        padding: 0.3em;
        }

    </style>
</head>
<body>
    <main>
        <table>
            <form id="signup form" novalidate action="http://localhost/first/user_auth_module/2_Signup.php" method="GET">
                <tr>
                    <td><input required focus type="text" id="fname" name="fname" placeholder="First Name" minlength="3" autocomplete="off"></td>
                </tr>
                <tr>
                    <td><span id="fname_error" class="error" aria-live="polite"></span></td>
                </tr>
                <tr>
                    <td><input required focus type="text" id="lname" name="lname" placeholder="Last Name" minlength="3" autocomplete="off"></td>
                </tr>
                <tr>    
                    <td><span id="lname_error" class="error" aria-live="polite"></span></td>
                </tr>
                <tr>
                    <td><input required type="email" id="email" name="email" placeholder="Email" minlength="8" autocomplete="off"></td>
                </tr>
                <tr>    
                    <td><span required id="email_error" class="error" aria-live="polite"></span></td>
                </tr>
                <tr>
                    <td><input required type="password" id="pw" name="password" placeholder="Password" minlength="8" autocomplete="off"></td>
                </tr>
                <tr>    
                    <td><span id="password_error" class="error" aria-live="polite"></span></td>
                </tr>
                <tr>
                    <td><button type="submit" id="sign up">sign up</button></td> 
                </tr>
                <tr>
                    <td><span>Already have an account? <span><a href="http://localhost/first/USER_Authentication_Project/Login.php">Log in</a></td>
                </tr>
            </form>
        </table>
    </main>
                <!--Client side input validation-->
    <script>
            //fname
            const fname = document.getElementById("fname");
            const fname_error = document.getElementById("fname_error");
            
            const form = document.getElementById("signup form");
            
            fname.addEventListener("input", (event) => {
                if(fname.validity.valid)
                {
                    fname_error.textContent = "";
                    fname_error.reset();
                }
                else 
                {
                    show_fname_error();
                } 
            });

            function show_fname_error()
            {
                //check there is no character or numbers
                let has_numbers = /\d/.test(fname.value);
                
                if(has_numbers)
                {
                    fname_error.textContent = "Your first name cannot contain numbers";
                }
                else if(fname.validity.valueMissing)
                {
                    fname_error.textContent = "You need to enter your First Name";
                }
                else if(fname.validity.tooShort)
                {
                    fname_error.textContent = `Your last name cannot be shorter than ${fname.minLength} 
                    characters long, you entered ${fname.value.length}`;
                }
            }
            //lname
            const lname = document.getElementById("lname");
            const lname_error = document.getElementById("lname_error")
            
            lname.addEventListener("input", (event) => {
                if(lname.validity.valid)
                {
                    lname_error.textContent = "";
                    lname_error.reset();
                }
                else
                {
                    show_lname_error();
                }
            });

            function show_lname_error()
            {
                let is_valid = /\d/.test(lname.value);
                if(is_valid)
                {
                    lname_error.textContent = "Your last name cannot contain numbers";
                }
                else if(fname.validity.valueMissing)
                {
                    lname_error.textContent = "You need to enter your Last Name";
                }
                else if(fname.validity.tooShort)
                {
                    lname_error.textContent = `Your last name cannot be shorter than ${lname.minLength} 
                    characters long, you entered ${lname.value.length}`;
                }  
            }
            //email
            const email = document.getElementById("email");
            const email_error = document.getElementById("email_error");

        email.addEventListener("input",(event) => {
            if(email.validity.valid)
            {
                email_error.textContent = "";
                email_error.reset();
            }
            else
            {
                show_error();
            }
        });

        function show_error()
        {
            if (email.validity.valueMissing) 
            {
                // If the field is empty,
                // display the following error message.
                email_error.textContent = "You need to enter an email address.";
            } 
            else if (email.validity.typeMismatch) 
            {
                // If the field doesn't contain an email address,
                // display the following error message.
                email_error.textContent = "Entered value needs to be an email address.";
            }
            else if (email.validity.tooShort)
            {
                // If the data is too short,
                // display the following error message.
                email_error.textContent = `Email should be at least ${email.minLength} characters; you entered ${email.value.length}.`;
            }
        }

        //password
        const pw = document.getElementsById("pw");
        const pw_error = document.getElementById("password_error");
            
        pw.addEventListener("input", (event) => {
            if(pw.validity.valid)
            {
                pw_error.textContent = "";
                pw_error.reset(); 
            }
            else
            {
                show_passowrd_error();
            }
        });

        function show_password_error()
        {
            let is_valid = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/.test(pw.value);
            let has_uppercase = /[A-Z]/.test(pw.value);
            let has_lowercase = /[a-z]/.test(pw.value);
            let has_digit = /\d/.test(pw.value);
            let has_symbols = /^[!@#\$%\^\&*\)\(+=._-]+$/.test(pw.value);

            if(pw.validity.valueMissing)
            {
                pw.textContent = "Password cannot be empty";
            }
            else if(has_uppercase)
            {
                pw.textContent = "Password must contain atleast one Uppercase letter";
            }
            else if(has_lowercase)
            {
                pw.textContent = "Password must contain atleast one Lowercase letter";
            }
            else if(has_digit)
            {
                pw.textContent = "Password must contain atleast one digit";
            }
            else if(has_symbols)
            {
                pw.textContent = "Password must contain atleast one symbol";
            }
            else if(pw.validity.tooShort)
            {
                pw.textContent = `Password must be atleast ${pw.minLength} characters, you entered only ${pw.value.length} characters`;
            }
        }
        //form submittion
            form.addEventListener("submit", (event) => {
                if(!fname.validity.valid)
                {
                    show_fname_error();
                    event.preventDefault();
                }
                if(!lname.validity.valid)
                {
                    show_lname_error();
                    event.preventDefault();
                }
                if(!email.validity.valid)
                {
                    show_email_error();
                    event.preventDefault();
                }                
            });
    </script>    
</body>
</html>

<!--controller-->
<?php

?>