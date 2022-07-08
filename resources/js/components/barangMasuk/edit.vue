<template>

    <div class="card card-frame">

        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <div class="row">
                    <div class="col-6">
                        <h6 class="text-white text-capitalize ps-3">Edit Barang Masuk</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form @submit.prevent="barangMasukUpdate">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" v-model="form.name">
                            <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Qty</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" v-model="form.qty">
                            <small class="text-danger" v-if="errors.qty">{{ errors.qty[0] }}</small>
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
                name: "",
                qty: "",
            },
            errors:{},
        }
    },
     created(){
        let id = this.$route.params.id;

        axios.get("/api/barangMasuk/" + id).then(({ data }) => (this.form = data)).catch(console.log("Data Eror"));
    },
    methods: {
        barangMasukUpdate(){
             let id = this.$route.params.id;
             axios
                .patch("/api/barangMasuk/" + id, this.form)
                .then(() => {
                this.$router.push({ name: "barangMasuk" });
                Notification.success();
                })
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },

}
</script>
