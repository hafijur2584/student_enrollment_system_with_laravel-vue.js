<template>
  
</template>

<script>
  export default {
    
    created(){
      User.logout();

      Toast.fire({
            icon: 'success',
            title: 'Successfully Logout!'
      })
      this.$router.push({name:'/'})
    }
  }
</script>
