<template>
     <div>
<ul class='breadcrumb'>
    <li><router-link to='/' >Home</router-link></li> 
    <li><router-link to='#' class='active'>Laporan Penerbit</router-link></li>                   
</ul>
<div  class="container">
    <p class="tulisanhidden"><span class="fa fa-arrow-circle-o-right"></span>  Data Buku</p>
    <div class="row">
        
        <div class="col-md-12">
            <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Form data User</h3>
                <a href="/home/cetak/penerbit" class="btn btn-info float-right" ><span class="fa fa-print"></span></a>
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
                                
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="(t, index) in datas">
                                <td>{{ index + 1}}</td>
                                <td>{{ t.nama_penerbit}}</td>
                                <td>{{ t.email}}</td>
                                <td>{{ t.nohp}}</td>
                                <td>{{ t.alamat}}</td>
                              
                              </tr>
                              

                              
                            </tbody>
                          </table>
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
          if(this.$userId != 'petugas' )
        {
            if(this.$userId != 'kepsek')
            {
                alert('anda tidak memiliki hak akses!');
                this.$router.push({path : '/'});
            }
            else if(this.$userId == 'siswa')
             {
                alert('anda tidak memiliki hak akses!');
                this.$router.push({path : '/'});
            }
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
        refresdata()
        {
            this.getdata()
        }
    }
}
</script>
