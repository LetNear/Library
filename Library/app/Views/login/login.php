<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Simple Login Form Example</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
  <style>
    body {
      background-color: #f4f4f9; /* Light lavender background */
      color: #333;
      font-family: 'Rubik', sans-serif;
    }

    .login-form {
      background-color: white;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      padding: 20px;
      width: 300px;
      margin: 50px auto;
    }

    .login-form h1 {
      color: #5c677d; /* Soft dark gray */
    }

    .login-form .input-field input {
      border: 2px solid #ced4da;
      padding: 8px 12px;
      border-radius: 4px;
      width: calc(100% - 24px); /* Full width minus padding */
      box-sizing: border-box; /* Includes padding and border in width */
    }

    .login-form .action button, .login-form .action a {
      background-color: #8aacc8; /* Soft blue */
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 16px;
      font-weight: bold;
      text-decoration: none;
      display: inline-block;
      transition: background-color 0.3s, transform 0.2s;
    }

    .login-form .action button:hover, .login-form .action a:hover {
      background-color: #557a95; /* Deeper blue */
    }

    .login-form .social-login a {
      background-color: #dd4b39; /* Google's brand red */
      color: white;
      padding: 10px 15px;
      border-radius: 5px;
      display: block;
      text-align: center;
      margin-top: 20px;
      transition: background-color 0.3s;
    }

    .login-form .social-login a:hover {
      background-color: #c23321; /* Darker red */
    }
  </style>
</head>

<body>
  <div class="login-form">
    <form action="<?= site_url('/login/authenticate') ?>" method="POST"> <!-- Traditional login -->
      <h1>Login</h1>
      <div class="content">
        <div class="input-field">
          <input type="email" name="email" placeholder="Email" autocomplete="nope">
        </div>
        <div class="input-field">
          <input type="password" name="password" placeholder="Password" autocomplete="new-password">  
        </div>
      </div>
      <div class="action">
        <a class="action-button" href="<?= site_url('register') ?>">Register</a>
        <button type="submit">Sign in</button>
      </div>
    </form>
  
  </div>
  <script src="<?= base_url("public/aset/js"); ?>/script.js"></script>
</body>

</html>
