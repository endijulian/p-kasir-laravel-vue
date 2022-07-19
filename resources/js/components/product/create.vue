<template>

    <div class="card card-frame">

        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <div class="row">
                    <div class="col-6">
                        <h6 class="text-white text-capitalize ps-3">Add Product</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form @submit.prevent="submitProduct">
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

                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <div class="input-group input-group-outline my">
                                <input type="file" class="form-control"  @change="onFileSelected">
                            </div>
                            <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
                          <div class="col-md-6 mt-2">
                            <img
                              :src="form.image"
                              alt=""
                              style="height: 150px; width: 150px"
                            />
                          </div>
                          <small class="text-danger">Ukuran : 150 x 150</small>
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
                produck_name: null,
                produck_code: null,
                category_id: null,
                price : null,
                qty : null,
                image: null
            },
            errors:{},
            category:{},
        }
    },
    methods: {
        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.image_validation();
            } else {
                let reader = new FileReader();
                reader.onload = (event) => {
                this.form.image = event.target.result;
                console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            }
        },
        submitProduct(){
            axios.post("/api/product", this.form)
            .then(() => {
                this.$router.push({ name: 'product' })
                Notification.success();
            })
            .catch((error) => (this.errors = error.response.data.errors));
        },
    },
    created(){
        axios.get("/api/category/").then(({ data }) => (this.category = data));
    }

}
</script>
