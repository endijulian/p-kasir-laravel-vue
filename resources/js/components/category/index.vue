<template>
    <div>

        <div class="row">

           <div class="col-12">
             <div class="card">
                <div class="card-body pb-2">
                    <div class="row">
                        <div class="col-6">
                            <h6 class=" text-capitalize ps-3">Category</h6>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                             <div class="input-group input-group-outline p-2" style="width: 400px;">
                                <input type="text" class="form-control" v-model="searchCategory" placeholder="Search category name..... ">
                            </div>
                            <router-link to="/storeCategory" class="btn btn-info mt-2 me-2">Add Category</router-link>
                        </div>
                    </div>
                </div>
            </div>
           </div>

            <div class="col-12">
                <div class="card my-4">

                    <div class="card-body pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name Category</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(categori, index) in filterSearch" :key="index.id">
                                     <td>
                                        <h6 class="mb-0 text-sm">{{ ++index }}</h6>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ categori.category_name }}</h6>
                                        </div>
                                    </td>

                                    <td class="align-middle">
                                        <router-link
                                        :to="{name: 'editCategory',
                                        params: {id: categori.id},
                                        }"
                                        class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Category">
                                        Edit
                                        </router-link>

                                        |

                                        <a href="#"
                                        @click="deleteCategory(categori.id)"
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
            category: [],
            searchCategory: "",
            loading: false,
        };
    },
    methods:{
        allCategory(){
             this.$isLoading(true)
            axios
            .get("/api/category/")
            .then(({data}) => {
                this.category = data;
                this.$isLoading(false)
            })
            .catch();
        },
        deleteCategory(id) {
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
                    .delete("/api/category/" + id)
                    .then(() => {
                        this.category = this.category.filter((category) => {
                            return category.id != id;
                        });
                    })
                    .catch(() => {
                        this.$router.push({ name: "category" });
                    });
                Swal.fire("Deleted!", "Your file has been deleted.", "success");
                }
            });
        },
    },
    computed: {
        filterSearch(){
            return this.category.filter((categori) => {
                return categori.category_name.toLowerCase().match(this.searchCategory.toLowerCase());
            })
        }
    },
    created(){
        this.allCategory();
    }
}
</script>


