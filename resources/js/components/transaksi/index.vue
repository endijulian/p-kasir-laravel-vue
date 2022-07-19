<template>


    <div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body pb-2">
                <div class="row">
                    <div class="col-6">
                        <h6 class="text-capitalize ps-3">Transaksi</h6>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" v-model="searchTransaksi"  placeholder="Search customer name.... ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div  class="col-xl-12 col-lg-12">
          <div class="card mb-4 my-4">
            <div class="card-body">
              <div class="table-responsive" style="font-size: 12px">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th class="ps-2">No</th>
                      <th class="ps-2">Customer Name</th>
                      <th class="ps-2">Qty</th>
                      <th class="ps-2">Total</th>
                      <th class="ps-2">Bayar</th>
                      <th class="ps-2">Kembalian</th>
                      <th class="ps-2">Tanggal</th>
                      <th class="ps-2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(order, index) in filterSearch" :key="index.id">
                        <td>{{ ++index }}</td>
                        <td>{{ order.customer_name }}</td>
                        <td>{{ order.qty }}</td>
                        <td>{{ order.total }}</td>
                        <td>{{ order.pay }}</td>
                        <td>{{ order.change }}</td>
                        <td>{{ format_date(order.created_at) }}</td>
                        <td class="align-middle">
                            <router-link
                            :to="{name: 'detailTransaksi',
                            params: {id: order.id},
                            }"
                            class="text-secondary text-white font-weight-bold text-xs btn btn-sm btn-success" data-toggle="tooltip" data-original-title="Edit user">
                            Detail
                            </router-link>

                            <!-- <a href="#"
                            @click="Print(order.id)"
                            class="text-secondary text-white font-weight-bold text-xs btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Hapus">
                            Print
                            </a> -->

                            <a href="#"
                            @click="deleteOrder(order.id)"
                            class="text-secondary text-white font-weight-bold text-xs btn btn-sm btn-danger" data-toggle="tooltip" data-original-title="Hapus">
                            Hapus
                            </a>
                        </td>
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

import moment from 'moment'

export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push({ name: "/" });
        }
    },
    created() {
        this.Order();
    },
    data(){
        return{
            orders: [],
            searchTransaksi: "",
            image_src: '/imgKasir/mastercard.png',
        }
    },
    methods:{
        Order() {
        this.$isLoading(true)
        axios
            .get("/api/transaksi/")
            .then(({ data }) => (
                this.orders = data,
                this.$isLoading(false)
                ))
            .catch();
        },
        // Print(id) {
        // axios
        //     .get("/api/printTransaksi/" + id)
        //     .then(({ data }) => (
        //         this.orders = data
        //         ))
        //     .catch();
        // },
        deleteOrder(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.value) {
                axios
                    .delete("/api/deleteTransaksi/" + id)
                    .then(() => {
                        this.orders = this.orders.filter((orders) => {
                            return orders.id != id;
                        });
                    })
                    .catch(() => {
                        this.$router.push({ name: "transaksi" });
                    });
                    Swal.fire("Deleted!", "Your file has been deleted.", "success");
                }
            });
        },
        format_date(value){
            if (value) {
            return moment(String(value)).format('DD MM YYYY')
            }
        },
    },
    computed:{
        filterSearch() {
            return this.orders.filter((order) => {
                return order.customer_name.toLowerCase().match(this.searchTransaksi.toLowerCase());
            });
        },
    }
}
</script>
