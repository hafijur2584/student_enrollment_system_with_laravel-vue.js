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
                <h3 class="card-title">Subject Create</h3>
                <router-link to="/subject" class="btn bg-gradient-info float-right">All Subject</router-link>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="insert">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputName">Subject name</label>
                    <input type="text" class="form-control" id="exampleInputName" placeholder="Enter subject name" v-model="form.subject_name">
                  </div>
                  <div>
                    <small class="text-danger" v-if="errors.name"> {{ errors.subject_name[0] }} </small>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputCode">Subject code</label>
                    <input type="text" class="form-control" id="exampleInputCode" placeholder="Enter code" v-model="form.subject_code">
                  </div>
                  <div>
                    <small class="text-danger" v-if="errors.code"> {{ errors.subject_code[0] }} </small>
                  </div>
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
        subject_name:'',
        subject_code:''
      },
      errors:{}
    }
  },
  methods:{
    insert(){
      axios.post('/api/subject',this.form)
      .then(() => {
        this.$router.push({name:'subject'})

        Toast.fire({
          icon: 'success',
          title: 'inserted successfully.'
        })
      })
      .catch(error => this.errors = error.response.data.errors)
    }
  },
  created(){
    if(!User.loggedIn()){
      this.$router.push({name:'/'})
    }
  }
}
</script>
