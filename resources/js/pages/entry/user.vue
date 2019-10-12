<template>
     <div>
            <div id="modal">
                    <biodatasiswa :rec="tampils" @biodatasiswa="refresh"></biodatasiswa>
                    <edituser :recc="edits" @editdata ="refresh"></edituser>
                </div>
<ul class='breadcrumb'>
    <li><router-link to='/' >Home</router-link></li> 
    <li><router-link to='#' class='active'>Entry data User</router-link></li>                   
</ul>

<div  class="container">
    <p class="tulisanhidden"><span class="fa fa-arrow-circle-o-right"></span>  Data Buku</p>
    <div class="row">
        
        <div class="col-md-9"> 
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Form data User</h3>
            </div>
            <div class="panel-body"><br>
                    <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                   
                              <tr v-for="t, index in datas.data">
                                    <td>{{index + 1}}</td>
                                    <td>{{ t.name}}</td>
                                    <td>{{ t.email}}</td>
                                    <td>{{ t.level}}</td>
                                    <td>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#edituser" @click="edit(t.id_user)"><span class="fa fa-edit"></span></button>
                                        <button class="btn btn-info" v-if="t.level == 'siswa'" data-toggle="modal" data-target="#myModal" @click="tampil(t.id_user)">Biodata Siswa</button>
                                        <button @click="cetak(t.id_user)"  v-if="t.level == 'siswa'" class="btn btn-info">Cetak</button>
                                    </td>
                                  </tr>
                                 

                              
                            </tbody>
                          </table>
                          <pagination :data="datas" v-on:limit="1"  @pagination-change-page="getResults"></pagination>
            </div>
        </div>
           
        </div>
        <div class="col-md-3">
                 <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Form Input User</h3>
                    </div>
                <div class="panel-body">
                <p>
                    Nama : 
                    <input type="text" v-model="nama" class="form-control" placeholder=" Enter Nama">
                    <p v-if="errors.nama > 0">
                        <p v-for="err in errors.nama" style="color:red">{{err}}</p>
                    </p>
                </p>
                 <p>
                    Email : 
                    <input type="email" v-model="email" class="form-control" placeholder=" Enter Email">
                    <p v-if="errors.email > 0">
                        <p v-for="err in errors.email" style="color:red">{{err}}</p>
                    </p>
                </p>
                <p>
                    Pilihan : 
                    <select v-model="level" required class="form-control">
                        <option value="" hidden>==pilih==</option>
                        <option value="petugas">Petugas Perpus</option>
                        <option value="siswa">Siswa</option>
                        <option value="kepsek">Kepala Sekolah</option>
                    </select>
                    <p v-if="errors.level > 0">
                        <p v-for="err in errors.level" style="color:red">{{err}}</p>
                    </p>
                </p>
                <p>
                    Password : 
                    <input type="password" v-model="password" class="form-control" placeholder=" Enter password">
                    <p v-if="errors.password > 0">
                        <p v-for="err in errors.password" style="color:red">{{err}}</p>
                    </p>
                </p>
                <p>
                    <button @click="simpan()" class="btn btn-primary"><span class="fa fa-save"></span> Save</button>
                </p>
                </div>
            </div>
               
            </div>
    </div>
</div>

    </div>
    
</template>
<script>
Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
export default {
    data(){
        return{
            nama : '',
            email : '',
            level : '',
            password : '',
            errors : [],
            datas : {},
            tampils : {},
            edits : {}
        }
    },
    mounted() {
		// Fetch initial results
        this.getResults();
        if(this.$userId != 'petugas')
        {
            swal('anda tidak memiliki hak akses!',{
                icon : 'warning'
            });
            this.$router.push({path : '/'});
        }
	},
    methods : {
        getResults(page = 1) {
			axios.get('/data/user?page=' + page)
				.then(response => {
                    this.datas = response.data;
                    if(response.data.kembali)
                    {
                        window.self.history.back()
                    }
				});
		},
        simpan()
        {
            axios.post('api/save/user',{
                'nama' : this.nama,
                'email' : this.email,
                'level' : this.level,
                'password' : this.password
            })
            .then(response => {
                this.nama = '';
                this.email = '';
                this.level = '';
                this.password = '';
                if(response.data.sukses)
                {
                    this.getResults();
                    swal(response.data.sukses,{
                        icon : 'success'
                    });
                    this.errors = [''];
                }
                elseif(response.data.gagal)
                {
                    swal(response.data.gagal,{
                        icon : 'warning'
                    });
                }
            })
            .catch(error => this.errors = error.response.data.errors)
        },
        tampil(id)
        {
            axios.get('/api/tampil/'+ id +'/siswa')
            .then(response => {
                console.log(id)
                this.tampils = response.data
            })
            .catch(e => {
                console.log(e)
            })
        },
        edit(id)
        {
            axios.get('/api/show/'+ id +'/user')
            .then(response => {
                console.log(id)
                this.edits = response.data
            })
            .catch(e => {
                console.log(e)
            })
        },
        cetak(id)
        {
            window.location.href='/home/cetak/'+ id +'/kartu/anggota';
        },
        refresh()
        {
            this.getResults()
        }
    }
}
</script>
