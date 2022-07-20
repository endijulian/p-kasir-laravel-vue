<template>

    <div>
        <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">account_balance_wallet</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Transaksi Hari Ini</p>
                <h4 class="mb-0">Rp {{ sellToday | format_number }}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
             <!-- /\ <p class="mb-0"><router-link to="/transaksi">More Info</router-link></p> -->
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">assignment</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Product Transaksi Terakhir</p>
                <h4 class="mb-0">{{ product }}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <!-- <p class="mb-0">More Info</p> -->
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">assignment_turned_in</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Stock Barang Masuk Hari Ini</p>
                <h4 class="mb-0">{{ stockToday }}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <!-- <p class="mb-0"><router-link to="/barangMasuk">More Info</router-link></p> -->
            </div>
          </div>
        </div>
        </div>

        <div class="row mt-3">
            <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
                <div class="card border-radius-xl">
                    <img :src="imageBg" alt="" class="p-0 border-radius-xl" height="500">
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    created(){
        if(!User.loggedIn()){
            this.$router.push({name : '/'});
        }
    },
    data(){
        return{
            imageBg: "/imgKasir/logo.jpeg",
            stockToday : "",
            sellToday : "",
            product :"",
        }
    },
    mounted(){
        this.todayStock();
        this.todaySell();
        this.todayProduct();
    },
    methods:{
        todayStock() {
        axios
            .get("/api/stockToday/")
            .then(({ data }) => (this.stockToday = data))
            .catch((error) => (this.errors = error.response.data.errors));
        },
        todaySell() {
        axios
            .get("/api/sellToday/")
            .then(({ data }) => (this.sellToday = data))
            .catch((error) => (this.errors = error.response.data.errors));
        },
        todayProduct() {
        axios
            .get("/api/todayProduct/")
            .then(({ data }) => (this.product = data))
            .catch((error) => (this.errors = error.response.data.errors));
        },
    }
}
</script>
