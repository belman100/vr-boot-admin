const navComponent = {
    data() {
        return {
            is_login: false,
            admin_data: {},
        }
    },
    mounted() {
        this.getAdminInfo()
    },
    methods: {
        getAdminInfo() {
            //get admin info from local storage
            var data = localStorage.getItem('admin_data');
            //console.log(data);
            if (data != null) {
                this.admin_data = JSON.parse(data);
                //console.log(this.admin_data);
                this.is_login = true;
            } else {
                this.is_login = false;
            }
        },
        goToMainPage() {
            window.location.href = '../admin/dashboard';
        },
        logout() {
            axios.get('../admin/logout')
                .then(res => {
                    //remove cookie
                    document.cookie = "admin_data=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    location.href = '../admin/login';
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'ผิดพลาด',
                        text: err,
                        footer: ''
                    })
                })
        }
    },

}

Vue.createApp(navComponent).mount('#nav-component')