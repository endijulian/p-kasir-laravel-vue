<template>


    <div class="row">

        <div class="col-xl-12 col-lg-12">
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
                      <td>{{ cart.product_price }}</td>
                      <td>{{ cart.sub_total }}</td>
                      <td>
                        <!-- <a
                          @click="removeItem(cart.id)"
                          class="btn btn-sm btn-primary text-white"
                          >X</a
                        > -->
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- <div class="card-footer">
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
                <li
                  class="
                    list-group-item
                    d-flex
                    justify-content-between
                    align-items-center
                  "
                >
                  Sub Total : <strong>{{ subTotal }} $</strong>
                </li>
                <li
                  class="
                    list-group-item
                    d-flex
                    justify-content-between
                    align-items-center
                  "
                >
                  Vat : <strong>{{ vats.vat }} %</strong>
                </li>
                <li
                  class="
                    list-group-item
                    d-flex
                    justify-content-between
                    align-items-center
                  "
                >
                  Total :
                  <strong
                    >{{ (subTotal * vats.vat) / 100 + subTotal }} $</strong
                  >
                </li>
              </ul>
              <br />
              <form action="" @submit.prevent="orderDone">
                <label for="">Customer Name</label>
                <select class="form-control" v-model="customer_id">
                  <option
                    :value="customer.id"
                    v-for="customer in customers"
                    :key="customer.id"
                  >
                    {{ customer.name }}
                  </option>
                </select>
                <label for="">Pay</label>
                <input
                  type="text"
                  class="form-control"
                  required
                  v-model="pay"
                />
                <label for="">Due</label>
                <input
                  type="text"
                  class="form-control"
                  required
                  v-model="due"
                />
                <label for="">Pay By</label>
                <select class="form-control" v-model="payby">
                  <option value="HandCash">Hand Cash</option>
                  <option value="Cheaque">Cheaque</option>
                  <option value="GiftCard">Gift Card</option>
                </select>
                <br />
                <button type="submit" class="btn btn-success">Submit</button>
              </form>
            </div> -->
          </div>
        </div>

        <div class="col-xl-12 col-lg-12">
            <div class="card mb-5">
                <label class="form-label mt-2"><h6>Cari Menu Pesanan</h6></label>
                <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" v-model="searchTerm" placeholder="Search menu .... ">
                </div>
            </div>
        </div>

        <div class="col-md-3 col-3" v-for="(product, index) in filterSearch" :key="index.id">
            <div class="card">
                <div class="card-header mx-4 p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-gradient-gray shadow text-center border-radius-lg mt-2">
                        <img :src="image_src" alt="" width="50" height="50">
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <h6 class="text-center mb-0">{{ product.produck_name }}</h6>
                    <h5 class="mb-0">{{ product.price | format_number }}</h5>
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
            products: [],
            searchTerm: "",
            carts: [],
            image_src: '/imgKasir/mastercard.png',
        }
    },
    computed:{
        filterSearch() {
            return this.products.filter((product) => {
                return product.produck_name.toLowerCase().match(this.searchTerm.toLowerCase());
            });
        },
    },
    methods:{
        allProduct() {
        axios
            .get("/api/product/")
            .then(({ data }) => (this.products = data))
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
    }
}
</script>
