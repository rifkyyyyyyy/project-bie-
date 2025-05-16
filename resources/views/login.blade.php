<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BIEPlus | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <style>
      .login_content img {
        width: 300px;
        margin: 10px auto;
        display: block;
        margin-bottom: 20px;
      }
      /* Tambahan styling untuk tombol toggle */
      #togglePassword {
        margin-top: 5px;
      }
    </style>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
        <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="login-image">
                <img src="gambar/logo.png" alt="Login Image" />
              </div>
              <div>
                    <input type="email" name="email" class="form-control" placeholder="Email" required autofocus />
              </div>
              <div>
               <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />
                <button type="button" id="togglePassword" class="btn btn-secondary btn-sm">Show Password</button>
              </div>
              <div>
                <button type="submit" class="btn btn-default submit">Log in</button>
                <a class="reset_pass" href="{{ route('akun.gantiPasswordForm', 11) }}">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <p>©2025 All Rights Reserved. BIEPlus is a Bootstrap. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>

    <script>
      const togglePassword = document.querySelector('#togglePassword');
      const password = document.querySelector('#password');

      togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.textContent = type === 'password' ? 'Show Password' : 'Hide Password';
      });
    </script>
  </body>
</html>
