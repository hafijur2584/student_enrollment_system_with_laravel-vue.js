<template>
  <div class="container">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Employee Create</h3>
                <router-link to="/employee" class="btn bg-gradient-info float-right">All employee</router-link>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="insert">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputName">Employee name</label>
                    <input type="text" class="form-control" id="exampleInputName" placeholder="Enter full name" v-model="form.name">
                  </div>
                  <div>
                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" v-model="form.email">
                  </div>
                  <div>
                    <small class="text-danger" v-if="errors.email"> {{ errors.email[0] }} </small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputAddress">Address</label>
                    <input type="text" class="form-control" id="exampleInputAddress" placeholder="Enter address" v-model="form.address">
                  </div>
                  <div>
                    <small class="text-danger" v-if="errors.email"> {{ errors.address[0] }} </small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPhone">Phone</label>
                    <input type="text" class="form-control" id="exampleInputPhone" placeholder="Enter phone" v-model="form.phone">
                  </div>
                  <div>
                    <small class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }} </small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputSalary">Employee salary</label>
                    <input type="text" class="form-control" id="exampleInputSalary" placeholder="Enter salary" v-model="form.salary">
                  </div>
                  <div>
                    <small class="text-danger" v-if="errors.salary"> {{ errors.salary[0] }} </small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputNid">Employee Nid</label>
                    <input type="text" class="form-control" id="exampleInputNid" placeholder="Enter nid" v-model="form.nid">
                  </div>
                  <div>
                    <small class="text-danger" v-if="errors.nid"> {{ errors.nid[0] }} </small>
                  </div>
                  <div class="form-group">
                    <label>Joining date:</label>

                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                      </div>
                      <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" im-insert="true" v-model="form.date">
                    </div>
                    <!-- /.input group -->
                  </div>
                  <div>
                    <small class="text-danger" v-if="errors.date"> {{ errors.date[0] }} </small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" @change="onFileselected">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>

                    </div>
                  </div>
                  <div>
                    <small class="text-danger" v-if="errors.photo"> {{ errors.photo[0] }} </small>
                  </div>
                  <img style="height:50px;width:50px;" :src="form.photo" alt="">
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->



          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
export default {
  data(){
    return{
      form:{
        name:'',
        email:'',
        address:'',
        phone:'',
        salary:'',
        nid:'',
        date:'',
        photo:''
      },
      errors:{}
    }
  },
  methods:{
    insert(){
      axios.post('/api/employee',this.form)
      .then(() => {
        this.$router.push({name:'employee'})

        Toast.fire({
          icon: 'success',
          title: 'inserted successfully.'
        })
      })
      .catch(error => this.errors = error.response.data.errors)
    },
    onFileselected(event){
      let file = event.target.files[0];
      if(file.size > 1048770){
        Toast.fire({
          icon: 'error',
          title: 'Please use less than 1mb file.'
        })
      }else{
        let reader = new FileReader();
        reader.onload = event => {
          this.form.photo = event.target.result
        };
        reader.readAsDataURL(file);
      }
    }
  },
  created(){
    if(!User.loggedIn()){
      this.$router.push({name:'/'})
    }
  }
}
</script>
