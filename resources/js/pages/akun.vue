<template>
     <div>
            
<ul class='breadcrumb'>
    <li><router-link to='/' >Home</router-link></li> 
    <li><router-link to='#' class='active'>Akun</router-link></li>                   
</ul>
<p class="tulisanhidden">sa</p>
<div class="contariner-fluid">
		<div class="row">
			<div class="col-md-4">
				 <div class="panel panel-info">
				    <div class="panel-heading">
				        <h3 class="panel-title">Form Edit User</h3>
				    </div>
				    <div class="panel-body">
				
				<p>Name</p>
				<input type="text" v-model="datas.name" class="form-control" >
				<p>Email</p>
				<input type="email" v-model="datas.email" class="form-control" >
				<p>Password</p>
				<input type="password" v-model="password" class="form-control" placeholder="Password">
				<br>
				<input type="submit" @click="simpan()" class="btn btn-info" value="update">
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
            password : '',
        }
    },
    created()
    {
        this.getdata();
        console.log(this.$userId);  
        
    },
    methods : {
        getdata()
        {
            axios.get('/setting/akun')
        .then(response => {
            this.datas = response.data;
         })
        },
        simpan()
        {
            axios.put('/setting/akun/simpan',{
                'name' : this.datas.name,
                'email' : this.datas.email,
                password : this.password,
            })
            .then(response => {
                 if(response.data.sukses)
                    {
                        alert(response.data.sukses);
                        this.$router.go(0);
                    }
                    else if(response.data.gagal)
                    {
                        alert(response.data.gagal);
                    }
            })
        },
       
    }
}
</script>
