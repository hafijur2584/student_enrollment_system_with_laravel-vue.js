//authentication start
let Login = require('./components/auth/Login.vue').default;
let Register = require('./components/auth/Register.vue').default;
let Forget = require('./components/auth/Forget.vue').default;
let Logout = require('./components/auth/Logout.vue').default;
let Home = require('./components/Home.vue').default;
//authentication end

//employee start
let EmployeeCreate = require('./components/employee/Create.vue').default;
let EmployeeEdit = require('./components/employee/Edit.vue').default;
let EmployeeList = require('./components/employee/Index.vue').default;
//employee end

//subject start
let SubjectCreate = require('./components/subject/Create.vue').default;
let SubjectEdit = require('./components/subject/Edit.vue').default;
let SubjectList = require('./components/subject/Index.vue').default;
//subject end
export const routes = [
  { path: '/', component: Login,name:'/' },
  { path: '/register', component: Register,name:'register' },
  { path: '/forget', component: Forget,name:'forget' },
  { path: '/logout', component: Logout,name:'logout' },
  { path: '/home', component: Home,name:'home' },
  { path: '/employee/create', component: EmployeeCreate,name:'employeeStore' },
  { path: '/employee/edit/:id', component: EmployeeEdit,name:'employeeEdit' },
  { path: '/employee', component: EmployeeList,name:'employee' },
  { path: '/subject/create', component: SubjectCreate,name:'subjectStore' },
  { path: '/subject/edit/:id', component: SubjectEdit,name:'subjectEdit' },
  { path: '/subject', component: SubjectList,name:'subject' }
]