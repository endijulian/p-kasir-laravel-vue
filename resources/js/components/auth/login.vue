<template>
        <div class="container my-auto">
            <div class="row" style="margin-right:250px; margin-top: 70px;">
                <div class="col-lg-6 col-md-8 col-12 mx-auto mt-4">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n6 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">POINT OF SALE</h4><br>
                                <h6 class="text-white font-weight-bolder text-center mt-2 mb-0">APLIKASI KASIR <br> Enigma Kopi</h6>
                            </div>
                        </div>
                        <div class="card-body align-items-start">
                            <form role="form" class="text-start" @submit.prevent="login">
                                <div class="input-group input-group-outline my-3">
                                    <input type="email" class="form-control" v-model="form.email" placeholder="Email...">
                                </div>
                                <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>

                                <div class="input-group input-group-outline mb-3">
                                    <input type="password" class="form-control" v-model="form.password" placeholder="Password....">
                                </div>
                                <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>

                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    created(){
        if(User.loggedIn()){
            this.$router.push({name : 'home'});
        }
    },
    data(){
        return{
            errors: {},
            form:{
                email: null,
                password: null,
            }
        }
    },
    methods:{
        login(){
            axios.post('/api/auth/login', this.form)
            .then(
                res => {
                    User.responseAfterLogin(res)
                    Toast.fire({
                        icon: 'success',
                        title: 'Signed in successfully'
                    })
                    this.$router.push({name : 'home'})
                }
            )
            .catch(error => this.errors = error.response.data.errors)
            .catch(
                Toast.fire({
                    icon: 'warning',
                    title: 'Invalid Email or Password !!'
                })
            )
        }
    }
}
</script>
