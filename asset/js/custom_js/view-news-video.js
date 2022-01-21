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
            //swal loading
            Swal.showLoading();
            //console.log(newsId);
            axios.get(`../get-preview-video/${newsId}`)
                .then(response => {
                    console.log(response.data);
                    Swal.close();
                    //check if response is success
                    if (response.data.status == 200) {
                        this.news = response.data.video;
                        //check video url is empty
                        if (this.news.video_url == '') {
                            //swal notif
                            Swal.fire({
                                icon: 'error',
                                title: 'ผิดพลาด',
                                text: 'ไม่พบข้อมูลวีดีโอ !',
                                footer: ''
                            })

                        }

                    } else {
                        Swal.fire({
                            type: 'error',
                            icon: 'error',
                            title: 'ผิดพลาด',
                            text: 'ขอภัยไม่พบข้อมูลข่าวสารที่ต้องการ!',
                        })
                    }
                })
                .catch(error => {
                    //swal
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: 'ผิดพลาด',
                        text: error,
                        footer: ''
                    })
                });
        },
        //date format 
    }
};
Vue.createApp(viewNewsVieoComponent).mount('#news-video-component');