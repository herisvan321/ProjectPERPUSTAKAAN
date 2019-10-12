<template>
     <div>
            
<ul class='breadcrumb'>
    <li><router-link to='/' >Home</router-link></li> 
    <li><router-link to='#' class='active'>Laporan Peminjaman Buku</router-link></li>                   
</ul>
<div  class="container">
    <p class="tulisanhidden"><span class="fa fa-arrow-circle-o-right"></span>  Data Buku</p>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Form data User</h3>
                <a href="/home/cetak/peminjaman" class="btn btn-info float-right" ><span class="fa fa-print"></span></a>
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    <br>
               
                    <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>KD Buku</th>
                                <th>Judul</th>
                                <th>Nama Peminjam</th>
                                <th>tgl peminjaman</th>
                                <th>tgl tempo</th>
                                <th>tgl pengembalian</th>
                                <th>denda</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="t, index in datas">
                                <td>{{ index + 1}}</td>
                                <td>{{ t.kd_buku }}</td>
                                <td>{{ t.judul_buku }}</td>
                                <td>{{ t.name }}</td>
                                <td>{{ t.tgl_peminjaman }}</td>
                                <td>{{ t.tgl_j_tempo }}</td>
                                <td>{{ t.tgl_pengembalian }}</td>
                                <td>{{ t.denda }}</td>
                                
                              </tr>
                            </tbody>
                          </table>
                          </div>
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
            edits : {},
            errors : [],
            datas : [],
            cari : '',
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
        pencarian()
        {
            axios.get('/api/peminjaman/cari/',{
                    params : {
                        'cari' : this.cari,
                    }
                })
                .then(response => {
                this.datas = response.data;
            })
        },
        getdata()
        {
            axios.get('/laporan/peminjaman')
        .then(response => {
            this.datas = response.data;
         })
        },
       
    }
}
</script>
