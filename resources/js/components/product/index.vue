<template>
    <div>

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body pb-2">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-capitalize ps-3">Data Product</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <router-link to="/storeProduct" class="btn btn-info me-2">Add Product</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card my-4">

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product Code</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Qty</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(prod, index) in product" :key="index.id">

                                    <td>
                                        <h6 class="mb-0 text-sm">{{ ++index }}</h6>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ prod.produck_name }}</h6>
                                        </div>
                                    </td>

                                    <td>
                                        <h6 class="mb-0 text-sm">{{ prod.produck_code }}</h6>
                                    </td>

                                    <td>
                                        <h6 class="mb-0 text-sm">{{ prod.category_name }}</h6>
                                    </td>

                                    <td>
                                        <h6 class="mb-0 text-sm">{{ prod.qty }}</h6>
                                    </td>

                                    <td>
                                        <h6 class="mb-0 text-sm">{{ prod.price | format_number }}</h6>
                                    </td>

                                    <td class="align-middle">
                                        <router-link
                                        :to="{name: 'editProduct',
                                        params: {id: prod.id},
                                        }"
                                        class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                        Edit
                                        </router-link>

                                        |

                                        <a href="#"
                                        @click="deleteProduct(prod.id)"
                                        class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Hapus">
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

    </div>
</template>


<script>
export default {
    created(){
        if(!User.loggedIn()){
            this.$router.push({name: '/'});
        }
    },
    data(){
        return{
            product: [],
            loading: false,
        };
    },
    methods:{
        allProduct(){
            this.$isLoading(true)
            axios
            .get("/api/product/")
            .then(({data}) => {
                this.product = data;
                this.$isLoading(false)
            })
            .catch();
        },
        deleteProduct(id) {
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
                    .delete("/api/product/" + id)
                    .then(() => {
                        this.product = this.product.filter((product) => {
                            return product.id != id;
                        });
                    })
                    .catch(() => {
                        this.$router.push({ name: "product" });
                    });
                Swal.fire("Deleted!", "Your file has been deleted.", "success");
                }
            });
        },
    },
    created(){
        this.allProduct();
    }
}
</script>


