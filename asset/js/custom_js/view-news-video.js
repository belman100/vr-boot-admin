const viewNewsVieoComponent = {
    data() {
        return {
            news: {},
        }
    },
    mounted() {
        let newsId = window.location.pathname.split('/');
        this.getNewsDetails(newsId[3]);
    },
    methods: {
        getNewsDetails(newsId) {
            console.log(newsId);
            axios.get(`../get-select-news/${newsId}`)
                .then(response => {
                    console.log(response.data);
                    //check if response is success
                    if (response.data.status == 200) {
                        this.news = response.data.news;
                    } else {
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
        //date format 
    }
};
Vue.createApp(viewNewsVieoComponent).mount('#news-video-component');