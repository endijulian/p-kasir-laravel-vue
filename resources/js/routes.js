
let login       = require('./components/auth/login.vue').default;
let logout      = require('./components/auth/logout.vue').default;


//Setelah login
let home        = require('./components/home.vue').default;


export const routes = [
    { path: '/',component: login, name: '/' },
    { path: '/logout',component: logout, name: 'logout' },
    { path: '/home', component: home, name: 'home' },
  ]
