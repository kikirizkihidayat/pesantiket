@extends('main')

@section('container')

<div id="app" class="container-fluid">

  <!-- Page Heading -->
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom-secondary">
    <h1 class="h3 mb-0 text-gray-800"> {{ $title }}</h1>
    <div v-if="sessionLevel" class="btn-toolbar mb-2 mb-md-0">
      <a href="#" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modalChekIn">
        <i class="fas fa-user-plus fa-sm "></i> Tambah Pengguna
      </a>
    </div>
  </div>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
      <div class="small">
          <ul class="list-inline">
              <li class="d-none list-inline-item d-md-inline">Show</li>
              <li class="list-inline-item">
                  <select class="form-control form-control-sm" v-model="show" v-on:change="getData()" style="width: 60px">
                      <option value="10">10</option>
                      <option value="25">25</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                  </select>
              </li>
              <li class="d-none list-inline-item d-md-inline">Entries</li>
          </ul>
      </div>

      <div class="pb-3">
          <input type="text" class="form-control form-control-sm" placeholder="Search" v-model="search" v-on:keyup="getData()" style="width: 150px;">
      </div>
  </div>

  <div class="table-responsive border-bottom">
    <table class="table table-striped table-sm" id="dataTable" >
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama</th>
          <th scope="col">e-mail</th>
          <th scope="col">Alamat</th>
          <th scope="col">Level</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, n) in data_users">
          <td>@{{ n+from }}</td>
          <td>@{{ item.name }}</td>
          <td>@{{ item.email }}</td>
          <td>@{{ item.alamat }}</td>
          <td>@{{ item.level }}</td>
          <td>
            <div v-if="sessionLevel" class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                  aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalResetPassword"><i class="fas fa-key">&nbsp;</i>Reset Password</a>
                  <a class="dropdown-item" href="#" v-on:click="bttnEdit(item.id)" data-toggle="modal" data-target="#modalChekIn"><i class="fas fa-edit">&nbsp;</i>Edit</a>
                  <a class="dropdown-item" href="#" v-on:click="btnDelete(item.id,item.name)"><i class="fas fa-trash-alt">&nbsp;</i>Delete</a>
                </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  
  <div class="row justify-content-between pt-3" >
      <div class="col small">@{{ from }} to @{{ to }} from @{{ total }}</div>
      <div class="col" aria-label="Page navigation example">
          <ul class="pagination pagination-sm justify-content-end">
              <li class="page-item" :class="btnPrev">
                  <a class="page-link" href="#" v-on:click.prevent="movePage(prev_page_url)">Prev</a>
              </li>
              <li v-for="n in last_page" :class.prevent="pageActive(n)" class="page-item" ><a class="page-link" href="#" v-on:click.prevent="movePage(path +'?page='+ n)">@{{ n }}</a></li>
              <li id="btnNext" class="page-item" :class="btnNext">
                  <a class="page-link" href="#" v-on:click.prevent="movePage(next_page_url)">Next</a>
              </li>
          </ul>
      </div>
  </div>
  
  <!-- Modal Tambah Pengguna -->
  <div class="modal fade" id="modalChekIn" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalChekInLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" v-if="btnEdit" id="staticBackdropLabel">Edit Pengguna</h5>
          <h5 class="modal-title text-dark" v-else id="staticBackdropLabel">Tambah Pengguna</h5>
          <button type="button" v-on:click="btnClose()" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              <form>
                <div class="form-group">
                  <input type="text" class="form-control form-control-sm" placeholder="Nama Lengkap" v-model="name" required  :class="[activeClassName]">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" placeholder="Email" v-model="email" required  :class="[activeClassEmail]">
                  </div>
                  <div class="form-group col-md-6">
                    <select class="form-control form-control-sm" v-model="level" :class="[activeClassLevel]">
                      <option value="">Pilih Level</option>
                      <option value="Admin">Admin</option>
                      <option value="User">user</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <textarea class="form-control form-control-sm" placeholder="Alamat" v-model="alamat" required  :class="[activeClassAlamat]"></textarea>
                </div>
              </form>
                <p class="font-weight-lighter">Note : Password default sesuai dengan email!</p>
        </div>
        <div class="modal-footer col-12 d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 small">
            <div class="btn-group">
              <button type="button" class="btn-sm btn btn-primary"  v-if="btnEdit" v-on:click="btnUpdate()"><i class="fa fa-save fa-sm"></i> Update</button>
              <button type="button" class="btn-sm btn btn-primary"  v-else v-on:click="btnSave()"><i class="fa fa-save fa-sm"></i> Simpan</button>
              <button type="button" class="btn-sm btn btn-outline-secondary" v-on:click="btnReset(0)"><i class="fa fa-redo-alt fa-sm"></i></button>
            </div>
            <div>
              <button type="button" class="btn-sm btn btn-danger" v-on:click="btnClose()"  data-dismiss="modal" aria-label="Close">Kembali</button>
            </div>
        </div>
      </div>
    </div>
  </div>

  
  <!--Modal Reset Password-->
  <div class="modal fade" id="modalResetPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin anda ingin mereset password @{{ name }}?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              Silahkan masukan password anda untuk melanjutkan!
                <input type="email" name="email" hidden>
                <input type="email" name="emailReset" hidden>
                <input type="password" class="form-control form-control-sm" placeholder="Masukan Password" required >
                        
            </div>
            <div class="modal-footer">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="button" class="btn-sm btn btn-primary ms-3"  v-on:click="btnUpdate()"><i class="fa fa-key fa-sm"></i> Reset Password</button>
                    
                    <button type="button" class="btn-sm btn btn-danger" v-on:click="btnClose()"  data-dismiss="modal" aria-label="Close">Cancel</button>
                  
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
      dataSession : [],
      sessionLevel : '',

      url : '',
      data_users : [],
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

      idTiket : '',
      classChekIn : 'disabled',
      classValid : 'hidden',
      dataUser : [],
      id : '',
      name : '',
      email : '',
      level : '',
      alamat : '',
      
      activeClassName : '',
      activeClassEmail : '',
      activeClassLevel : '',
      activeClassAlamat : '',
      
      btnEdit : false

      }
    },
    mounted() {
      this.current_page = 1;
      this.show = 10;
      this.url = "master-users";
      this.getData();
      axios.get('master-user', {
        params : {
          id : $('#sessionId').val()
        }
      }).then(resp => {
        this.dataSession = resp.data[0];
        if (this.dataSession['level']=="Admin") {
          this.sessionLevel = true;
        }else{this.sessionLevel = false;}
        
      }).catch(err => {          
        swal('Gangguan sistem!',{
            icon: "warning",
          });
      });
      
    },
    methods: {
      getData() {
        axios.get(this.url, {
          params : {
            show :this.show,
            search : this.search
          }
        }).then(resp => {
          this.data_users = resp.data.data;
          this.from = resp.data.from;
          this.to = resp.data.to;
          this.total = resp.data.total;
          this.path = resp.data.path;
          this.next_page_url = resp.data.next_page_url;
          this.prev_page_url = resp.data.prev_page_url;
          this.current_page = resp.data.current_page;
          this.last_page = resp.data.last_page;
          
          if (this.current_page != 1) {
            this.isActivePrev = false;
          }else{this.isActivePrev = true;}
          if (this.current_page == resp.data.last_page) {
            this.isActiveNext = true;
          }else{this.isActiveNext = false;}

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
          form_data.append('name' , this.name);
          form_data.append('email' , this.email);
          form_data.append('level' , this.level);
          form_data.append('alamat' , this.alamat);
          axios.post('master-user-save', form_data)
          .then(resp => {
            swal({
              title: 'Simpan',
              text: 'Data berhasil disimpan.',
              icon: 'success',
              timer: 2000,
              buttons: false,
            })
            .then(() => {
                location.href='/users';
            })
          }).catch(err => {
            swal("Gagal memproses!","","warning");
          })
        }
      },
      bttnEdit(id){
        axios.get('master-user', {
          params : {
            id : id
          }
        }).then(resp => {
          this.dataUser = resp.data[0];
          this.id = this.dataUser['id'];
          this.name = this.dataUser['name'];
          this.email = this.dataUser['email'];
          this.level = this.dataUser['level'];
          this.alamat = this.dataUser['alamat'];
          this.btnEdit = true;
        }).catch(err => {          
          swal('Gangguan sistem!',{
              icon: "warning",
            });
        })
        
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
                location.href='/users';
            })
            
          })
          .catch(err => {
            swal("Gagal memproses!","","warning");
            console.log(form_data);
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
      bttnResetPassword(id,name){
        swal({
          title: "Anda akan mereset password "+name+"!",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
          title: 'Enter your password',
  input: 'password',
  inputLabel: 'Password',
  inputPlaceholder: 'Enter your password',
  inputAttributes: {
    maxlength: 10,
    autocapitalize: 'off',
    autocorrect: 'off'
  }
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
      btnClose(){
        this.id = '';
        this.btnReset();
      },
      btnReset(){
        if (this.id != '') {
          id = this.id;
          this.bttnEdit(id);
        }else{
          this.activeClassName = '';
          this.activeClassEmail = '';
          this.activeClassLevel = '';
          this.activeClassAlamat = '';
          this.id = this.name = this.email = this.level = this.alamat = this.idTiket = '';
          this.btnEdit = false;
        }
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