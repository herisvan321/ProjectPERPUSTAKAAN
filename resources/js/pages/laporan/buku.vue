<template>
     <div>
          
<ul class='breadcrumb'>
    <li><router-link to='/' >Home</router-link></li> 
    <li><router-link to='#' class='active'>Laporan data buku</router-link></li>                   
</ul>
<div  class="container">
    <p class="tulisanhidden"><span class="fa fa-arrow-circle-o-right"></span>  Data Buku</p>
    <div class="row">
               
        <div class="col-md-12">
           <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Form data User</h3>
                <a href="/home/cetak/buku" class="btn btn-info float-right" ><span class="fa fa-print"></span></a>
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
                                <th>ISBN</th>
                                <th>Pengarang</th>
                                <th>Kelas</th>
                                <th>TH. Terbit</th>
                                <th>Halaman</th>
                                <th>Jumlah</th>
                                <th>Penerbit</th>
                                <th>Kategori</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="t, index in datas">
                                <td>{{ index + 1}}</td>
                                <td>{{ t.kd_buku }}</td>
                                <td>{{ t.judul_buku }}</td>
                                <td>{{ t.isbn }}</td>
                                <td>{{ t.pengarang }}</td>
                                <td>{{ t.kelas }}</td>
                                <td>{{ t.th_terbit }}</td>
                                <td>{{ t.halaman }}</td>
                                <td>{{ t.jumlah }}</td>
                                <td>{{ t.nama_penerbit }}</td>
                                <td>{{ t.kategori }}</td>
                              
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
                swal('anda tidak memiliki hak akses!');
                this.$router.push({path : '/'});
            }
            else if(this.$userId == 'siswa')
             {
                swal('anda tidak memiliki hak akses!');
                this.$router.push({path : '/'});
            }
        }
    },
    methods : {
        getdata()
        {
            axios.get('/getbuku')
        .then(response => {
            this.datas = response.data;
         })
        },
        tampil(id)
        {
            axios.get('/api/tampil/'+id+'/buku')
            .then(response => {
                this.edits = response.data
            })
        },
        hapus(id)
        {
            const tanya = confirm('apakah anda ingin menghapus data buku ini?');
            if(tanya)
            {
                axios.delete('/api/buku/'+id+'/delete')
                .then(response => {
                    if(response.data.sukses)
                    {
                        swal(response.data.sukses,{
                            icon : 'warning'
                        });
                        this.getdata();
                    }
                    else if(response.data.gagal)
                    {
                        swal(response.data.gagal);
                    }
                })
            }
        },
        refresdata()
        {
            this.getdata()
        }
    }
}
</script>
