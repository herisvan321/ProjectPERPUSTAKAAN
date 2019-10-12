<template>
    <div>
        <div class="modal fade" id="tambahdatabuku">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Input data buku</h4>
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
                    <input type="text" v-model="judul" class="form-control">
                     <p v-if="errors.judul_buku > 0">
                        <p v-for="err in errors.judul_buku" style="color:red">{{err}}</p>
                    </p>
                </p>
                 <p>
                    Isbn : 
                    <input type="email" v-model="isbn" class="form-control">
                     <p v-if="errors.isbn > 0">
                        <p v-for="err in errors.isbn" style="color:red">{{err}}</p>
                    </p>
                </p>
                <p>
                    Pengarang : 
                    <input type="email" v-model="pengarang" class="form-control">
                     <p v-if="errors.pengarang > 0">
                        <p v-for="err in errors.pengarang" style="color:red">{{err}}</p>
                    </p>
                </p>
                <p>
                    Kelas : 
                    <input type="email" v-model="kelas" class="form-control">
                     <p v-if="errors.kelas > 0">
                        <p v-for="err in errors.kelas" style="color:red">{{err}}</p>
                    </p>
                </p>
                <p>
                    Tahun Terbit : 
                    <input type="email" v-model="thn_terbit" class="form-control">
                     <p v-if="errors.th_terbit > 0">
                        <p v-for="err in errors.th_terbit" style="color:red">{{err}}</p>
                    </p>
                </p>
                 <p>
                    Halaman : 
                    <input type="email" v-model="halaman" class="form-control">
                     <p v-if="errors.halaman > 0">
                        <p v-for="err in errors.halaman" style="color:red">{{err}}</p>
                    </p>
                </p>
                 <p>
                    Sinopsis : 
                    <textarea class="form-control" v-model="sinopsis"></textarea>
                     <p v-if="errors.sinopsis > 0">
                        <p v-for="err in errors.sinopsis" style="color:red">{{err}}</p>
                    </p>
                </p>
                 <p>
                    Jumlah : 
                    <input type="email" v-model="jumlah" class="form-control">
                     <p v-if="errors.jumlah > 0">
                        <p v-for="err in errors.jumlah" style="color:red">{{err}}</p>
                    </p>
                </p>
                <p>
                    penerbit : 
                    <select v-model="penerbit" required class="form-control">
                        <option value="" hidden>==pilih==</option>
                        <option v-for="pnb in penerbits" :value="pnb.kd_penerbit">{{ pnb.nama_penerbit}}</option>
                    </select>
                     <p v-if="errors.kd_penerbit > 0">
                        <p v-for="err in errors.kd_penerbit" style="color:red">{{err}}</p>
                    </p>
                </p>
                <p>
                    Kategori : 
                    <select v-model="kategori"  required class="form-control" >
                        <option value="" hidden>==pilih==</option>
                        <option v-for="tk in datas" :value="tk.kd_kategori">{{ tk.kategori}}</option>
                    </select>
                     <p v-if="errors.kd_kategori > 0">
                        <p v-for="err in errors.kd_kategori" style="color:red">{{err}}</p>
                    </p>
                </p>
                <p>
                    Gambar : <br>
                    <p v-if="image">
                    <img :src="image" width="100" height="120">
                    </p>
                    <label for="foto" class="btn btn-info"><span class="fa fa-picture-o"></span> pilih Gambar</label>
                    <input type="file"  id="foto" @change="onImageChange" style="display:none" accept="image/*">
                     <p v-if="errors.image > 0">
                        <p v-for="err in errors.image" style="color:red">{{err}}</p>
                    </p>
                    </p>
                <p>
                    <button @click="simpan()" class="btn btn-primary"><span class="fa fa-save"></span> Save</button>
                     <button @click="cclear()" class="btn btn-success"><span class="fa fa-refresh"></span> Clear</button>
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
        simpan()
        {
            // swal( this.penerbit)
            axios.post('/api/save/buku', {
                judul_buku : this.judul,
                isbn : this.isbn ,
                pengarang : this.pengarang ,
                kelas : this.kelas ,
                th_terbit : this.thn_terbit ,
                halaman : this.halaman ,
                sinopsis : this.sinopsis ,
                jumlah : this.jumlah ,
                kd_penerbit : this.penerbit ,
                kd_kategori : this.kategori ,
                 image : this.image,
            })
            .then(response => {
                if(response.data.sukses)
                {
                    swal(response.data.sukses,{
                        icon : 'success'
                    });
                    this.cclear();
                    this.$emit('tbuku', response);
                    
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
        cclear()
        {
            this.judul = '';
            this.isbn = '';
            this.pengarang = '';
            this.kelas = '';
            this.thn_terbit = '';
            this.halaman = '';
            this.sinopsis = '';
            this.jumlah = '';
            this.penerbit = '';
            this.kategori = '';
            this.image = '';
            this.errors = [''];
        }
    }
}
</script>
