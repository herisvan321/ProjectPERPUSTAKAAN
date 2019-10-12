<template>
    <div>
        <div class="modal fade" id="editkategori">
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
                    kategori : 
                    <input type="text" v-model="rec.kategori" class="form-control">
                </p>
                <p>
                    <button @click="simpan(rec.kd_kategori)" class="btn btn-primary"><span class="fa fa-save"></span> Save</button>
                     <button @click="clear()" class="btn btn-success"><span class="fa fa-refresh"></span> Clear</button>
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
           kategori : '',
           errors : [],
        }
    },
    methods : {
        simpan(id)
        {
            axios.put('/api/update/'+id+'/kategori',{
                'kategori' : this.rec.kategori,
            })
            .then(response => {
                this.$emit('datakategori', response)
                 if(response.data.sukses)
                {
                    swal(response.data.sukses,{
                        icon : 'success'
                    });
                }
                else if(response.data.gagal)
                {
                    swal(response.data.gagal,{
                        icon : 'warning'
                    });
                }
            })
            .catch(error => this.errors = error.response.data.errors)
        }   
    }
}
</script>
