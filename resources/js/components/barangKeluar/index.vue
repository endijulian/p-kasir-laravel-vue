<template>
    <div>

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="text-white text-capitalize ps-3">Data Barang Keluar</h6>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <router-link to="/storeBarangKeluar" class="btn btn-info me-2">Add Barang Keluar</router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Qty</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(out, index) in barangKeluar" :key="index.id">

                                    <td>
                                        <h6 class="mb-0 text-sm">{{ ++index }}</h6>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ out.nameInBarang }}</h6>
                                        </div>
                                    </td>

                                    <td>
                                        <h6 class="mb-0 text-sm">{{ out.qty }}</h6>
                                    </td>

                                    <td>
                                        <h6 class="mb-0 text-sm">{{ format_date(out.created_at) }}</h6>
                                    </td>

                                    <td class="align-middle">
                                        <router-link
                                        :to="{name: 'editBarangKeluar',
                                        params: {id: out.id},
                                        }"
                                        class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                        Edit
                                        </router-link>
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

import moment from 'moment'

export default {
    created(){
        if(!User.loggedIn()){
            this.$router.push({name: '/'});
        }
    },
    data(){
        return{
            barangKeluar: [],
            loading: false,
        };
    },
    methods:{
        allBarangKeluar(){
             this.$isLoading(true)
            axios
            .get("/api/barangKeluar/")
            .then(({data}) => {
                this.barangKeluar = data;
                this.$isLoading(false)
            })
            .catch();
        },
        format_date(value){
         if (value) {
           return moment(String(value)).format('DD MM YYYY')
          }
      },
    },
    created(){
        this.allBarangKeluar();
    }
}
</script>


