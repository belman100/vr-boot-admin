const Counter = {
    data() {
        return {
            username: '',
            password: '',
        }
    },
    methods: {
        login() {
            if (this.username == '' || this.password == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'ผิดพลาด',
                    text: 'กรุณาใส่ชื่อผู้ใช้และรหัสผ่าน !',
                    footer: ''
                })
            } else {
                Swal.showLoading();
                var params = new URLSearchParams();
                params.append('username', this.username);
                params.append('password', this.password);
                axios.post('../admin/login-post', params)
                    .then(response => {
                        console.log(response);
                        if (response.data.status == 200) {
                            //swal success
                            Swal.close();
                            //redirect to dashboard
                            //data to json
                            var data = JSON.stringify(response.data.user_data);
                            //set data to local storage
                            localStorage.setItem('admin_data', data);
                            window.location.href = '../admin/dashboard';
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ผิดพลาด',
                                text: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง !',
                                footer: ''
                            })
                        }
                    }).catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'ผิดพลาด',
                            text: error,
                            footer: ''
                        })
                    })
            }
        }
    }
}
Vue.createApp(Counter).mount('#login-component')