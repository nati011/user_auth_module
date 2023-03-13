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
            <form novalidate action="http://localhost/first/USER_Authentication_Project/Signup.php" method="GET">
                <tr>
                    <td><input required focus type="text" id="fname" name="fname" placeholder="First Name" minlength="3" autocomplete="off"></td>
                    <span id="fname_error" class="error" aria-live="polite"></span>
                </tr>
                <tr>
                    <td><input required focus type="text" id="lname" name="lname" placeholder="Last Name" autocomplete="off"></td>
                    
                </tr>
                <tr>
                    <td><input required type="text" id="email" name="email" placeholder="Email" autocomplete="off"></td>
                </tr>
                <tr>
                    <td><input required type="password" id="pw" name="password" placeholder="Password" autocomplete="off"></td>
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
            const fname = document.getElementById("fname");
            const fname_error = document.querySelector(".error");
            
            const submit = document.getElementById("sign up");
            
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

            submit.addEventListener("submit", (event) => {
                if(!fname.validity.valid)
                {
                    show_fname_error();
                    event.preventDefault();
                }
            });
            function show_fname_error()
            {
                const is_valid = /\d/.test(fname.value);
                if(is_valid)
                {
                    fname_error.textContent = "Your name cannot contain numbers";
                }
                else if(fname.validity.valueMissing)
                {
                    fname_error.textContent = "You need to enter your First Name";
                }
                else if(fname.validity.tooShort)
                {
                    fname_error.textContent = `Your name cannot be shorter than ${fname.minLength} 
                    characters long, you entered ${fname.value.length}`;
                }
            }
    </script>    
</body>
</html>

<!--controller-->
<?php

?>