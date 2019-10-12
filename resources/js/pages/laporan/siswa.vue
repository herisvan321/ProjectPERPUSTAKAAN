<template>
     <div>
            <div id="modal">
                    <biodatasiswa :rec="tampils" @biodatasiswa="refresh"></biodatasiswa>
                    <edituser :recc="edits" @editdata ="refresh"></edituser>
                </div>
<ul class='breadcrumb'>
    <li><router-link to='/' >Home</router-link></li> 
    <li><router-link to='#' class='active'>Laporan data Siswa</router-link></li>                   
</ul>

<div  class="container">
    <p class="tulisanhidden"><span class="fa fa-arrow-circle-o-right"></span>  Data Buku</p>
    <div class="row">
        
        <div class="col-md-12">
            <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Laporan data Siswa</h3>
                 <a href="/home/cetak/siswa" class="btn btn-info float-right" >
    <span class="fa fa-print"></span></a>
            </div>
            <div class="panel-body">
                <br>
            
                    <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>nis</th>
                                <th>jK.</th>
                                <th>Agama</th>
                                <th>tempat/tgl. Lahir</th>
                                <th>No Hp</th>
                                <th>Alamat</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="t, index in datas">
                                    <td>{{index + 1}}</td>
                                    <td>{{ t.name}}</td>
                                    <td>{{ t.nis}}</td>
                                    <td>{{ t.jk}}</td>
                                    <td>{{ t.agama}}</td>
                                    <td>{{ t.tp_lahir}} / {{ t.tgl_lahir}}</td>
                                    <td>{{ t.nohp}}</td>
                                    <td>{{ t.alamat}}</td>
                                    
                                  </tr>
                            </tbody>
                          </table>
            </div>
        </div>
           
        </div>
    </div>
</div>

    </div>
    
</template>
<script>

Vue.prototype.$userId = document.querySelector("meta[name ='user-id']").getAttribute('content');
export default {
    data(){
        return{
         
            errors : [],
            datas : {},
            tampils : {},
            edits : {}
        }
    },
    mounted() {
		// Fetch initial results
        this.getResults();
           if(this.$userId != 'petugas' )
        {
            if(this.$userId != 'kepsek')
            {
                alert('anda tidak memiliki hak akses!');
                this.$router.push({path : '/'});
            }
            else if(this.$userId == 'siswa')
             {
                alert('anda tidak memiliki hak akses!');
                this.$router.push({path : '/'});
            }
        }
	},
    methods : {
        getResults() {
			axios.get('laporan/getdatasiswa')
				.then(response => {
					this.datas = response.data;
				});
		},
        simpan()
        {
            axios.post('api/save/user',{
                'nama' : this.nama,
                'email' : this.email,
                'level' : this.level,
                'password' : this.password
            })
            .then(response => {
                this.nama = '';
                this.email = '';
                this.level = '';
                this.password = '';
                if(response.data.sukses)
                {
                    this.getResults();
                    alert(response.data.sukses);
                }
                elseif(response.data.gagal)
                {
                    alert(response.data.gagal);
                }
            })
            .catch(error => this.errors = error.response.data.errors)
        },
        tampil(id)
        {
            axios.get('/api/tampil/'+ id +'/siswa')
            .then(response => {
                console.log(id)
                this.tampils = response.data
            })
            .catch(e => {
                console.log(e)
            })
        },
        edit(id)
        {
            axios.get('/api/show/'+ id +'/user')
            .then(response => {
                console.log(id)
                this.edits = response.data
            })
            .catch(e => {
                console.log(e)
            })
        },
        refresh()
        {
            this.getResults()
        }
    }
}
</script>
