<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All subject</h3>
        <router-link to="/subject/create" class="btn bg-gradient-info float-right">Add new</router-link>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <label for="exampleInputName">search</label>
        <input type="text" id="exampleInputName" placeholder="Search with Name" v-model="search">
        <table  class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Code</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="subject in searchData" :key="subject.id">
              <td>{{subject.subject_name}}</td>
              <td>{{subject.subject_code}}</td>
              <td>
                <router-link class="btn btn-info" :to="{name:'subjectEdit',params:{id:subject.id}}">edit</router-link>
                <a class="btn btn-danger" @click="subjectDelete(subject.id)">delete</a>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Code</th>
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
      subjects:[],
      search:''
    }
  },
  methods:{
    getSubject(){
      axios.get('/api/subject')
      .then((res) =>{
        this.subjects = res.data;
      })
      .catch()
    },
    subjectDelete(id){
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
          axios.delete('/api/subject/'+id)
          .then(()=>{
            this.subjects = this.subjects.filter(subject=>{
              return subject.id !=id
            })
          })
          .catch(()=>{
            this.$router.push({name:'subject'})
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
    this.getSubject();
  },
  computed:{
    searchData(){
      return this.subjects.filter(subject =>{
        return subject.subject_name.match(this.search)
      })
    }
  }
}
</script>
