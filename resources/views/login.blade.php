<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>BIEPlus | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet" />
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet" />
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet" />

    <style>
      .login_content img {
        width: 300px;
        margin: 10px auto 20px;
        display: block;
      }

      .password-wrapper {
        position: relative;
      }

      .password-wrapper input {
        padding-right: 40px; /* ruang untuk ikon */
      }

      .password-wrapper .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #888;
      }
      body.login {
        background: url('gambar/hero-img.jpg') no-repeat center center fixed;
        background-size: cover;
      }

      .login_wrapper {
      padding: 20px;
      border-radius: 12px;
      backdrop-filter: blur(50px); /* efek blur */
      margin-top: 170px; 
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
              <div class="password-wrapper">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />
                <span class="fa fa-eye toggle-password" id="togglePassword"></span>
              </div>
              <div style="text-align: center;">
                <div style="text-align: center;">
                  <div style="display: inline-block; background-color: #033263; border: 1px solid #ccc; padding: 2px 10px; border-radius: 6px;">
                    <button type="submit" class="btn btn-default submit" 
                            style="padding: 4px 12px; font-size: 14px; background-color: #033263; color: white; border: none; border-radius: 4px; transition: background-color 0.3s;">
                      Log in
                    </button>
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
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });
    </script>
  </body>
</html>
