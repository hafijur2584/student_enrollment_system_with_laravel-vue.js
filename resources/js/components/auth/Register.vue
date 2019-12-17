<template>
    <div class="container">
        <div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form @submit.prevent="signup">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" v-model="form.name">
          <div class="input-group-append input-group-text">
              <span class="fas fa-user"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" v-model="form.email">
          <div class="input-group-append input-group-text">
              <span class="fas fa-envelope"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" v-model="form.password">
          <div class="input-group-append input-group-text">
              <span class="fas fa-lock"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" v-model="form.password_confirmation">
          <div class="input-group-append input-group-text">
              <span class="fas fa-lock"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

      <router-link to="/" class="text-center">I already have an Account</router-link>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
    </div>
</template>

<script>
  export default {
    data(){
      return{
        form:{
          name:null,
          email:null,
          password:null,
          password_confirmation:null

        },
        errors:{}
      }
    },
    methods:{
      signup(){
        axios.post('/api/auth/register',this.form)
        .then(res => {
          localStorage.setItem('token',res.data.access_token);
          localStorage.setItem('user',res.data.name);
          this.$router.push({name:'home'})

          Toast.fire({
            icon: 'success',
            title: 'Signed in successfully'
          })
        })
        .catch(error => {
          this.errors = error.response.data.errors
          Toast.fire({
          icon: 'error',
          title: 'Invalid User name or password.'
        })
        });
      }
    },
    created(){
      if(User.loggedIn()){
        this.$router.push({name:'home'})
      }
    }
  }
</script>