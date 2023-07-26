@extends('main')

@section('container')

<div id="app" class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom-secondary">
        <h1 class="h3 mb-0 text-gray-800"> Dashboard</h1>
        <div>
            <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalBiodata">
                <i class="fas fa-cart-plus fa-sm text-white-50"></i> Pesan
            </a> &nbsp;
            <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalChekIn">
                <i class="fas fa-receipt fa-sm text-white-50"></i> Chek-in
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Tiket</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">@{{ totalTiket }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-receipt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tiket Chek-in</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">@{{ totalChekIn }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-sign-in-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Belum Chek-in</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">@{{ belumChekIn }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
  <!-- Modal Chek-in -->
  <div class="modal fade" id="modalChekIn" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalChekInLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark cardTiket" id="staticBackdropLabel">Tiket Konser</h5>
          <input type="text" class="form-control col-7 col-sm-9 form-control-sm btnValid"  v-model="idTiket" v-on:keyup="inputIdTiket()" placeholder="ID Tiket...">
          <a href="#" v-on:click="btnChekIn()" class="btn btn-primary btn-sm btnValid" :class="[classChekIn]" >Chek-in <i class="fa fa-sign-in-alt fa-sm"></i></a>
          <button type="button" class="close" v-on:click="btnReset()" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body cardTiket" v-for="data in dataTiket">
          <div class="card mb-12" style="max-width: 540px;">
            <div class="row g-0">
              <div class="col-md-12 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <div class="card-body col-md-10 col-10">
                  <h5 class="card-title">@{{ data.idTiket }}</h5>
                    <table class="card-text" style="width: 100%">
                      <tr><td>Nama    </td><td>: @{{ data.nama }}     </td></tr>
                      <tr><td>Email   </td><td>: @{{ data.email }}    </td></tr>
                      <tr><td>Telepon </td><td>: @{{ data.nomer_hp }} </td></tr>
                      <tr><td>Alamat  </td><td>: @{{ data.alamat }}   </td></tr>
                    </table>
                </div>
                <button type="button" class="card-body col-md-2 col-2 btn btn-primary" v-on:click="btnChekInValid(data.id)" style="height: 100%"><i class="fa fa-sign-in-alt"></i></button>
              </div>
            </div>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
  </div>
  

  <!-- Modal Boodata -->
  <div class="modal fade" id="modalBiodata" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalChekInLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="staticBackdropLabel">Biodata Pemesan</h5>
          <button type="button" v-on:click="btnReset()" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <form>
                <div class="form-group">
                  <input type="text" class="form-control form-control-sm" id="inputNama" placeholder="Nama Lengkap" v-model="nama" required  :class="[activeClassNama]">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" id="inputEmail" placeholder="Email" v-model="email" required  :class="[activeClassEmail]">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" id="inputNope" placeholder="Nomer Hp" v-model="nomer_hp" required :class="[activeClassNope]">
                  </div>
                </div>
                <div class="form-group">
                  <textarea class="form-control form-control-sm" id="inputAlamat" placeholder="Alamat" v-model="alamat" required  :class="[activeClassAlamat]"></textarea>
                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" v-on:click="btnReset()" data-dismiss="modal" aria-label="Close">Batal</button>
          <button type="button" class="btn btn-primary" v-on:click="btnSave()">Proses</button>
        </div>
      </div>
    </div>
  </div>


</div>

    
<script>
    const { createApp } = Vue
  
    createApp({
      
      data() {
        return {  
            idTiket : '',
            classChekIn : 'disabled',
            classValid : 'hidden',
            dataTiket : [],
            
            nama : '',
            email : '',
            nomer_hp : '',
            alamat : '',
            activeClassNama : '',
            activeClassEmail : '',
            activeClassNope : '',
            activeClassAlamat : '',

            totalTiket : '',
            totalChekIn : '',
            belumChekIn : ''
  
        }
      },
      mounted() {
        $(".cardTiket").hide();
        this.getTotal();
      },
      methods: {
        getTotal(){
          axios.get('master-tikets-total')
          .then(resp=> {
            this.totalTiket = resp.data.totalTiket;
            this.totalChekIn = resp.data.totalChekIn;
            this.belumChekIn = resp.data.belumChekIn;
          })
        },
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
                    location.href='/dashboard';
                })
                
            })
            .catch(err => {
                swal("Gagal memproses!","","warning");
                console.log(form_data);
            })
            }
        },
        btnChekInValid(id){
          axios.get('master-tiket-chekIn',{
            params:{
              id : id
            }
          }).then(resp=>{
              swal({
                title: 'Chek-in',
                text: ' ',
                icon: 'success',
                timer: 2000,
                buttons: false,
              })
              .then(() => {
                  location.href='/tikets';
              })
  
          })
        },
        btnReset(){
            this.activeClassNama = '';
            this.activeClassEmail = '';
            this.activeClassNope = '';
            this.activeClassAlamat = '';
            this.nama = this.email = this.nomer_hp = this.alamat = this.idTiket = '';
            this.classChekIn = 'disabled';
            $(".btnValid").show();
            $(".cardTiket").hide();
        },
        btnChekIn(){
          axios.get('master-tiket', {
            params : {
              id : this.idTiket
            }
          }).then(resp => {
            if (resp.data.alert=='success') {
             $(".btnValid").hide();
             $(".cardTiket").show();
            this.dataTiket = resp.data[0];
            }
              swal(resp.data.massage,{
                icon: resp.data.alert,
              });
          }).catch(err => {          
            swal('Gangguan sistem!',{
                icon: "warning",
              });
          });
        },
        inputIdTiket(){
          if (this.idTiket!='') {
            this.classChekIn='';
          }else{
            this.classChekIn='disabled';
          }
        }
      }
  
    }).mount('#app')
  </script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
@endsection