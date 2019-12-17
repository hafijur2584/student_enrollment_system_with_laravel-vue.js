<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All employee</h3>
        <router-link to="/employee/create" class="btn bg-gradient-info float-right">Add new</router-link>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <label for="exampleInputName">search</label>
        <input type="text" id="exampleInputName" placeholder="Search with phone" v-model="search">
        <table  class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Phone</th>
              <th>Photo</th>
              <th>Salary</th>
              <th>Joining date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="employee in searchData" :key="employee.id">
              <td>{{employee.name}}</td>
              <td>{{employee.phone}}</td>
              <td><img style="height:40px;width:40px" :src="employee.photo" alt=""></td>
              <td> {{employee.salary}}</td>
              <td> {{employee.date}}</td>
              <td>
                <router-link class="btn btn-info" :to="{name:'employeeEdit',params:{id:employee.id}}">edit</router-link>
                <a class="btn btn-danger" @click="employeeDelete(employee.id)">delete</a>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Phone</th>
              <th>Photo</th>
              <th>Salary</th>
              <th>Joining date</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      employees:[],
      search:''
    }
  },
  methods:{
    getEmployee(){
      axios.get('/api/employee')
      .then((res) =>{
        this.employees = res.data;
      })
      .catch()
    },
    employeeDelete(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          axios.delete('/api/employee/'+id)
          .then(()=>{
            this.employees = this.employees.filter(employee=>{
              return employee.id !=id
            })
          })
          .catch(()=>{
            this.$router.push({name:'employee'})
          })
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        }
      })
    }
  },
  created(){
    if(!User.loggedIn()){
      this.$router.push({name:'/'})
    }
  },
  mounted(){
    this.getEmployee();
  },
  computed:{
    searchData(){
      return this.employees.filter(employee =>{
        return employee.phone.match(this.search)
      })
    }
  }
}
</script>
