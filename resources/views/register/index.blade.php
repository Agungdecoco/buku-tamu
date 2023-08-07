<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="css/styleregister.css"> --}}
    <title>Registration</title>

    
</head>

<body class="hold-transition login-page" style="background-image: radial-gradient( circle farthest-corner at 84.6% 77.8%,  rgba(86,89,218,1) 0%, rgba(95,208,248,1) 90% );">
  <div class="register-box">
      <div class="card">
          <div class="card-header">
              <ul class="nav d-felx justify-content-center">
                  <a href="/" class="brand-link"><img src="assets/img/logokominfo.png" class="brand-image"></a>
              </ul>
          </div>
          <div class="card-body ">
              <form action="{{ route('register') }}" method="post">
                @csrf
              <div class="form-horizontal">
                <div class="form-group row mt-4 mb-1">
                  <label for="username" class="col-sm-4 col-form-label">NIP</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                      <input type="text" class="form-control rounded-top @error('nip') is-invalid @enderror" placeholder="NIP" name="nip">
                      @error('nip')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                </div>
                
                <div class="form-group row mb-1">
                  <label for="name" class="col-sm-4 col-form-label">Nama</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                      <input type="text" class="form-control rounded-top @error('nama_tamu') is-invalid @enderror" placeholder="Nama" name="nama_tamu">
                      @error('nama_tamu')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                </div>
                
                <div class="form-group row mb-1">
                  <label for="notlp" class="col-sm-4 col-form-label">No Tlp</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                      <input type="text" class="form-control rounded-top @error('tlp_tamu') is-invalid @enderror" placeholder="Nomor Telepon" name="tlp_tamu">
                      @error('tlp_tamu')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="form-group row mb-1">
                  <label for="email" class="col-sm-4 col-form-label">Email</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                      <input type="email" class="form-control rounded-top @error('email') is-invalid @enderror" placeholder="Email" name="email">
                      @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                </div>
                
                <div class="form-group row mb-1">
                  <label for="jabatab_tamu" class="col-sm-4 col-form-label">Jabatan</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                      <input type="text" class="form-control rounded-top @error('jabatab_tamu') is-invalid @enderror" placeholder="Jabatan" name="jabatan_tamu">
                      @error('jabatan_tamu')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="form-group row mb-1">
                  <label for="instansi" class="col-sm-4 col-form-label">Instansi</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                      <input type="text" class="form-control rounded-top @error('instansi') is-invalid @enderror" placeholder="Instansi" name="instansi">
                      @error('instansi')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                </div>
                
                <div class="form-group row mb-1">
                  <label for="status" class="col-sm-4 col-form-label">Status</label>
                  <div class="col-sm-8">
                    <select class="form-control " label=". example" name="status">
                      <option selected>Open this select menu</option>
                      <option value="VIP">Operator/Verifikator</option>
                      <option value="NONVIP">Lainnya</option>
                  </select>
                  </div>
                </div>

                <div class="form-group row mb-1">
                  <label for="password" class="col-sm-4 col-form-label">Password</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                      <input type="password" class="form-control rounded-top @error('password') is-invalid @enderror" placeholder="Password" name="password">
                      @error('password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="text-center mt-3">
                  <input type="submit" class="btn" style="background-color: #577BC1" value="Registrasi"/>
                </div>
                
                <div class="text-center mt-3">
                    <p>Sudah Terdaftar?<a href="/login"> Login</a></p>
                </div>

              </div> 

              </form>
          </div>
      </div>
  </div>
</body>

<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/dist/js/demo.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
</html>
