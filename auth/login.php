<?php
require_once "../_config/config.php";
if(isset($_SESSION['user'])) {
    echo "<script>window.location='".base_url()."';</script>";
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN - RUMAH SAKIT</title>
    <link href="<?=base_url('_assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link class="icon" href="<?=base_url('_assets/yukcoding.png')?>">
    
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f7f6;
        }
        .login-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: flex;
            min-height: 500px;
        }
        /* Sisi Gambar */
        .login-bg {
            background-image: url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&q=80&w=800');
            background-size: cover;
            background-position: center;
            width: 50%;
            position: relative;
        }
        .login-bg::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(0, 123, 255, 0.4), rgba(40, 167, 69, 0.2));
        }
        /* Sisi Form */
        .login-form-side {
            width: 50%;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .brand-section {
            text-align: center;
            margin-bottom: 30px;
        }
        .brand-section img {
            max-height: 70px; /* Sedikit dinaikkan agar ikon bangunan rumah sakit terlihat jelas */
            margin-bottom: 15px;
        }
        .brand-section h2 {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }
        .brand-section p {
            color: #7f8c8d;
            font-size: 14px;
            margin-top: 5px;
        }
        /* Form Overrides */
        .input-group {
            margin-bottom: 20px;
            width: 100% !important;
        }
        .form-control {
            height: 45px;
            border-radius: 0 6px 6px 0 !important;
            border: 1px solid #dce4ec;
            box-shadow: none !important;
        }
        .input-group-addon {
            background-color: #f8fafc;
            border: 1px solid #dce4ec;
            border-right: none;
            border-radius: 6px 0 0 6px !important;
            color: #7f8c8d;
            min-width: 46px;
        }
        .btn-login {
            background-color: #0284c7;
            border: none;
            color: white;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 6px;
            width: 100%;
            transition: background 0.2s;
        }
        .btn-login:hover {
            background-color: #0369a1;
            color: white;
        }
        /* Responsif untuk HP */
        @media (max-width: 768px) {
            .login-bg {
                display: none;
            }
            .login-form-side {
                width: 100%;
                padding: 30px;
            }
            .login-card {
                margin: 20px;
                min-height: auto;
            }
        }
    </style>
</head>
<body>

    <div class="container login-container">
        <div class="login-card">
            
            <div class="login-bg"></div>
            
            <div class="login-form-side">
                
                <div class="brand-section">
                    <img src="https://cdn-icons-png.flaticon.com/512/8815/8815112.png" alt="Logo Rumah Sakit">
                    <h2>Sistem Informasi</h2>
                    <p>Silakan masuk ke akun Rumah Sakit Anda</p>
                </div>

                <?php
                if(isset($_POST['login'])) {
                    $user = trim(mysqli_real_escape_string($con, $_POST['user']));
                    $pass = sha1(trim(mysqli_real_escape_string($con, $_POST['pass'])));
                    $sql_login = mysqli_query($con, "SELECT * FROM tb_user WHERE username = '$user' AND password = '$pass'") or die (mysqli_error($con));
                    if(mysqli_num_rows($sql_login) > 0) {
                        $_SESSION['user'] = $user;
                        echo "<script>window.location='".base_url()."';</script>";
                    } else { ?>
                        <div class="alert alert-danger alert-dismissable" role="alert" style="border-radius: 6px; margin-bottom: 20px;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <strong>Login Gagal!</strong> Username atau Password salah.
                        </div>
                    <?php
                    }
                }
                ?>

                <form action="" method="post">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" name="user" class="form-control" placeholder="Username" required autofocus>
                    </div>
                    
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" name="pass" class="form-control" placeholder="Password" required>
                    </div>
                    
                    <button type="submit" name="login" class="btn btn-login">
                        Masuk Sistem <i class="glyphicon glyphicon-log-in" style="margin-left: 5px;"></i>
                    </button>
                </form>
                
            </div>
            
        </div>
    </div>

    <script src="<?=base_url('_assets/js/jquery.js')?>"></script>
    <script src="<?=base_url('_assets/js/bootstrap.min.js')?>"></script>
</body>
</html>
<?php
}
?>