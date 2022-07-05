<template>

    <div class="card card-frame">

        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <div class="row">
                    <div class="col-6">
                        <h6 class="text-white text-capitalize ps-3">Edit Category</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form @submit.prevent="categoryUpdate">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Category Name</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" v-model="form.category_name">
                            <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
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
                category_name: "",
            },
            errors:{},
        }
    },
     created(){
        let id = this.$route.params.id;

        axios.get("/api/category/" + id).then(({ data }) => (this.form = data)).catch(console.log("Data Eror"));
    },
    methods: {
        categoryUpdate(){
             let id = this.$route.params.id;
             axios
                .patch("/api/category/" + id, this.form)
                .then(() => {
                this.$router.push({ name: "category" });
                Notification.success();
                })
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },

}
</script>
