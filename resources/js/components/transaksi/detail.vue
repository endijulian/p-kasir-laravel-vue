<template>


    <div class="row">

        <div class="col-xl-12 col-lg-12">
          <div class="card mb-4">
            <div class="card-body">
              <div class="table-responsive" style="font-size: 12px">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th class="ps-2">Product</th>
                      <th class="ps-2">Qty</th>
                      <th class="ps-2">Price</th>
                      <th class="ps-2">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="order in orderDetails" :key="order.id">
                      <td>{{ order.product.produck_name }}</td>
                      <td>{{ order.quantity }}</td>
                      <td>Rp. {{ order.price | format_number }}</td>
                      <td>Rp. {{ order.total | format_number }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><h6>{{ qty }}</h6></td>
                        <td></td>
                        <td><h6>Rp. {{ subTotal | format_number }}</h6></td>
                    </tr>
                  </tbody>
                </table>
              </div>
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
        this.detailTransaksi()
    },
    data(){
        return{
            orderDetails: [],
            image_src: '/imgKasir/mastercard.png',
        }
    },
    methods: {
        detailTransaksi(){
            let id = this.$route.params.id;
            this.$isLoading(true)

            axios
            .get("/api/detailTransaksi/" + id)
            .then(({data}) => {
                this.orderDetails = data;
                this.$isLoading(false)
            })
            .catch();
        },
    },
    computed:{
        qty() {
            let sum = 0;
            for (let i = 0; i < this.orderDetails.length; i++) {
                sum += parseFloat(this.orderDetails[i].quantity);
            }
            return sum;
        },
        subTotal() {
            let sum = 0;
            for (let i = 0; i < this.orderDetails.length; i++) {
                sum +=
                parseFloat(this.orderDetails[i].quantity) *
                parseFloat(this.orderDetails[i].price);
            }
            return sum;
        },
    },
}
</script>
