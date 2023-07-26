@extends('main')

@section('container')

<div id="app" class="container-fluid">

  <!-- Page Heading -->
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom-secondary">
    <h1 class="h3 mb-0 text-gray-800"> {{ $title }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="#" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modalChekIn">
        <i class="fas fa-receipt fa-sm "></i> Chek-in
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
          <th scope="col">ID Tiket</th>
          <th scope="col">Nama</th>
          <th scope="col">e-mail</th>
          <th scope="col">Telepon</th>
          <th scope="col">Alamat</th>
          <th scope="col">Status</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, n) in data_tikets">
          <td>@{{ n+from }}</td>
          <td>@{{ item.idTiket }}</td>
          <td>@{{ item.nama }}</td>
          <td>@{{ item.email }}</td>
          <td>@{{ item.nomer_hp }}</td>
          <td>@{{ item.alamat }}</td>
          <td>
            <span v-if='item.status' class="badge bg-success text-light">chek-in</span>
            <span v-else class="badge bg-secondary text-light">receipt</span>
          </td>
          <td>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                  aria-labelledby="dropdownMenuLink">
                  <a v-if='!item.status' class="dropdown-item" href="#" v-on:click="btnChekIn(item.idTiket)" data-toggle="modal" data-target="#modalChekIn"><i class="fa fa-sign-in-alt">&nbsp;</i>chekIn</a>
                  <a class="dropdown-item" href="#" v-on:click="btnEdit(item.idTiket)" data-toggle="modal" data-target="#modalBiodata"><i class="fas fa-edit">&nbsp;</i>Edit</a>
                  <a class="dropdown-item" href="#" v-on:click="btnDelete(item.id,item.nama)"><i class="fas fa-trash-alt">&nbsp;</i>Delete</a>
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
          <h5 class="modal-title text-dark" id="staticBackdropLabel">Edit Biodata</h5>
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
          <button type="button" class="btn btn-primary" v-on:click="btnUpdate()">Update</button>
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
      data_tikets : [],
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
      dataTiket : [],
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
    mounted() {
      $(".cardTiket").hide();
      this.current_page = 1;
      this.show = 10;
      this.url = "master-tikets";
      this.getData();
    },
    methods: {
      getData() {
        axios.get(this.url, {
          params : {
            show :this.show,
            search : this.search
          }
        }).then(resp => {
          this.data_tikets = resp.data.data;
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
      btnEdit(id){
        axios.get('master-tiket-edit', {
          params : {
            id : id
          }
        }).then(resp => {
          this.dataTiket = resp.data[0];
          this.idTiket = this.dataTiket['idTiket'];
          this.nama = this.dataTiket['nama'];
          this.email = this.dataTiket['email'];
          this.nomer_hp = this.dataTiket['nomer_hp'];
          this.alamat = this.dataTiket['alamat'];
        }).catch(err => {          
          swal('Gangguan sistem!',{
              icon: "warning",
            });
        });
        
      },
      btnUpdate(){
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
          form_data.append('idTiket', this.idTiket);
          form_data.append('nama', this.nama);
          form_data.append('email', this.email);
          form_data.append('nomer_hp', this.nomer_hp);
          form_data.append('alamat', this.alamat);
          axios.post('master-tiket-update', form_data)
          .then(resp => {
            swal({
              title: 'Update',
              text: 'Data berhasil update.',
              icon: 'success',
              timer: 2000,
              buttons: false,
            })
            .then(() => {
                location.href='/tikets';
            })
            
          })
          .catch(err => {
            swal("Gagal memproses!","","warning");
          })
        }
      },
      btnDelete(id,name){
        swal({
          title: "Tiket "+name+" akan dihapus!",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            axios.get('master-tiket-delete', {
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
      btnChekIn(id){
        if(id!=null){
          this.idTiket = id;
        }
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