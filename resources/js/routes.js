
let login       = require('./components/auth/login.vue').default;
let logout      = require('./components/auth/logout.vue').default;


//Setelah login
let home        = require('./components/home.vue').default;

//Component User
let user        = require('./components/user/index.vue').default;
let edituser    = require('./components/user/edit.vue').default;
let storeuser   = require('./components/user/create.vue').default;

//Component Category
let category        = require('./components/category/index.vue').default;
let editCategory    = require('./components/category/edit.vue').default;
let storeCategory   = require('./components/category/create.vue').default;


export const routes = [
    { path: '/',component: login, name: '/' },
    { path: '/logout',component: logout, name: 'logout' },
    { path: '/home', component: home, name: 'home' },


    //User Route
    { path: '/user', component: user, name: 'user' },
    { path: '/edituser/:id', component: edituser, name: 'edituser' },
    { path: '/storeuser', component: storeuser, name: 'storeuser' },

    //Category Route
    { path: '/category', component: category, name: 'category' },
    { path: '/editCategory/:id', component: editCategory, name: 'editCategory' },
    { path: '/storeCategory', component: storeCategory, name: 'storeCategory' },
  ]
