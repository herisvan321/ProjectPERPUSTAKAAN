<template>
     <div>
            
<ul class='breadcrumb'>
    <li><router-link to='/' >Home</router-link></li> 
    <li><router-link to='#' class='active'>Peminjaman buku</router-link></li>                   
</ul>
<div  class="container">
    <p class="tulisanhidden"><span class="fa fa-arrow-circle-o-right"></span>  Data Buku</p>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"> </h3>
                </div>
            <div class="panel-body">
                    <p >Riwayat Peminjaman buku anda! </p>
                <div class="container-fluid"><br>
                    <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>KD Buku</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>TH. Terbit</th>
                                <th>Halaman</th>
                                <th>tgl pinjam</th>
                                <th>tgl j. tempo</th>
                                <th>status</th>
                                <th>tgl kembali</th>
                                <th>denda</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="t, index in datas">
                                <td>{{ index + 1}}</td>
                                <td>{{ t.kd_buku }}</td>
                                <td>{{ t.judul_buku }}</td>
                                <td>{{ t.pengarang }}</td>
                                <td>{{ t.th_terbit }}</td>
                                <td>{{ t.halaman }}</td>
                                <td>{{ t.tgl_peminjaman }}</td>
                                <td>{{ t.tgl_j_tempo }}</td>
                                <td v-if="t.status == 0">Proses</td>
                                <td v-if="t.status == 1">pinjam</td>
                                <td v-if="t.status == 2">dikembalikan</td>
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

export default {
    data(){
        return{
            edits : {},
            errors : [],
            datas : [],
        }
    },
    created()
    {
        this.getdata();
    },
    methods : {
        getdata()
        {
            axios.get('/tampil/riwayat/peminjaman/siswa')
        .then(response => {
            this.datas = response.data;
         })
        },
        tampil(id)
        {
            axios.get('/api/tampil/'+id+'/buku/pinjam')
            .then(response => {
                this.edits = response.data
            })
        },
       
    }
}
</script>
