<template>
 <div>
<ul class='breadcrumb'>
    <li><router-link to='/' class='active'>Home</router-link></li>                   
</ul>
<div class="container">
     <p class="tulisanhidden"><span class="fa fa-home"></span>  Home</p>
</div>
         <!-- WIDGETS -->
                    <div class="row">
                        <div class="col-md-3" v-if="datas.akuns.level != 'siswa'">

                             <div class="widget widget-danger widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-book"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count">{{ datas.buku}}</div>
                                    <div class="widget-title">Jumlah</div>
                                    <div class="widget-subtitle">Buku</div>
                                </div>
                                                          
                            </div>

                        </div>
                        <div class="col-md-3" v-if="datas.akuns.level != 'siswa'">

                           <div class="widget widget-warning widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-users"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count">{{ datas.user}}</div>
                                    <div class="widget-title">Jumlah</div>
                                    <div class="widget-subtitle">User</div>
                                </div>
                                                          
                            </div>                       

                        </div>
                        <div class="col-md-3" v-if="datas.akuns.level != 'siswa'">

                            <div class="widget widget-info widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-users"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count">{{ datas.siswa}}</div>
                                    <div class="widget-title">Jumlah</div>
                                    <div class="widget-subtitle">Siswa</div>
                                </div>
                                                          
                            </div>                     

                        </div>
                        <div class="col-md-3" v-if="datas.akuns.level != 'siswa'">

                           <div class="widget widget-success widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-building-o"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count">{{ datas.penerbit}}</div>
                                    <div class="widget-title">Jumlah</div>
                                    <div class="widget-subtitle">Penerbit</div>
                                </div>
                                                          
                            </div>                     

                        </div>
                        <div class="col-md-8">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Button Access </h3>
                                </div>
                                <div class="panel-body">
                                    <p>Silahkan Klik Button access cepat untuk mempermudah anda</p>                                
                                    <router-link to="/entry/user" class="btn btn-default btn-lg" v-if="datas.akuns.level =='petugas'">
                                        <span class="fa fa-users" ></span> <br>
                                        Entry <br>
                                        User
                                    </router-link>
                                     <router-link to="/entry/penerbit" class="btn btn-default btn-lg" v-if="datas.akuns.level =='petugas'">
                                        <span class="fa fa-building-o"></span> <br>
                                        Entry <br>
                                        Penerbit
                                    </router-link>
                                     <router-link to="/entry/kategori" class="btn btn-default btn-lg" v-if="datas.akuns.level =='petugas'">
                                        <span class="fa fa-tag"></span> <br>
                                        Entry <br>
                                        Kategori
                                    </router-link>
                                     <router-link to="/entry/buku" class="btn btn-default btn-lg" v-if="datas.akuns.level =='petugas'">
                                        <span class="fa fa-book"></span> <br>
                                        Entry <br>
                                        Buku
                                    </router-link>
                                     <router-link to="/peminjaman/buku/siswa" class="btn btn-default btn-lg" v-if="datas.akuns.level =='siswa'">
                                        <span class="fa fa-arrow-left"></span> <br>
                                         Pengolahan <br>
                                        Peminjaman
                                    </router-link>
                                     <router-link to="/riwayat/buku/siswa" class="btn btn-default btn-lg" v-if="datas.akuns.level =='siswa'">
                                        <span class="fa fa-arrow-right"></span> <br>
                                         Pengolahan <br>
                                        Riwayat
                                    </router-link>
                                     <router-link to="/peminjaman/buku" class="btn btn-default btn-lg" v-if="datas.akuns.level =='petugas'">
                                        <span class="fa fa-arrow-left"></span> <br>
                                         Pengolahan <br>
                                        Peminjaman
                                    </router-link>
                                     <router-link to="/pengembalian/buku" class="btn btn-default btn-lg" v-if="datas.akuns.level =='petugas'">
                                        <span class="fa fa-arrow-right"></span> <br>
                                        Pengolahan <br>
                                        Pengembalian
                                    </router-link>
                                    <div v-if="datas.akuns.level =='petugas'">

                                    
                                     <router-link to="/laporan/penerbit" class="btn btn-default btn-lg" v-if="datas.akuns.level !='siswa'">
                                        <span class="fa fa-files-o"></span> <br>
                                        Laporan <br>
                                        penerbit
                                    </router-link>
                                     <router-link to="/laporan/siswa" class="btn btn-default btn-lg" v-if="datas.akuns.level !='siswa'">
                                        <span class="fa fa-files-o"></span> <br>
                                         Laporan <br>
                                        Siswa
                                    </router-link>
                                     <router-link to="/laporan/user" class="btn btn-default btn-lg" v-if="datas.akuns.level !='siswa'">
                                        <span class="fa fa-files-o"></span> <br>
                                         Laporan <br>
                                        user
                                    </router-link>
                                     <router-link to="/laporan/buku" class="btn btn-default btn-lg" v-if="datas.akuns.level =='petugas' || datas.akuns.level =='kepsek'">
                                        <span class="fa fa-files-o"></span> <br>
                                         Laporan <br>
                                        Buku
                                    </router-link>
                                     <router-link to="/laporan/peminjaman" class="btn btn-default btn-lg" >
                                        <span class="fa fa-files-o"></span> <br>
                                         Laporan <br>
                                        Peminjaman
                                    </router-link>
                                    </div>

                                     <div v-if="datas.akuns.level =='kepsek'">
                                     <router-link to="/laporan/penerbit" class="btn btn-default btn-lg" v-if="datas.akuns.level !='siswa'">
                                        <span class="fa fa-files-o"></span> <br>
                                        Laporan <br>
                                        penerbit
                                    </router-link>
                                     <router-link to="/laporan/siswa" class="btn btn-default btn-lg" v-if="datas.akuns.level !='siswa'">
                                        <span class="fa fa-files-o"></span> <br>
                                         Laporan <br>
                                        Siswa
                                    </router-link>
                                     <router-link to="/laporan/user" class="btn btn-default btn-lg" v-if="datas.akuns.level !='siswa'">
                                        <span class="fa fa-files-o"></span> <br>
                                         Laporan <br>
                                        user
                                    </router-link>
                                     <router-link to="/laporan/buku" class="btn btn-default btn-lg" v-if="datas.akuns.level =='petugas' || datas.akuns.level =='kepsek'">
                                        <span class="fa fa-files-o"></span> <br>
                                         Laporan <br>
                                        Buku
                                    </router-link>
                                     <router-link to="/laporan/peminjaman" class="btn btn-default btn-lg" >
                                        <span class="fa fa-files-o"></span> <br>
                                         Laporan <br>
                                        Peminjaman
                                    </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Penting!!! </h3>
                                </div>
                                <div class="panel-body">
                                    <!-- <p>
                                    Nama : 
                                    <input type="text" v-model="this.datas.akuns.name" class="form-control">
                                   
                                    </p>
                                    <p>
                                        Email : 
                                        <input type="email" v-model="this.datas.akuns.email" class="form-control">
                                       
                                    </p>
                                    <p>
                                        Password : 
                                        <input type="password" v-model="password" class="form-control">
                                    </p>
                                    <p>
                                        <button @click="simpan()" class="btn btn-primary"><span class="fa fa-save"></span> Update</button>
                                    </p> -->
                                    Selamat datang di sistem informasi perpustakaan yang memakai teknologi laravel dan vueJs, <br> aplikasi ini adalah aplikasi sederhana yang akana membantu sebuah pekerjaan, <br>
                                    aplikasi ini hanya memperbolehkan siswa meminjam satu buku dalam satu waktu <br>
                                    dan sistem denda pada sistem ini sama dengan aplikasi lainnya yaitu <br>
                                    jika waktu jatuh tempo lewat maka akan di kali Rp 500 sampai buku dikembalikan. 
                                </div>
                            </div>
                        </div>

                    </div>
 </div>
</template>

<script>
import 'admin/plugins/jquery/jquery.min.js';
import 'admin/plugins/jquery/jquery-ui.min.js';
import 'admin/plugins/bootstrap/bootstrap.min.js';
import 'admin/plugins/scrolltotop/scrolltopcontrol.js';
import 'admin/plugins.js';
import 'admin/actions.js';
    export default {
        data(){
            return{
                posts : [],
                errors : [],
                datas : {},
                password : '',
            }
        },
        created()
        {
            this.getdata();
        },
        methods : {
            getdata()
            {
                axios.get('/home/index')
                .then(response => {
                    this.datas = response.data
                })
            }
        }
    }
</script>
