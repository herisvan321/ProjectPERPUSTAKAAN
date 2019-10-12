<template>
     <div>
            <div id="modal">
                    <editkategori :rec="edits" @datakategori="refresdata"></editkategori>
                </div>
<ul class='breadcrumb'>
    <li><router-link to='/' >Home</router-link></li> 
    <li><router-link to='#' class='active'>Entry data Kategori</router-link></li>                   
</ul>
<div  class="container">
    <p class="tulisanhidden"><span class="fa fa-arrow-circle-o-right"></span>  Data Buku</p>
    <div class="row">
        
        <div class="col-md-9">
            <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Form data Kategori</h3>
            </div>
            <div class="panel-body"><br>
                    <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="t, index in datas">
                                <td>{{index + 1}}</td>
                                <td>{{t.kategori}}</td>
                                <td>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#editkategori" @click="tampil(t.kd_kategori)"><span class="fa fa-edit"></span></button>
                                     <button class="btn btn-warning" @click="hapus(t.kd_kategori)"><span class="fa fa-trash-o"></span></button>
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
                <h3 class="panel-title">Form Input Kategori</h3>
            </div>
                <div class="panel-body">
                <p>
                    kategori : 
                    <input type="text" v-model="kategori" class="form-control" placeholder=" Enter Kategori">
                     <p v-if="errors.kategori > 0">
                        <p v-for="err in errors.kategori" style="color:red">{{err}}</p>
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
Vue.prototype.$userId = document.querySelector("meta[name = 'user-id']").getAttribute('content');
export default {
    data(){
        return{
           kategori : '',
           errors : [],
           datas : {},
           edits : {},
        }
    },
    created()
    {
        
        console.log(setTimeout(this.getdata(), 1))
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
            axios.get('/getkategori')
        .then(response => {
            this.datas = response.data;
         })
        },
        tampil(id)
        {
            axios.get('/api/tampil/'+id+'/kategori')
            .then(response => {
                this.edits = response.data
            })
        },
        simpan()
        {
            axios.post('/api/save/kategori', {
                'kategori' : this.kategori
            })
            .then(response => {
                if(response.data.sukses)
                {
                    swal(response.data.sukses,{
                        icon : 'success'
                    });
                    this.getdata();
                    this.kategori = '';
                }
                else if(response.data.gagal)
                {
                    swal(response.data.gagal);
                }
            })
            .catch(error => this.errors = error.response.data.errors)
        },
        hapus(id)
        {
            axios.delete('/api/kategori/'+id+'/delete')
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
                    swal(response.data.gagal);
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
