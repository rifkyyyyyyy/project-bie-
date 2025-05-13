<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard')</title>

  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  @stack('styles')
  <style>
    * {
      box-sizing: border-box;
    }

    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      overflow: hidden;
    }

    .wrapper {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }
    .main-area {
      margin-left: 200px;
      width: calc(100% - 200px);
      
      display: flex;
      flex-direction: column;
    }

    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      height: 70px;
      width: 100%;
      background-color: #1E73E8;
      z-index: 1000;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .nav-link:hover {
      background-color: #e4e9f0;
      border-radius: 8px;
    }

    .main-content-scrollable {
      margin-top: 70px;
      height: calc(100vh - 70px);
      overflow-y: auto;
      padding: 20px;
      background-color: #1265cb;
    }

/* Khusus halaman calendar */
    .main-content-scrollable.calendar-page {
      margin-top: 0;
      padding-top: 70px;
    }



    .sidebar {
      position: fixed;
      top: 70px; /* geser ke bawah sejajar navbar */
      width: 200px;
      background-color: #F7F7F9;
      height: calc(100vh - 70px); /* sesuaikan tinggi supaya tidak keluar layar */
      box-shadow: 4px 0 10px rgba(0, 0, 0, 0.15);
      z-index: 999;
      
    }

    .sidebar a {
      color: rgb(100, 100, 100);
      text-decoration: none;
    }

    .sidebar .nav-link {
      display: flex;
      align-items: center;
      padding: 10px 12px;
      font-size: 16px;
      line-height: 2.5;
    }

    .sidebar-profile a {
      font-size: 16px;
      text-decoration: none;
      color: #656c72 !important;
      padding: 4px 0;
      display: block;
    }

    .sidebar-profile a:hover {
      color: #0d6efd !important;
    }

    .profile_info {
      padding-left: 12px;
      margin-bottom: 1.5rem;
    }

    .profile_info h2 {
      font-size: 1.5rem;
      margin: 0;
      text-align: left;
      color: #1F397D;
    }

    .marquee {
      width: 100%;
      overflow: hidden;
      background-color: #1E73E8;
      padding: 10px 0;
      position: relative;
    }

    .marquee-content {
      display: inline-block;
      white-space: nowrap;
      position: absolute;
      will-change: transform;
      animation: marqueeAnim 20s linear infinite;
      font-weight: bold;
      color: #ffffff;
      font-size: 1rem;
    }

    @keyframes marqueeAnim {
      0% { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }

    .dropdown-toggle::after {
      margin-left: 8px;
    }

    .dropdown-menu {
      font-size: 0.95rem;
    }

    .logo-area {
      width: 244px;
      height: auto; /* biar menyesuaikan tinggi konten */
      padding: 14px 0; /* atau kurangi lagi jika ingin lebih rapat */
      background-color: #ffffff;
      display: flex;
      align-items: flex-start; /* ini yang penting: ratakan ke atas */
      justify-content: center;
      top: -10px;
      position: relative;
    }


  </style>
</head>

<body>

  <!-- NAVBAR -->
  <nav class="navbar d-flex align-items-center" style="height: 70px;">
    <div class="d-flex w-100 align-items-center justify-content-between">
      
      <!-- LOGO -->
          <div class="logo-area">
            <a href="/">
              <img src="{{ asset('gambar/logo.png') }}" alt="Logo" style="max-height: 44px;">
            </a>
          </div>

  
      <!-- MARQUEE -->
      <div class="marquee flex-grow-1 d-flex align-items-center px-3">
        <div class="marquee-content text-white">
          Selamat Datang Admin di Sistem Informasi Manajemen Akupansi Brilliant International Education - Kampung Inggris Pare
        </div>
      </div>
  
      <!-- LOGOUT -->
      <div class="d-flex align-items-center gap-4 px-3">
        <a href="/logout" class="text-white" title="Logout">
          <i class="fas fa-sign-out-alt fa-lg"></i>
        </a>
      </div>
    </div>
  </nav>
  

  <!-- WRAPPER -->
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
      <div class="sidebar-profile mb-4 ps-2">
        <div id="profileToggle" class="d-flex align-items-center justify-content-between" style="cursor: pointer;">
          <div class="d-flex align-items-center">
            <img src="{{ asset('gambar/img.jpg') }}" alt="Profile" class="rounded-circle me-2" style="width: 50px; height: 50px;">
            <div>
              <div class="fw-semibold text-dark">Briliant</div>
              <div class="text-muted fw-semibold" style="font-size: 0.875rem;">Administrator</div>
            </div>
          </div>
          <i class="fas fa-chevron-down me-2 text-muted"></i>
        </div>

        <div class="collapse mt-3 ps-4" id="profileDropdown">
          <a href="#" class="d-block text-dark mb-2">My Profile</a>
          <a href="#" class="d-block text-dark mb-2">Edit Profile</a>
          <a href="#" class="d-block text-dark">Settings</a>
        </div>
      </div>

      <!-- Menu -->
      <ul class="nav nav-pills flex-column">
        <li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link"><i class="fa fa-home me-2"></i> Dashboard</a></li>
        <li class="nav-item"><a href="{{ url('/reservasi') }}" class="nav-link"><i class="fa fa-edit me-2"></i> Reservasi</a></li>
        <li class="nav-item"><a href="{{ url('/table') }}" class="nav-link"><i class="fa fa-table me-2"></i> Data</a></li>
        <li class="nav-item"><a href="{{ url('/calendar') }}" class="nav-link"><i class="fa fa-calendar me-2"></i> Calendar</a></li>
        <li class="nav-item"><a href="{{ url('/akun') }}" class="nav-link"><i class="fa fa-user me-2"></i> Akun</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-area">
      <div class="main-content-scrollable {{ request()->is('calendar') ? 'calendar-page' : '' }}">
        @yield('content')
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toggle = document.getElementById('profileToggle');
      const dropdown = document.getElementById('profileDropdown');
      toggle.addEventListener('click', function () {
        const collapseInstance = bootstrap.Collapse.getOrCreateInstance(dropdown);
        dropdown.classList.contains('show') ? collapseInstance.hide() : collapseInstance.show();
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  @stack('scripts')
</body>
</html>
