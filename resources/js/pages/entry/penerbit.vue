<template>
     <div>
            <div id="modal">
                    <editpenerbit :rec="edits" @editpenerbit="refresdata"></editpenerbit>
                </div>
<ul class='breadcrumb'>
    <li><router-link to='/' >Home</router-link></li> 
    <li><router-link to='#' class='active'>Entry data Penerbit</router-link></li>                   
</ul>
<div  class="container">
    <p class="tulisanhidden"><span class="fa fa-arrow-circle-o-right"></span>  Data Buku</p>
    <div class="row">
        
        <div class="col-md-9">
            <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Form data Penerbit</h3>
            </div>
            <div class="panel-body"><br>
                    <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Hp</th>
                                <th>Alamat</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="(t, index) in datas">
                                <td>{{ index + 1}}</td>
                                <td>{{ t.nama_penerbit}}</td>
                                <td>{{ t.email}}</td>
                                <td>{{ t.nohp}}</td>
                                <td>{{ t.alamat}}</td>
                                <td>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#editpenerbit" @click="tampil(t.kd_penerbit)"><span class="fa fa-edit"></span></button>
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal" @click="hapus(t.kd_penerbit)"><span class="fa fa-trash-o"></span></button>
                                </td>
                              </tr>
                              

                              
                            </tbody>
                          </table>
            </div>
        </div>
           
        </div>
        <div class="col-md-3">
                <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Form Input Penerbit</h3>
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
                    No Hp : 
                    <input type="email" v-model="nohp" class="form-control" placeholder=" Enter No Hp">
                     <p v-if="errors.nohp > 0">
                        <p v-for="err in errors.nohp" style="color:red">{{err}}</p>
                    </p>
                </p>
                <p>
                    alamat : 
                    <textarea  class="form-control" v-model="alamat" placeholder=" Enter Alamat"></textarea> 
                    <p v-if="errors.alamat > 0">
                        <p v-for="err in errors.alamat" style="color:red">{{err}}</p>
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
Vue.prototype.$userId = document.querySelector("meta[name ='user-id']").getAttribute('content');
export default {
    data(){
        return{
            nama : '',
            email : '',
            alamat : '',
            nohp : '',
            edits : {},
            errors : [],
            datas : [],
        }
    },
    created()
    {
        this.getdata();
         if(this.$userId != 'petugas')
        {
            swal('anda tidak memiliki hak akses!',{
                icon : 'warning'
            });
            this.$router.push({path : '/'});
        }
    },
    methods : {
        getdata()
        {
            axios.get('/getpenerbit')
        .then(response => {
            this.datas = response.data;
         })
        },
        tampil(id)
        {
            axios.get('/api/tampil/'+id+'/penerbit')
            .then(response => {
                this.edits = response.data
            })
        },
        simpan()
        {
            axios.post('/api/save/penerbit', {
                nama : this.nama,
                email : this.email,
                alamat : this.alamat,
                nohp : this.nohp,
            })
            .then(response => {
                if(response.data.sukses)
                {
                    swal(response.data.sukses,{
                        icon : 'success'
                    });
                    this.getdata();
                    this.nama = '';
                    this.email  ='';
                    this.alamat = '';
                    this.nohp = '';
                }
                else if(response.data.gagal)
                {
                    swal(response.data.gagal,{
                        icon : 'warning'
                    });
                }
            })
            .catch(error => this.errors = error.response.data.errors)
        },
        hapus(id)
        {
            axios.delete('/api/penerbit/'+id+'/delete')
            .then(response => {
                if(response.data.sukses)
                {
                    swal(response.data.sukses,{
                        icon : 'success'
                    });
                    this.getdata();
                }
                else if(response.data.gagal)
                {
                    swal(response.data.gagal,{
                        icon : 'warning'
                    });
                }
            })
        },
        refresdata()
        {
            this.getdata()
        }
    }
}
</script>
