<template>
  <div class="container">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Forget Password</p>

          <form action="../../index3.html" method="post">
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Email">
              <div class="input-group-append input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
              <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Send</button>
            </div>
            </div>
          </form>
          <p class="mb-0">
            <router-link to="/" class="text-center">Back to login</router-link>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
  </div>
</template>

<script>
export default {
  mounted() {
    console.log('Component mounted.')
  }
}
</script>
