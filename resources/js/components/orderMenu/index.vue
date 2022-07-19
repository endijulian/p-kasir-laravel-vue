<template>


    <div class="row">

        <div v-if="carts.length > 0" class="col-xl-12 col-lg-12">
          <div class="card mb-4">
            <div class="card-body">
              <div class="table-responsive" style="font-size: 12px">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th class="ps-2">Name</th>
                      <th class="ps-2">Qty</th>
                      <th class="ps-2">Unit</th>
                      <th class="ps-2">Total</th>
                      <th class="ps-2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="cart in carts" :key="cart.id">
                      <td>{{ cart.product_name }}</td>
                      <td>
                        <input type="text" style="width: 25px" readonly :value="cart.product_quantity">
                        <button
                          @click.prevent="increment(cart.id)"
                          class="btn btn-sm btn-success mt-3"
                        >
                          +
                        </button>
                        <button
                          @click.prevent="decrement(cart.id)"
                          class="btn btn-sm btn-danger mt-3"
                          v-if="cart.product_quantity >= 2"
                        >
                          -
                        </button>
                        <button class="btn btn-sm btn-danger mt-3" disabled v-else>
                          -
                        </button>
                      </td>
                      <td>Rp. {{ cart.product_price | format_number }}</td>
                      <td>Rp. {{ cart.sub_total | format_number }}</td>
                      <td>
                        <a
                          @click="removeItem(cart.id)"
                          class="btn btn-sm btn-primary text-white mt-3"
                          >X</a
                        >
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <ul class="list-group">
                <li
                  class="
                    list-group-item
                    d-flex
                    justify-content-between
                    align-items-center
                  "
                >
                  Total Quantity : <strong>{{ qty }}</strong>
                </li>
                <br>
                <li
                  class="
                    list-group-item
                    d-flex
                    justify-content-between
                    align-items-center
                  "
                >
                  Total : <strong>Rp. {{ subTotal | format_number }}</strong>
                </li>
              </ul>
              <br />
              <form action="" @submit.prevent="orderDone">
                <label for="">Customer Name</label>
                <div class="input-group input-group-outline" style="width: 500px;">
                    <input type="text" class="form-control" required v-model="customer_name">
                </div>
                <br />
                <label for="">Bayar</label>
                <div class="input-group input-group-outline" style="width: 500px;">
                    <input type="number" class="form-control" required v-model="pay">
                </div>
                <br />
                <label for="">Kembali</label>
                <div class="input-group input-group-outline" style="width: 500px;">
                    <input type="number" class="form-control" required v-model="change">
                </div>
                <br />
                <button type="submit" class="btn btn-success">Submit</button>
              </form>
            </div>
          </div>
        </div>

        <div class="col-xl-12 col-lg-12">
            <div class="card mb-5">
                <label class="form-label mt-2 p-2"><h6>Cari Menu Pesanan</h6></label>
                <div class="input-group input-group-outline mb-3 p-2">
                    <input type="text" class="form-control" v-model="searchTerm" placeholder="Search menu .... ">
                </div>
            </div>
        </div>

        <div class="col-md-3 col-3" v-for="(product, index) in filterSearch" :key="index.id">
            <div class="card">
                <div class="card-header mx-4 p-3 text-center">
                    <!-- <div class="icon icon-shape icon-lg bg-gradient-gray shadow text-center border-radius-lg mt-2"> -->
                        <img :src="product.image" alt="" width="150" height="150" class="border-radius-xl">
                    <!-- </div> -->
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <h6 class="text-center mb-0">{{ product.produck_name }}</h6>
                    <h5 class="mb-0">Rp. {{ product.price | format_number }}</h5>
                    <hr class="horizontal dark my-3">
                    <button  @click.prevent="AddToCart(product.id)" class="btn btn-sm btn-success">Tambah</button>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }
    },
    created() {
        this.allProduct();
        this.cartProduct();
        Reload.$on("AfterAdd", () => {
            this.cartProduct();
        });
    },
    data(){
        return{
            customer_name: "",
            pay: "",
            change: "",
            products: [],
            searchTerm: "",
            carts: [],
            image_src: '/imgKasir/logo.jpeg',
        }
    },
    computed:{
        filterSearch() {
            return this.products.filter((product) => {
                return product.produck_name.toLowerCase().match(this.searchTerm.toLowerCase());
            });
        },
        qty() {
            let sum = 0;
            for (let i = 0; i < this.carts.length; i++) {
                sum += parseFloat(this.carts[i].product_quantity);
            }
            return sum;
        },
        subTotal() {
            let sum = 0;
            for (let i = 0; i < this.carts.length; i++) {
                sum +=
                parseFloat(this.carts[i].product_quantity) *
                parseFloat(this.carts[i].product_price);
            }
            return sum;
        },
    },
    methods:{
        allProduct() {
        this.$isLoading(true)
        axios
            .get("/api/product/")
            .then(({ data }) => (
                this.products = data,
                this.$isLoading(false)
            ))
            .catch();
        },
        AddToCart(id) {
        axios
            .get("/api/addToCart/" + id)
            .then(() => {
                Reload.$emit("AfterAdd");
                Notification.cart_success();
            })
            .catch();
        },
        cartProduct() {
        axios
            .get("/api/cart/product/")
            .then(({ data }) => (this.carts = data))
            .catch();
        },
        increment(id) {
        axios
            .get("/api/increment/" + id)
            .then(() => {
            Reload.$emit("AfterAdd");
                Notification.success();
            })
            .catch();
        },
        decrement(id) {
            axios
                .get("/api/decrement/" + id)
                .then(() => {
                Reload.$emit("AfterAdd");
                    Notification.success();
                })
                .catch();
            },
            removeItem(id) {
                axios
                .get("/api/remove/cart/" + id)
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Notification.cart_delete();
                })
                .catch();
            },
            orderDone() {
                // let total = this.subTotal;
                var data = {
                    qty: this.qty,
                    customer_name: this.customer_name,
                    pay: this.pay,
                    change: this.change,
                    total: this.subTotal,
                };

                axios.post("/api/orderdone", data).then(() => {
                    Reload.$emit("AfterAdd");
                    Notification.success();
                });
        },
    }
}
</script>
