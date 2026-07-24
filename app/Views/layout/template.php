<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Dashboard'); ?> | Inventory Hub</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --bg-main: #f0f4f8;
            --primary-emerald: #0d9488;
            --primary-hover: #0f766e;
            --accent-teal: #14b8a6;
            --dark-slate: #0f172a;
            --light-card: rgba(255, 255, 255, 0.85);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-main);
            background-image: 
                radial-gradient(at 0% 0%, rgba(20, 184, 166, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(13, 148, 136, 0.08) 0px, transparent 50%);
            background-attachment: fixed;
            color: #334155;
        }

        /* Navbar Glassmorphism Modern */
        .navbar-custom {
            background: rgba(15, 23, 42, 0.85) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
            font-size: 1.3rem;
        }

        .nav-link {
            transition: all 0.3s ease;
            border-radius: 8px;
            padding: 8px 16px !important;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #2dd4bf !important;
        }

        /* Efek Kartu Glassmorphism */
        .glass-card {
            background: var(--light-card);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 16px;
            box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            box-shadow: 0 20px 40px -15px rgba(13, 148, 136, 0.15);
        }

        /* Tombol Modern & Gradien Sejuk */
        .btn-emerald {
            background: linear-gradient(135deg, var(--accent-teal), var(--primary-emerald));
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 22px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px rgba(13, 148, 136, 0.3);
        }

        .btn-emerald:hover {
            background: linear-gradient(135deg, var(--primary-emerald), #0f766e);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 148, 136, 0.4);
        }

        .btn-action {
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-action:hover {
            transform: scale(1.05);
        }

        /* Floating Alert Animation */
        .custom-alert {
            border-radius: 12px;
            border: none;
            backdrop-filter: blur(10px);
        }

        /* Footer Modern */
        footer {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(8px);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand text-white d-flex align-items-center gap-2" href="/">
                <div class="bg-teal p-2 rounded-3 d-inline-flex align-items-center justify-content-center" style="background: var(--primary-emerald); width: 36px; height: 36px;">
                    <i class="fa-solid fa-boxes-stacked text-white fs-6"></i>
                </div>
                <span>Inventory<span style="color: #2dd4bf;">Hub</span></span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white-50 <?= uri_string() == '' ? 'active text-white fw-semibold' : ''; ?>" href="/">
                            <i class="fa-solid fa-house me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white-50 <?= uri_string() == 'products' ? 'active text-white fw-semibold' : ''; ?>" href="/products">
                            <i class="fa-solid fa-box me-1"></i> Produk
                        </a>
                    </li>

                    <?php if (session()->get('isLoggedIn')) : ?>
                        <li class="nav-item dropdown ms-lg-2">
                            <a class="nav-link dropdown-toggle text-white bg-white bg-opacity-10 px-3 py-2 rounded-3 border border-white border-opacity-10" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-circle-user text-teal me-1" style="color: #2dd4bf;"></i> <?= session()->get('username'); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 animate__animated animate__fadeInUp animate__faster">
                                <li class="px-3 py-2">
                                    <div class="small text-muted">Akses Login</div>
                                    <div class="fw-bold text-dark"><i class="fa-solid fa-shield-halved text-success me-1"></i><?= strtoupper(session()->get('role')); ?></div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger fw-medium" href="/logout">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-emerald btn-sm" href="/login">
                                <i class="fa-solid fa-right-to-bracket me-1"></i> Login
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="container my-5 flex-grow-1 animate__animated animate__fadeIn">
        <?= $this->renderSection('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="py-3 text-center text-muted mt-auto">
        <div class="container">
            <small class="fw-medium">&copy; <?= date('Y'); ?> <strong>InventoryHub</strong> — Sleek & Modern Experience</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>