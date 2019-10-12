<template>
    <div>
        <div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Input biodata Siswa</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="container" style="background:#fff">
         <p>
           Nama :
           <span v-if="rec.nama_siswa">
             <input type="text" class="form-control" v-model="rec.nama_siswa" >
             <input type="hidden" v-model="rec.id_user">
            
           </span>
           <span v-else>
              <input type="text" class="form-control" v-model="rec.name" >
             <input type="hidden" v-model="rec.id_user">
           </span>
             <p v-if="errors.name > 0">
               <p v-for="err of errors.name" style="color:red">
                 {{ err }}
               </p>
           </p>
         </p>
          
          <p>
           Nis :
           <span v-if="rec.nis">
              <input type="text" class="form-control" v-model="rec.nis">
           </span>
           <span v-else>
              <input type="text" class="form-control" v-model="nis">
           </span>
           <p v-if="errors.nis > 0">
               <p v-for="err of errors.nis" style="color:red">
                 {{ err }}
               </p>
           </p>
         </p>
          <p>
           Jenis Kelamin :
           <span v-if="rec.jk">
           <select v-model="rec.jk" class="form-control">
             <option value="Laki-Laki">Laki-Laki</option>
             <option value="Perempuan">Perempuan</option>
           </select>
           </span>
           <span v-else>
           <select v-model="jk" class="form-control">
             <option value="Laki-Laki">Laki-Laki</option>
             <option value="Perempuan">Perempuan</option>
           </select>
           </span>
            <p v-if="errors.jk > 0">
               <p v-for="err of errors.jk" style="color:red">
                 {{ err }}
               </p>
           </p>
         </p>
          <p>
           Agama :
           <span v-if="rec.agama">
           <input type="text" class="form-control" v-model="rec.agama">
           </span>
           <span v-else>
           <input type="text" class="form-control" v-model="agama">
           </span>
            <p v-if="errors.agama > 0">
               <p v-for="err of errors.agama" style="color:red">
                 {{ err }}
               </p>
           </p>
         </p>
          <p>
           tempat lahir :
            <span v-if="rec.tp_lahir">
           <input type="text" class="form-control" v-model="rec.tp_lahir">
           </span>
           <span v-else>
           <input type="text" class="form-control" v-model="tmplahir">
           </span>
            <p v-if="errors.tmplahir > 0">
               <p v-for="err of errors.tmplahir" style="color:red">
                 {{ err }}
               </p>
           </p>
         </p>
          <p>
           tanggal lahir :
           <span v-if="rec.tgl_lahir">
           <input type="date" class="form-control" v-model="rec.tgl_lahir">
           </span>
           <span v-else>
           <input type="date" class="form-control" v-model="tgllahir">
           </span>
            <p v-if="errors.tgllahir > 0">
               <p v-for="err of errors.tgllahir" style="color:red">
                 {{ err }}
               </p>
           </p>
         </p>
          <p>
           No Hp :
           <span v-if="rec.nohp">
           <input type="text" class="form-control" v-model="rec.nohp">
           </span>
           <span v-else>
           <input type="text" class="form-control" v-model="nohp">
           </span>
            <p v-if="errors.nohp > 0">
               <p v-for="err of errors.nohp" style="color:red">
                 {{ err }}
               </p>
           </p>
         </p>
          <p>
           alamat :
           <span v-if="rec.alamat">
            <textarea class="form-control" v-model="rec.alamat"></textarea>
           </span>
           <span v-else>
            <textarea class="form-control" v-model="alamat"></textarea>
           </span>
           <p v-if="errors.alamat > 0">
               <p v-for="err of errors.alamat" style="color:red">
                 {{ err }}
               </p>
           </p>
         </p>
          <p>
           Foto : <br>
            <p v-if="image">
            <img :src="image" width="100" height="120">
            </p>
            <p v-else-if="rec.foto">
              <img :src="'/upload/siswa/' + rec.foto" width="100" height="120">
            </p>

           <label for="foto" class="btn btn-info"><span class="fa fa-picture-o"></span> pilih foto</label>
           <input type="file"  id="foto"  @change="onImageChange" style="display:none" accept="image/*">
            <p v-if="errors.image > 0">
               <p v-for="err of errors.image" style="color:red">
                 {{ err }}
               </p>
           </p>
         </p>
         <p v-if="rec.nama_siswa">
           <button class="btn btn-success" @click="update(rec.id_user)"><span class="fa fa-save"></span> save</button>
         </p>
         <p v-else>
          <button class="btn btn-primary" @click="simpan()"><span class="fa fa-save"></span> save</button>
         </p>
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
  data: function(){
    return{
      nis : '',
      jk : '',
      agama : '',
      tmplahir: '',
      tgllahir : '',
      nohp : '',
      alamat : '',
      image : '',
      errors : [],
    }
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
      simpan()
      {
        axios.post('/api/save/siswa', {
          image : this.image,
          id_user : this.rec.id_user,
          name : this.rec.name,
          nis : this.nis,
          jk : this.jk,
          agama : this.agama,
          tmplahir: this.tmplahir,
          tgllahir : this.tgllahir,
          nohp : this.nohp,
          alamat : this.alamat,
        })
        .then(response => {
            this.$emit('biodatasiswa', response);
            if(response.data.sukses){
                swal(response.data.sukses,{
                  icon : 'success'
              });
                this.$router.go(0)
            }
            else if(response.data.gagal){
                swal(response.data.gagal,{
                    icon : 'warning'
                });
            }
            
        })
        .catch(error => {
            this.errors = error.response.data.errors;
            
        })
      },
      update(id_user)
      {
        axios.put('/api/update/'+ id_user +'/siswa', {
            image : this.image,
            name : this.rec.nama_siswa,
            nis : this.rec.nis,
            jk : this.rec.jk,
            agama : this.rec.agama,
            tmplahir: this.rec.tp_lahir,
            tgllahir : this.rec.tgl_lahir,
            nohp : this.rec.nohp,
            alamat : this.rec.alamat,
        })
        .then(response => {
            this.$emit('biodatasiswa', response);
            if(response.data.sukses){
                swal(response.data.sukses,{
                    icon : 'success'
                });
                this.$router.go(0)
            }
            else if(response.data.gagal){
                swal(response.data.gagal,{
                    icon : 'warning'
                });
            }
            
        })
        .catch(error => 
            this.errors = error.response.data.errors
            
        )
      }
  }
}
</script>

