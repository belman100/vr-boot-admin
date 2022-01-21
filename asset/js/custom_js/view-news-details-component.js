const viewNewsDetialsComponent = {
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
        //date format local
        formatDateThai(date) {
            var monthNames = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
            var date = new Date(date);
            var day = date.getDate();
            var monthIndex = date.getMonth();
            var year = date.getFullYear() + 543;
            return day + ' ' + monthNames[monthIndex] + ' ' + year + ' เวลา ' + date.getHours() + ':' + date.getMinutes();
        },
    }
};
Vue.createApp(viewNewsDetialsComponent).mount('#news-details-component');