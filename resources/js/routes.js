
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

//Component Product
let product        = require('./components/product/index.vue').default;
let editProduct    = require('./components/product/edit.vue').default;
let storeProduct   = require('./components/product/create.vue').default;


//Component Barang Masuk
let barangMasuk        = require('./components/barangMasuk/index.vue').default;
let editBarangMasuk    = require('./components/barangMasuk/edit.vue').default;
let storeBarangMasuk   = require('./components/barangMasuk/create.vue').default;

//Component Barang Masuk
let barangKeluar        = require('./components/barangKeluar/index.vue').default;
let editBarangKeluar    = require('./components/barangKeluar/edit.vue').default;
let storeBarangKeluar   = require('./components/barangKeluar/create.vue').default;

//Component Order Menu
let orderMenu        = require('./components/orderMenu/index.vue').default;

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

     //Product Route
     { path: '/product', component: product, name: 'product' },
     { path: '/editProduct/:id', component: editProduct, name: 'editProduct' },
     { path: '/storeProduct', component: storeProduct, name: 'storeProduct' },

     //Barang Masuk Route
     { path: '/barangMasuk', component: barangMasuk, name: 'barangMasuk' },
     { path: '/editBarangMasuk/:id', component: editBarangMasuk, name: 'editBarangMasuk' },
     { path: '/storeBarangMasuk', component: storeBarangMasuk, name: 'storeBarangMasuk' },

     //Barang Keluar Route
     { path: '/barangKeluar', component: barangKeluar, name: 'barangKeluar' },
     { path: '/editBarangKeluar/:id', component: editBarangKeluar, name: 'editBarangKeluar' },
     { path: '/storeBarangKeluar', component: storeBarangKeluar, name: 'storeBarangKeluar' },

     //Barang Keluar Route
     { path: '/orderMenu', component: orderMenu, name: 'orderMenu' },
  ]
