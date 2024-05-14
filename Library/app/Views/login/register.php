<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Simple Registration Form Example</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-form {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      padding: 40px;
      width: 350px;
    }

    .login-form h1 {
      margin-bottom: 30px;
      text-align: center;
      color: #333;
    }

    .input-field {
      margin-bottom: 20px;
    }

    .input-field input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .error-message {
      color: #e74c3c;
      font-size: 14px;
    }

    .action {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .action-button {
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .action-button:hover {
      background-color: #333;
      color: #fff;
    }
  </style>
</head>

<body>
  <div class="login-form">
    <form action="<?= site_url('register/create') ?>" method="post" onsubmit="return validateForm()">
      <h1>Register</h1>
      <div class="content">
        <div class="input-field">
          <input type="text" name="name" id="name" placeholder="Username" autocomplete="off" required>
          <span class="error-message" id="name-error"></span>
        </div>
        <div class="input-field">
          <input type="text" name="fullName" id="fullName" placeholder="Full Name" autocomplete="off" required>
          <span class="error-message" id="fullName-error"></span>
        </div>
        <div class="input-field">
          <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" required>
          <span class="error-message" id="email-error"></span>
        </div>
        <div class="input-field">
          <input type="password" name="password" id="password" placeholder="Password" autocomplete="new-password" required>
          <span class="error-message" id="password-error"></span>
        </div>
      </div>
      <div class="action">
        <button type="submit" class="action-button">Register</button>
        <a href="<?= site_url('login') ?>" class="action-button">Sign In</a>
      </div>
    </form>
  </div>
  <script>
    function validateForm() {
      var name = document.getElementById("name").value;
      var fullName = document.getElementById("fullName").value;
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;

      var isValid = true;

      // Name validation
      if (name.trim() == "") {
        document.getElementById("name-error").innerText = "Username is required";
        isValid = false;
      } else {
        document.getElementById("name-error").innerText = "";
      }

      // Full Name validation
      if (fullName.trim() == "") {
        document.getElementById("fullName-error").innerText = "Full Name is required";
        isValid = false;
      } else {
        document.getElementById("fullName-error").innerText = "";
      }

      // Email validation
      if (email.trim() == "") {
        document.getElementById("email-error").innerText = "Email is required";
        isValid = false;
      } else {
        document.getElementById("email-error").innerText = "";
      }

      // Password validation
      if (password.trim() == "") {
        document.getElementById("password-error").innerText = "Password is required";
        isValid = false;
      } else {
        document.getElementById("password-error").innerText = "";
      }

      return isValid;
    }
  </script>
</body>

</html>
