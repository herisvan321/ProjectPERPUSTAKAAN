<template>
    <div>
        <div class="modal fade" id="pinjambukusiswa">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Pinjam Buku</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="container">
         <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-body">
                   <div v-if="rec.cekdata">
                       <h3>{{ this.rec.cekdata }}</h3>
                   </div>
                   <div v-else-if="!rec.cekdata">

                   <p>
                    Judul : 
                    <input type="text" v-model="rec.judul_buku" class="form-control" disabled>
                </p>
                 <p>
                    Isbn : 
                    <input type="email" v-model="rec.isbn" class="form-control" disabled>
                </p>
                <p>
                    Pengarang : 
                    <input type="email" v-model="rec.pengarang" class="form-control" disabled>
                </p>
                <p>
                    Kelas : 
                    <input type="email" v-model="rec.kelas" class="form-control" disabled>
                </p>
                <p>
                    Tahun Terbit : 
                    <input type="email" v-model="rec.th_terbit" class="form-control" disabled>
                </p>
                 <p>
                    Halaman : 
                    <input type="email" v-model="rec.halaman" class="form-control" disabled>
                </p>
                 <p>
                    Sinopsis : 
                    {{ rec.sinopsis}}
                </p>
               
                <p>
                    Gambar : <br>
                        <img :src="'/upload/buku/' + rec.gambar" width="250" height="300">
                    </p>
                <p>
                    <button @click="simpan(rec.kd_buku)" class="btn btn-primary"> Pinjam</button>
                </p>
                   </div>
                </div>
            </div>
               
            </div>
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
        
    </div>
</template>
<script>

export default {
    props : ['rec'],
    data(){
        return{
            judul : '',
            isbn : '',
            pengarang : '',
            kelas : '',
            thn_terbit : '',
            halaman : '',
            sinopsis : '',
            jumlah : '',
            penerbit : '',
            kategori : '',
            image : '',
            edits : {},
            errors : [],
            datas : [],
            penerbits : [],
        }
    },
    methods : {
        
        simpan(id)
        {
            // swal( this.penerbit)
            axios.post('/save/pinjam/buku/siswa', {
               'kd_buku' : id,
            })
            .then(response => {
                if(response.data.sukses)
                {
                    swal(response.data.sukses,{
                        icon : 'success'
                    });
                    this.$router.go(0);
                    
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
       
    }
}
</script>
