<template>

    <div class="card card-frame">

        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <div class="row">
                    <div class="col-6">
                        <h6 class="text-white text-capitalize ps-3">Edit User</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form @submit.prevent="userUpdate">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" v-model="form.name">
                            <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="password" class="form-control" v-model="form.password">
                            <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <div class="input-group input-group-outline mb-3">
                            <input type="email" class="form-control" v-model="form.email">
                            <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <div class="input-group input-group-outline mb-4">
                            <select class="form-control" id="exampleFormControlSelect1" v-model="form.roles_id">
                                <option v-for="role in roles" :key="role.id" :value="role.id" class="mb-5">{{ role.name }}</option>
                            </select>
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
                email: "",
                password: "",
                roles_id : ""
            },
            errors:{},
            roles:{},
        }
    },
     created(){
        let id = this.$route.params.id;

        axios.get("/api/users/" + id).then(({ data }) => (this.form = data)).catch(console.log("Data Eror"));

        axios.get("/api/roles/").then(({ data }) => (this.roles = data));
    },
    methods: {
        userUpdate(){
             let id = this.$route.params.id;
             axios
                .patch("/api/users/" + id, this.form)
                .then(() => {
                this.$router.push({ name: "user" });
                Notification.success();
                })
                .catch((error) => (this.errors = error.response.data.errors));
        },
    },

}
</script>
