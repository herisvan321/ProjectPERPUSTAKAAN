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
                <h3 class="panel-title">Form Peminjaman Buku</h3>
            </div>
            <div class="panel-body">
                <div class="container-fluid"><br>
                 <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="search" v-model="cari">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-info" @click="pencarian()">Cari</button>
                    </div>
                </div> <br>
                    <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>KD Buku</th>
                                <th>Judul</th>
                                <th>Nama Peminjam</th>
                                <th>TH. Terbit</th>
                                <th>Halaman</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="t, index in datas">
                                <td>{{ index + 1}}</td>
                                <td>{{ t.kd_buku }}</td>
                                <td>{{ t.judul_buku }}</td>
                                <td>{{ t.name }}</td>
                                <td>{{ t.th_terbit }}</td>
                                <td>{{ t.halaman }}</td>
                                <td>
                                    <button class="btn btn-info" @click="simpan(t.kd_buku, t.id_user)">
                                        Setujui
                                    </button>
                                    <button class="btn btn-warning" @click="hapus(t.kd_act)">
                                        Hapus
                                    </button>
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
        pencarian()
        {
            axios.get('/peminjaman/cari/menunggu/',{
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
            axios.get('/api/peminjaman/buku')
        .then(response => {
            this.datas = response.data;
         })
        },
        simpan(id_buku, id_user)
        {
            axios.put('/api/update/peminjaman/buku/setujui',{
                'kd_buku' : id_buku,
                'id_user' : id_user,
            })
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
        hapus(id_act)
        {
            axios.delete('/api/delete/'+id_act +'/peminjaman/buku')
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
        }
       
    }
}
</script>
