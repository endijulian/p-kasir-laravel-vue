<template>
    <div>

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body pb-2">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-capitalize ps-3">Data User / Pengguna</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <router-link to="/storeuser" class="btn btn-info me-2">Add User</router-link>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(user, index) in users" :key="index.id">

                                    <td>
                                        <h6 class="mb-0 text-sm">{{ ++index }}</h6>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ user.name }}</h6>
                                        </div>
                                    </td>

                                    <td>
                                        <h6 class="mb-0 text-sm">{{ user.email }}</h6>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span v-if="user.roles_id == 1" class="badge badge-sm bg-gradient-success">{{ user.roles.name }}</span>
                                        <span v-else class="badge badge-sm bg-gradient-warning">{{ user.roles.name }}</span>
                                    </td>

                                    <td class="align-middle">
                                        <router-link
                                        :to="{name: 'edituser',
                                        params: {id: user.id},
                                        }"
                                        class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                        Edit
                                        </router-link>
                                        |
                                        <a href="#"
                                        @click="deleteUser(user.id)"
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
            users: [],
            loading: false,
        };
    },
    methods:{
        allUsers(){
             this.$isLoading(true)
            axios
            .get("/api/users/")
            .then(({data}) => {
                this.users = data;
                this.$isLoading(false)
            })
            .catch();
        },
        deleteUser(id) {
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
                    .delete("/api/users/" + id)
                    .then(() => {
                        this.users = this.users.filter((users) => {
                            return users.id != id;
                        });
                    })
                    .catch(() => {
                        this.$router.push({ name: "users" });
                    });
                Swal.fire("Deleted!", "Your file has been deleted.", "success");
                }
            });
        },
    },
    created(){
        this.allUsers();
    }
}
</script>


