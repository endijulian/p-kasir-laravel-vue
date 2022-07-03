<template>
</template>

<script>
export default {
    created(){
        localStorage.removeItem('token')
        localStorage.removeItem('user')

        Toast.fire({
            icon: 'success',
            title: 'Logout Success'
        })

        this.$router.push({name: '/'})
    }
}
</script>
