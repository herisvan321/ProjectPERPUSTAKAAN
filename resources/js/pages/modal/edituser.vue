<template>
    <div>
        <div class="modal fade" id="edituser">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit data User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="container">
         <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-body">
                  <p>
                    Nama : 
                    <input type="text" v-model="recc.name" class="form-control">
                </p>
                 <p>
                    Email : 
                    <input type="email" v-model="recc.email" class="form-control">
                </p>
                <p>
                    Pilihan : 
                    <select v-model="recc.level" required class="form-control">
                        <option value="" hidden>==pilih==</option>
                        <option value="petugas">Petugas Perpus</option>
                        <option value="siswa">Siswa</option>
                        <option value="kepsek">Kepala Sekolah</option>
                    </select>
                </p>
                <p>
                    Password : 
                    <input type="password" v-model="password" class="form-control">
                </p>
                <p>
                    <button @click="updatedata(recc.id_user)" class="btn btn-primary"><span class="fa fa-save"></span> Save</button>
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
    props : ['recc'],
    data(){
        return{
            password : '',
            errors : [],
        }
    },
   methods : {
        updatedata(id_user){
        axios.put('/api/update/'+id_user+'/user',{
            name : this.recc.name,
            email : this.recc.email,
            level : this.recc.level,
            password : this.password
        })
        .then(response => {
            if(response.data.sukses)
            {
                swal(response.data.sukses,{
                    icon : 'success'
                });
                this.$router.go(0)
            }
            else if(response.data.gagal)
            {
                swal(response.data.gagal,{
                    icon : 'warning'
                })
            }
        })
        .catch(error => this.errors = error.response.data.errors)
    }
   }
}
</script>
