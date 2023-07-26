<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>pesanTiket</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/cover/">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

    
    <!-- Axsios -->
    <script src="vendor/axios/axios.min.js"></script>

    <!-- VueJs -->
    <script src="vendor/vuejs/vue.global.min.js "></script>

    <!-- Sweetalert -->
    <script src="vendor/sweetalert/sweetalert.min.js"></script>

<link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center text-bg-dark">
    
<div id="app" class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">pesanTiket</h3>
    </div>
  </header>

  <main class="px-3">
    <h1>Pesan Tiket Tanpa Ribet</h1>
    <p class="lead">Sekarang pesan tiket gak harus rusuh!<br> Untuk pemesanan tiket konser bisa klick Booking</p>
    <p class="lead">
      <a href="#" class="btn btn-lg btn-light fw-bold border-white bg-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Booking</a>
    </p>
  </main>

  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-dark" id="staticBackdropLabel">Isi biodata anda</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="row g-3 needs-validation" novalidate>
                <div class="col-md-12">
                  <input type="text" class="form-control" required v-model="nama" placeholder="Nama Lengkap" :class="[activeClassNama]">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" v-model="email" required placeholder="Email" :class="[activeClassEmail]">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" v-model="nomer_hp" required placeholder="Nomer HP" :class="[activeClassNope]">
                </div>
                <div class="col-md-12">
                  <textarea class="form-control" v-model="alamat" required placeholder="Alamat" :class="[activeClassAlamat]"></textarea>
                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" v-on:click="btnReset()">Batal</button>
          <button type="button" class="btn btn-primary" v-on:click="btnSave()">Proses</button>
        </div>
      </div>
    </div>
  </div>
  

  <footer class="mt-auto text-white-50">
    <p> &copy; <a href="/dashboard" class="text-white">psnTiket</a> by @krh.</p>
  </footer>
</div>


<script>
    const { createApp } = Vue
  
    createApp({
    data() {
      return {
        nama : '',
        email : '',
        nomer_hp : '',
        alamat : '',
        activeClassNama : '',
        activeClassEmail : '',
        activeClassNope : '',
        activeClassAlamat : ''
  
      }
    },
    methods: {
      btnSave(){
        if (this.nama == '') {
          this.activeClassNama = 'is-invalid';
        }else if (this.email == '') {
          this.activeClassEmail = 'is-invalid';
        }else if (this.nomer_hp == '') {
          this.activeClassNope = 'is-invalid';
        }else if (this.alamat == '') {
          this.activeClassAlamat = 'is-invalid';
        }else{
          var form_data = new FormData();
          form_data.append('nama', this.nama);
          form_data.append('email', this.email);
          form_data.append('nomer_hp', this.nomer_hp);
          form_data.append('alamat', this.alamat);
          axios.post('master-tiket-save', form_data)
          .then(resp => {
            swal({
              title: 'Simpan',
              text: 'Data berhasil disimpan.',
              icon: 'success',
              timer: 2000,
              buttons: false,
            })
            .then(() => {
                location.href='/';
            })
            
          })
          .catch(err => {
            swal("Gagal memproses!","","warning");
            console.log(form_data);
          })
        }
      },
      btnReset(){
        this.activeClassNama = '';
        this.activeClassEmail = '';
        this.activeClassNope = '';
        this.activeClassAlamat = '';
        this.nama = this.email = this.nomer_hp = this.alamat = '';
      },
      btnBack(){
        location.href="/products";
      }
    }
  }).mount('#app')
  </script>
    
  </body>
</html>
