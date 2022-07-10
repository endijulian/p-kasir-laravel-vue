<template>

    <div class="card card-frame">

        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <div class="row">
                    <div class="col-6">
                        <h6 class="text-white text-capitalize ps-3">Add Barang Keluar</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form @submit.prevent="submitBarangKeluar">
                <div class="row">
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Barang</label>
                            <div class="input-group input-group-outline ">
                                <select class="form-control mb-3" id="exampleFormControlSelect1" v-model="form.stock_in_produck_id">
                                    <option v-for="cat in barangMasuk" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                                </select>
                            </div>
                            <small class="text-danger" v-if="errors.stock_in_produck_id">{{ errors.stock_in_produck_id[0] }}</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Qty</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="text" class="form-control" v-model="form.qty">
                                    </div>
                                    <small class="text-danger" v-if="errors.qty">{{ errors.qty[0] }}</small>
                                </div>
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
                stock_in_produck_id: null,
                qty : null
            },
            errors:{},
            barangMasuk:{},
        }
    },
    methods: {
        submitBarangKeluar(){
            axios.post("/api/barangKeluar", this.form)
            .then((response) => {
                console.log(response.data)

                if (response.data.success) {
                    this.$router.push({ name: 'barangKeluar' })
                    Notification.success();
                } else {
                    Notification.StockNull();
                }
            })
            .catch((error) => (this.errors = error.response.data.errors));
        },
    },
    created(){
        axios.get("/api/barangMasuk/").then(({ data }) => (this.barangMasuk = data));
    }

}
</script>
