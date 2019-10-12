<template>
     <div>
            <div id="modal">
                    <pinjambukusiswa :rec="edits" @tbuku="refresdata"></pinjambukusiswa>
                </div>
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
                    <h3 class="panel-title"></h3>
                </div>
            <div class="panel-body">
                <p>Silahkan pilih buku untuk melakuka peminjaman!</p>
                <div class="container-fluid"><br>
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
                                <th>Action</th>
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
                                <td>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#pinjambukusiswa" @click="tampil(t.kd_buku)" v-if="t.jumlah != 0"><span class="fa fa-eye" ></span> Lihat </button>
                                    <button v-else class="btn btn-danger">Habis</button>
                                </td>
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
            axios.get('/getbuku')
        .then(response => {
            this.datas = response.data;
         })
        },
        tampil(id)
        {
            axios.get('/tampil/'+id+'/buku/pinjam')
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
            }
        },
        refresdata()
        {
            this.getdata()
        }
    }
}
</script>
