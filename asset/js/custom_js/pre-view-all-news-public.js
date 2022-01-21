const previewNewsPublic = {
    data() {
        return {
            news: [],
            image_preview: '',
        }
    },
    mounted() {
        let attr_type_id = window.location.pathname.split('/');
        this.getnewsPublic(attr_type_id[3]);
    },
    methods: {
        getnewsPublic(id) {
            axios.get('../get-preview-news-public/' + id)
                .then(response => {
                    //console.log(response.data);
                    //check if response is success
                    if (response.data.status == 200) {
                        this.news = response.data.news;
                    } else {
                        this.news = [];
                        Swal.fire({
                            type: 'error',
                            icon: 'error',
                            title: 'Oops...',
                            text: 'ขอภัยไม่พบข้อมูลข่าวสารที่ต้องการ!',
                        })
                    }
                })
                .catch(error => {
                    //swal
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: 'Oops...',
                        text: error,
                        footer: '<a href>Why do I have this issue?</a>'
                    })
                });
        },
    }


}
Vue.createApp(previewNewsPublic).mount('#news-show-all');