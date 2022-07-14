
require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import loading from 'vuejs-loading-screen'
import { PdfViewerPlugin } from '@syncfusion/ej2-vue-pdfviewer';

Vue.use(VueRouter)
Vue.use(loading)


// PDF print
Vue.use(PdfViewerPlugin);


//Number format
Vue.filter('format_number', function (value){
    return parseInt(value).toLocaleString()
})

//Window Reload
window.Reload = new Vue();

//Import User Class
import User from './Helpers/User';
window.User = User;

//import notification
import Notification from './Helpers/Notification';
window.Notification = Notification;

//import route file routes.js
import {routes} from './routes';

//sweet alert Start
import Swal from 'sweetalert2'
window.Swal = Swal;


const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast;

// sweet alert end

const router = new VueRouter({
    routes,
    mode: 'history',
    linkActiveClass: "active", // active class for non-exact links.
    linkExactActiveClass: "active" // active class for *exact* links.
})


const app = new Vue({
    el: '#app',
    router,
});
