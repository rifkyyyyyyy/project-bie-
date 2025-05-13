@extends('layout.sidebar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')
<style>
    .form-section {
        max-width: 700px;
        margin-left: 20px;
        padding: 20px 30px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .form-section h4 {
        font-weight: bold;
        color: #2A3F54;
        margin-top: 30px;
        margin-bottom: 20px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 5px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 6px;
        color: #333;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-check {
        margin-top: 15px;
    }

    .form-check input {
        margin-right: 8px;
    }

    .btn-group {
        margin-top: 25px;
    }

    .btn-group button {
        margin-right: 10px;
    }
    .right_col h3.text-center {
  color: rgb(255, 255, 255);
}
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="container mt-4">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <h3 class="mb-4 text-center">Form Reservasi</h3>
  
          <div class="card shadow-sm p-4" style="margin-bottom: 30px;">
            <form id="demo-form2" data-parsley-validate class="needs-validation" novalidate>
              <!-- Biodata Diri -->
              <h5 class="mb-3"><strong>Biodata Diri</strong></h5>
  
              <div class="mb-3">
                <label for="namaLengkap" class="form-label"><strong>Nama Lengkap</strong></label>
                <input type="text" class="form-control" id="namaLengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
              </div>

              <div class="mb-3">
                <label for="kamar" class="form-label"><strong>Jenis Kelamin</strong></label>
                <select class="form-select" id="kamr" name="kamar" required>
                  <option value="1">Laki - laki</option>
                  <option value="7">Perempuan</option>
                </select>
              </div>
  
              <div class="mb-3">
                <label for="alamatEmail" class="form-label"><strong>Alamat Email</strong></label>
                <input type="email" class="form-control" id="alamatEmail" name="email" placeholder="example@gmail.com" required>
              </div>
  
              <div class="mb-3">
                <label for="nomorHP" class="form-label"><strong>Nomor HP (WA)</strong></label>
                <input type="tel" class="form-control" id="nomorHP" name="no_hp" placeholder="0812XXXXXXXX" required>
              </div>
  
              <div class="mb-4">
                <label for="asalkota" class="form-label"><strong>Asal Kota</strong></label>
                <input type="text" class="form-control" id="asalkota" name="asal_kota" placeholder="Asal Kota" required>
              </div>
  
              <!-- Lain-lain -->
              <h5 class="mb-3"><strong>Lain-lain</strong></h5>
  
              <div class="mb-3">
                <label for="periodeMasuk" class="form-label"><strong>Periode Masuk</strong></label>
                <input type="date" class="form-control" id="periodeMasuk" name="periode_masuk" required>
              </div>

              <div class="mb-3">
                <label for="periodeMasuk" class="form-label"><strong>Periode Keluar</strong></label>
                <input type="date" class="form-control" id="periodeMasuk" name="periode_masuk" required>
              </div>
  
              <div class="mb-3">
                <label for="lamaMenginap" class="form-label"><strong>Lama Menginap</strong></label>
                <select class="form-select" id="lamaMenginap" name="lama_menginap" required>
                  <option value="1">1 Hari</option>
                  <option value="7">1 Minggu</option>
                  <option value="14">2 Minggu</option>
                  <option value="30">1 Bulan</option>
                  <option value="60">2 Bulan</option>
                  <option value="90">3 Bulan</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="kamar" class="form-label"><strong>Kamar</strong></label>
                <select class="form-select" id="kamr" name="kamar" required>
                  <option value="1">VVIP</option>
                  <option value="7">VIP</option>
                  <option value="14">Barack</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="nomor_kamarr" class="form-label"><strong>Nomor Kamar</strong></label>
                <select class="form-select" id="nomor_kamar" name="nomor_kamar" required>
                
                </select>
              </div>
  
              <div class="form-check mb-4">
                <input type="checkbox" class="form-check-input" id="agreement" required>
                <label class="form-check-label" for="agreement">
                  Saya menyetujui <a href="#" class="text-warning">tata tertib dan ketentuan</a> yang berlaku
                </label>
              </div>
  
              <div class="d-flex justify-content-end gap-4">
                <button class="btn btn-secondary" type="button">Cancel</button>
                <button class="btn btn-danger" type="reset">Reset</button>
                <button class="btn btn-success" type="submit">Submit</button>
              </div>                
            </form>
          </div>
  
        </div>
      </div>
    </div>
  </div>
  
<!-- /page content -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
