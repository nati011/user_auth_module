<!--model-->
<?php
    include 'pdo_AUTHENTICATION.php';
    if(isset($_POST['email']) && isset($_POST['password']))
    {
        //validate input

        //hash password
        $hashedpassword = hash("sha-512",$_POST['password']);
        $sql = "SELECT concat firstName,lastName from user_account where email = :email AND hashedPassword = :hashedPassword";
        try
        {
            $stmt = $pdo_authentication->prepare($sql);
            $stmt->execute(array(
                ':email' => $_POST['email'],
                ':hashedPassword' => $hashedPassword));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row = '')
            {
                echo "empty result";
            }
            echo "hello".$row['firstName'].' '.$row['lastName'];
        }
        catch(Exception $ex)
        {
            echo ("Internal Error, contact support");
            error_log("sql error". $ex->getMessage());
            
        }
        
    }
?>

<!--view-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN</title>
    <style>
        input + span {
  position: relative;
}

input:required + span::after {
  font-size: 0.7rem;
  position: absolute;
  content: "required";
  color: white;
  background-color: black;
  padding: 5px 10px;
  top: -26px;
  left: -70px;
}
    </style>
    
<body>
    <main>
        <table>
            <form action="http://localhost/first/USER_Authentication_Project/Login.php" method="POST">
                
                <tr>
                    <td><input required focus type="text" id="email" name="email" placeholder="email" autocomplete="off"></td>
                </tr>
                <tr>
                    <td><input required type="password" id="pw" name="password" placeholder="password" autocomplete="off"></td>
                </tr>
                <tr>
                    <td><input type="submit" id="Log in" value="Log in"></td> 
                </tr>
                <tr>
                    <td><a>No Account?</a><a href="http://localhost/first/USER_Authentication_Project/Signup.php">Create One</a></td>
                </tr>

            </form>
        </table>
    </main>    
</body>
</html>

<!--controller-->
<?php

?>