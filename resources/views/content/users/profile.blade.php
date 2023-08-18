@extends('main')

@section('container')

<div id="app" class="container-fluid">

  <!-- Content Row -->
  <div class="row">
    <!-- Area Chart -->
    <div class="col-12">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5 class="m-0 font-weight-bold text-primary">Profile</h5>
            <div hidden class="dropdown no-arrow closeEven">
                <a class="dropdown-toggle" href="#" v-on:click="btnCancel()" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-times fa-sm fa-fw text-gray-400"></i>
                </a>
            </div>
            <div id="opsi" class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#" v-on:click="btnEdit()"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#setpasswordModal"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Ganti Password</a>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <div class="mb-3 row">
                <label for="staticNama" class="col-sm-2 col-form-label">Nama Lengkap </label>
                <div class="col-sm-10">
                  <input type="text" disabled class="form-control" id="staticNama" v-model="name">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticLevel" class="col-sm-2 col-form-label">Role </label>
                <div class="col-sm-10">
                    <select class="form-control" v-model="level" disabled id="staticLevel" >
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email </label>
                <div class="col-sm-10">
                  <input type="text" disabled class="form-control" id="staticEmail" v-model="email">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticAlamat" class="col-sm-2 col-form-label">Alamat </label>
                <div class="col-sm-10">
                  <input type="text" disabled class="form-control" id="staticAlamat" v-model="alamat">
                </div>
            </div>
            <div class="modal-footer col-12 d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 small">
                <div class="btn-group closeEven" hidden>
                  <button type="button" class="btn-sm btn btn-primary"  v-on:click="btnUpdate()"><i class="fa fa-save fa-sm"></i> Update</button>
                  <button type="button" class="btn-sm btn btn-outline-secondary" v-on:click="btnReset()"><i class="fa fa-redo-alt fa-sm"></i></button>
                </div>
                <div class="closeEven" hidden>
                  <button type="button" class="btn-sm btn btn-danger" v-on:click="btnCancel()"  data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
      </div>
    </div>
    

    <!-- Setpassword Modal-->
    <div class="modal fade" data-backdrop="static" id="setpasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Ganti Pasword</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/setPasword" method="POST">
                @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm" v-model="email" id="email" placeholder="Masukan Email" required disabled>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-sm" :class="[activeClasspassword]" v-model="password" id="password" placeholder="Password Lama" required >
                              <div id="errorPassword" class="invalid-feedback" hidden>
                                Password lama tidak sesuai, mohon periksa kembali!
                              </div>
                            </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <input type="password" class="form-control form-control-sm" :class="[activeClassnewPassword]" v-model="newPassword" id="newPassword" placeholder="Pasword Baru" required >
                            </div>
                            <div class="form-group col-md-6">
                              <input type="password" class="form-control form-control-sm" :class="[activeClassrePassword]" v-model="rePassword" id="rePassword" placeholder="Ulang Password" required >
                              <div class="invalid-feedback">
                                Password tidak sesuai, periksa kembali!
                              </div>
                            </div>
                      
                        </div>
                    </div>
                    <div class="modal-footer col-12 d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 small">
                        <div class="btn-group">
                          <button type="button" class="btn-sm btn btn-primary" v-on:click="btnSave()"><i class="fa fa-save fa-sm"></i> Simpan</button>
                          <button type="button" class="btn-sm btn btn-outline-secondary" v-on:click="btnResetPass()"><i class="fa fa-redo-alt fa-sm"></i></button>
                        </div>
                        <div>
                          <button type="button" class="btn-sm btn btn-danger" v-on:click="btnResetPass()"  data-dismiss="modal" aria-label="Close">Batalkan</button>
                        </div>
                    </div>
                </form>
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
      url : '',
      from : '',
      to : '',
      total : '',
      path : '',
      next_page_url : '',
      prev_page_url : '',
      current_page : '',
      last_page : '',
      show : '',
      search : '',
      isActivePrev : '',
      isActiveNext : '',
      isActivePage : true,
      hasErorrPage : false,


      dataUser : [],
      id : '',
      name : '',
      email : '',
      level : '',
      alamat : '',
      password : '',
      newPassword : '',
      rePassword : '',
      
      activeClassName : '',
      activeClassEmail : '',
      activeClassLevel : '',
      activeClassAlamat : '',
      activeClasspassword : '',
      activeClassnewPassword : '',
      activeClassrePassword : ''
      

      }
    },
    mounted() {
      this.id = $('#sessionId').val();
      this.url = "master-user";
      this.getData();
    },
    methods: {
      getData() {
        axios.get(this.url, {
          params : {
            id : this.id
          }
        }).then(resp => {          
          this.dataUser = resp.data[0];
          this.id = this.dataUser['id'];
          this.name = this.dataUser['name'];
          this.email = this.dataUser['email'];
          this.level = this.dataUser['level'];
          this.alamat = this.dataUser['alamat'];
        }).catch(err => {
            alert('error');
        })
      },
      movePage(url){
        this.url = url;
        this.getData();
      },
      pageActive(n) {
        current = this.current_page
        if (n == current) {
        return {
          active: this.isActivePage
        };
        }else{
        return {
          active: this.hasErorrPage
        };
        }
      },
      btnSave(){
        if (this.password == '') {
          this.activeClasspassword = 'is-invalid';
          $('#password').focus();
        }else if (this.newPassword == '') {
          this.activeClassnewPassword = 'is-invalid';
          $('#newPassword').focus();
        }else if ((this.rePassword == '') || (this.rePassword != this.newPassword)) {
          this.activeClassrePassword = 'is-invalid';
          $('#rePassword').focus();
          $('#rePassword').select();
        }else{
          var form_data = new FormData();
          form_data.append('id' , this.id);
          form_data.append('email' , this.email);
          form_data.append('password' , this.password);
          form_data.append('newPassword' , this.newPassword);
          axios.post('master-user-update', form_data)
          .then(resp => {
            console.log(resp);
            if (resp.data.success) {
              swal({
                title: 'Ganti Password',
                text: 'Password baru berhasil disimpan.',
                icon: 'success',
                timer: 2000,
                buttons: false,
              })
              .then(() => {
                this.btnResetPass();
                location.href='/profile';
              })              
            }else{
              $('#Password').focus();
              $('#Password').select();
              $('#errorPassword').prop('hidden',false);
              this.activeClasspassword = 'is-invalid';
            }
          }).catch(err => {
            swal("Gagal memproses!","","warning");
          })
        }
      },
      btnEdit(){
        $('#staticNama').prop('disabled',false);
        $('#staticEmail').prop('disabled',false);
        $('#staticAlamat').prop('disabled',false);
        $('.closeEven').prop('hidden',false);
        $('#opsi').prop('hidden',true);
      },
      btnUpdate(){
        if (this.name == '') {
          this.activeClassName = 'is-invalid';
        }else if (this.email == '') {
          this.activeClassEmail = 'is-invalid';
        }else if (this.level == '') {
          this.activeClassLevel = 'is-invalid';
        }else if (this.alamat == '') {
          this.activeClassAlamat = 'is-invalid';
        }else{
          var form_data = new FormData();
          form_data.append('id', this.id);
          form_data.append('name', this.name);
          form_data.append('email', this.email);
          form_data.append('level', this.level);
          form_data.append('alamat', this.alamat);
          axios.post('master-user-update', form_data)
          .then(resp => {
            swal({
              title: 'Update',
              text: 'Data berhasil update.',
              icon: 'success',
              timer: 2000,
              buttons: false,
            })
            .then(() => {
                this.btnCancel();
                $('#userName').html(this.name);
            })
            
          })
          .catch(err => {
            swal("Gagal memproses!","","warning");
          })
        }
      },
      btnDelete(id,name){
        swal({
          title: "Pengguna "+name+" akan dihapus!",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            axios.get('master-user-delete', {
            params : {
              id : id
            }
          }).then(resp => {
            this.getData();
            swal("Data berhasil dihapus!", {
              icon: "success",
            });
          }).catch(err => {
            swal('Gagal menghapus data!',{
              icon: "warning",
            });
          })
          }
        });
      },
      btnCancel(){
        this.getData();
        $('#staticNama').prop('disabled',true);
        $('#staticEmail').prop('disabled',true);
        $('#staticAlamat').prop('disabled',true);
        $('.closeEven').prop('hidden',true);
        $('#opsi').prop('hidden',false);
      },
      btnReset(){
        this.getData();
      },
      btnResetPass(){
        this.password = this.newPassword = this.rePassword = '';
        this.activeClasspassword = this.activeClassnewPassword = this.activeClassrePassword = '';
      }
    },
    computed: {
      btnPrev() {
        return {
          disabled: this.isActivePrev
        }
      },
      btnNext() {
        return {
          disabled: this.isActiveNext
        }
      }
    }

  }).mount('#app')
</script>
  
@endsection