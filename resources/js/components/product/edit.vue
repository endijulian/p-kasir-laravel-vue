<template>

    <div class="card card-frame">

        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <div class="row">
                    <div class="col-6">
                        <h6 class="text-white text-capitalize ps-3">Edit Product</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form @submit.prevent="productUpdate">
                <div class="row">
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <div class="input-group input-group-outline">
                                <input type="text" class="form-control" v-model="form.produck_name">
                            </div>
                            <small class="text-danger" v-if="errors.produck_name">{{ errors.produck_name[0] }}</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Product Code</label>
                            <div class="input-group input-group-outline">
                                <input type="text" class="form-control" v-model="form.produck_code">
                            </div>
                            <small class="text-danger" v-if="errors.produck_code">{{ errors.produck_code[0] }}</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <div class="input-group input-group-outline ">
                                <select class="form-control mb-3" id="exampleFormControlSelect1" v-model="form.category_id">
                                    <option v-for="cat in category" :key="cat.id" :value="cat.id">{{ cat.category_name }}</option>
                                </select>
                            </div>
                            <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Qty</label>
                            <div class="input-group input-group-outline my">
                                <input type="text" class="form-control" v-model="form.qty">
                            </div>
                            <small class="text-danger" v-if="errors.qty">{{ errors.qty[0] }}</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <div class="input-group input-group-outline my">
                                <input type="text" class="form-control" v-model="form.price">
                            </div>
                            <small class="text-danger" v-if="errors.price">{{ errors.price[0] }}</small>
                        </div>

                    </div>
                </div>

                <div class="col-md-12 d-flex justify-content-center mt-5">
                    <button type="submit" class="btn btn-info">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

</template>

<script>
export default {

    created(){
        if(!User.loggedIn()){
            this.$router.push({name: "/"});
        }
    },

    data(){
        return{
            form:{
                produck_name: "",
                produck_code: "",
                category_id: "",
                price : "",
                qty : ""
            },
            errors:{},
            category:{},
        }
    },
     created(){
        let id = this.$route.params.id;

        axios.get("/api/product/" + id).then(({ data }) => (this.form = data)).catch(console.log("Data Eror"));

        axios.get("/api/category/").then(({ data }) => (this.category = data));
    },
    methods: {
        productUpdate(){
             let id = this.$route.params.id;
             axios
                .patch("/api/product/" + id, this.form)
                .then(() => {
                this.$router.push({ name: "product" });
                Notification.success();
                })
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },

}
</script>
