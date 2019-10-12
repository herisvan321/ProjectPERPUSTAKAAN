<template>
    <div>
        <div class="modal fade" id="editbuku">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit data Buku</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="container">
         <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-body">
                   <p>
                    Judul : 
                    <input type="text" v-model="rec.judul_buku" class="form-control">
                </p>
                 <p>
                    Isbn : 
                    <input type="email" v-model="rec.isbn" class="form-control">
                </p>
                <p>
                    Pengarang : 
                    <input type="email" v-model="rec.pengarang" class="form-control">
                </p>
                <p>
                    Kelas : 
                    <input type="email" v-model="rec.kelas" class="form-control">
                </p>
                <p>
                    Tahun Terbit : 
                    <input type="email" v-model="rec.th_terbit" class="form-control">
                </p>
                 <p>
                    Halaman : 
                    <input type="email" v-model="rec.halaman" class="form-control">
                </p>
                 <p>
                    Sinopsis : 
                    <textarea class="form-control" v-model="rec.sinopsis"></textarea>
                </p>
                 <p>
                    Jumlah : 
                    <input type="email" v-model="rec.jumlah" class="form-control">
                </p>
                <p>
                    penerbit : 
                    <select v-model="rec.kd_penerbit" required class="form-control">
                        <option value="" hidden>==pilih==</option>
                        <option v-for="pnb in penerbits" :value="pnb.kd_penerbit">{{ pnb.nama_penerbit}}</option>
                    </select>
                </p>
                <p>
                    Kategori : 
                    <select v-model="rec.kd_kategori"  required class="form-control" >
                        <option value="" hidden>==pilih==</option>
                        <option v-for="tk in datas" :value="tk.kd_kategori">{{ tk.kategori}}</option>
                    </select>
                </p>
                <p>
                    Gambar : <br>
                    <p v-if="image">
                    <img :src="image" width="100" height="120">
                    </p>
                    <p v-else>
                        <img :src="'/upload/buku/' + rec.gambar" width="100" height="120">
                    </p>
                    <label for="foto" class="btn btn-info"><span class="fa fa-picture-o"></span> pilih Gambar</label>
                    <input type="file"  id="foto" @change="onImageChange" style="display:none" accept="image/*">
                    </p>
                <p>
                    <button @click="simpan(rec.kd_buku)" class="btn btn-primary"><span class="fa fa-save"></span> Save</button>
                </p>
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
    created()
    {
        this.getkeategori();
        this.getpenerbit();
    },
    methods : {
         onImageChange(e){
				let file = e.target.files || e.dataTrasfer.files;
				if(!file.length)
					return;
				this.loadImage(file[0]);
			},
			loadImage(file){
				let reader = new FileReader();
				let vm = this;
				reader.onload = (e) => {
					vm.image = e.target.result
				};
				reader.readAsDataURL(file);
         },
        getkeategori()
        {
            axios.get('/getkategori')
        .then(response => {
            this.datas = response.data;
         })
        },
        getpenerbit()
        {
            axios.get('/getpenerbit')
        .then(response => {
            this.penerbits = response.data;
         })
        },
        simpan(id)
        {
            // swal( this.penerbit)
            axios.put('/api/update/'+ id + '/buku', {
                judul_buku : this.rec.judul_buku,
                isbn : this.rec.isbn ,
                pengarang : this.rec.pengarang ,
                kelas : this.rec.kelas ,
                th_terbit : this.rec.th_terbit ,
                halaman : this.rec.halaman ,
                sinopsis : this.rec.sinopsis ,
                jumlah : this.rec.jumlah ,
                kd_penerbit : this.rec.kd_penerbit ,
                kd_kategori : this.rec.kd_kategori ,
                image : this.image,
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
