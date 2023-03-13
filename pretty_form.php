<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
  font: 1em sans-serif;
  width: 200px;
  padding: 0;
  margin: 0 auto;
}

p * {
  display: block;
}

input[type="email"] {
  appearance: none;

  width: 100%;
  border: 1px solid #333;
  margin: 0;

  font-family: inherit;
  font-size: 90%;

  box-sizing: border-box;
}

/* This is our style for the invalid fields */
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
<form id="contact form" novalidate>
  <p>
    <label for="mail">
      <span>Please enter an email address:</span>
      <input type="email" id="mail" name="mail" required minlength="8" />
      <span id="error" class="error" aria-live="polite"></span>
    </label>
  </p>
  <button>Submit</button>
</form>
    <script>
        const form = document.getElementById("contact form");
        const email = document.getElementById("mail");
        const email_error = document.getElementById("error");

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

    </script>
</body>
</html>