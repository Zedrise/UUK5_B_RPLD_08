<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Tiket Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #008148;
            --secondary-color: #d6c0b3;
            --color-belakang: #0ba5d4;
            --form-bg: rgba(255, 255, 255, 0.95);
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        body {
            background: var(--color-belakang);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        .auth-box {
            width: 900px;
            height: 500px;
            background: var(--form-bg);
            margin: 0 auto;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            box-shadow: var(--shadow);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: fadeInUp 0.8s ease;
        }

        .left {
            width: 50%;
            padding: 50px 40px;
            transition: var(--transition);
            position: relative;
            overflow-y: auto; /* Menambahkan scroll vertikal jika konten terlalu panjang */
            overflow-x: hidden;
        }

        .right {
            width: 50%;
           
            background: linear-gradient(135deg, rgba(0,129,72,0.3) 0%, rgba(214,192,179,0.3) 100%), url('{{ asset('images/login.jpg') }}') center/cover no-repeat;
            position: relative;
        }

        .right::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
        }

        .form-container {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .form-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            transition: transform 0.6s ease, opacity 0.6s ease;
        }

        .form-slide.hidden {
            transform: translateX(-100%);
            opacity: 0;
        }

        h3 {
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
            font-size: 1.8rem;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-group label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 16px;
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 129, 72, 0.1);
            background: #fff;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        .form-control:focus + i {
            color: var(--primary-color);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary-color) 0%, #00a65a 100%);
            color: #fff;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            transition: var(--transition);
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 129, 72, 0.4);
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .switch-text {
            text-align: center;
            margin-top: 25px;
            color: #666;
        }

        .switch-btn {
            cursor: pointer;
            color: var(--primary-color);
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .switch-btn:hover {
            color: #00a65a;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .auth-box {
                width: 95%;
                height: auto;
                flex-direction: column;
            }
            .left, .right {
                width: 100%;
                height: 50%;
            }
            .left {
                padding: 30px 20px;
            }
            .right {
                height: 200px;
            }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

<div class="auth-box">
    <!-- FORM -->
    <div class="left">
        <div class="form-container">
            <!-- LOGIN -->
            <div id="loginForm" class="form-slide">
                <h3>Masuk Akun</h3>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                        <i class='bx bx-envelope'></i>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <i class='bx bx-lock-alt'></i>
                    </div>

                    <button class="btn btn-submit mt-3">Login</button>
                </form>

                <p class="switch-text">
                    Belum punya akun?
                    <span class="switch-btn" onclick="showRegister()">Daftar</span>
                </p>
            </div>

            <!-- REGISTER -->
            <div id="registerForm" class="form-slide hidden">
                <h3>Daftar Akun Baru</h3>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" required>
                        <i class='bx bx-user'></i>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                        <i class='bx bx-envelope'></i>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <i class='bx bx-lock-alt'></i>
                    </div>

                    <!-- Role otomatis pelanggan -->
                    <input type="hidden" name="role" value="pelanggan">

                    <button class="btn btn-submit mt-3">Register</button>
                </form>

                <p class="switch-text">
                    Sudah punya akun?
                    <span class="switch-btn" onclick="showLogin()">Login</span>
                </p>
            </div>
        </div>
    </div>

    <!-- GAMBAR -->
    <div class="right"><img src="" alt=""></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function showRegister() {
        const loginForm = document.getElementById("loginForm");
        const registerForm = document.getElementById("registerForm");
        loginForm.classList.add("hidden");
        registerForm.classList.remove("hidden");
    }

    function showLogin() {
        const loginForm = document.getElementById("loginForm");
        const registerForm = document.getElementById("registerForm");
        registerForm.classList.add("hidden");
        loginForm.classList.remove("hidden");
    }
</script>

</body>
</html>
