const dasbord = {
    data() {
        return {
            attractionCount: 0,
            hotspotCount: 0,
            type_id: '61d85ed74a41313a64469803',
            attraction: [{
                _id: "",
                type_id: "",
                attr_name: 'สถานที่ท่องเที่ยวที่น่าสนใจ',
                created_at: "",
                updated_at: "",
                attraction_point: [{
                    _id: "",
                    attr_name: "",
                    attr_id: "",
                    point_number: 0,
                    point_name: "",
                    details: "",
                    audio_file_name: "",
                    image_file_name: "",
                    created_at: "",
                    updated_at: "",
                    status: true,
                    user_id: ""
                }],
            }],
            att_name_form: "",
            attraction_view: [],
            news: []
        }
    },
    mounted() {
        this.attractionAndHotspot();
        this.getListAttractionCount();
        this.getListNews();
    },
    methods: {
        attractionAndHotspot() {
            Swal.showLoading()
            axios.get('../admin/get-count-attraction-and-point-by-type/' + this.type_id)
                .then(response => {
                    //console.log(response);
                    if (response.data.status == 200) {
                        //swal success
                        //Swal.close();
                        this.attractionCount = response.data.attr_count;
                        this.hotspotCount = response.data.attr_point;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ผิดพลาด',
                            text: 'ไม่พบข้อมูล !',
                            footer: ''
                        })
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'ผิดพลาด',
                        text: error,
                        footer: ''
                    })
                })
        },
        getListAttractionCount() {
            let url = '../admin/get-attraction-view-all/' + this.type_id;
            axios.get(url).then(response => {
                console.log(response);
                if (response.data.status == 200) {
                    this.attraction_view = response.data.attr_view;
                    //console.log(this.attraction_view[0].attr_name);
                } else {
                    this.attraction_view = [];
                }
            }).catch(error => {
                console.log(error);
            });
        },
        //get list news
        getListNews() {
            let url = '../admin/get-all-news/' + this.type_id;
            axios.get(url).then(response => {
                console.log(response);
                if (response.data.status == 200) {
                    this.news = response.data.news;
                } else {
                    this.news = [];
                }
            }).catch(error => {
                console.log(error);
            });
        },
        gotoNewsViewPage(news_id) {
            //new tap
            window.open('../preview-news-details/' + news_id, '_blank');
        },
        editNews(news_id) {
            //news_id to localStorage
            localStorage.setItem('news_id', news_id);
            window.location.href = '../admin/edit-news/';
        },
        deleteNews(news_id) {
            Swal.fire({
                title: 'คุณต้องการลบข้อมูลนี้หรือไม่ ?',
                text: "ข้อมูลที่ลบไม่สามารถกู้คืนได้",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ลบข้อมูล',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.value) {
                    let url = '../admin/delete-news/' + news_id;
                    axios.get(url).then(response => {
                        //console.log(response);
                        if (response.data.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลสำเร็จ',
                                text: 'ข้อมูลของคุณถูกลบแล้ว',
                                footer: ''
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ผิดพลาด',
                                text: 'ไม่สามารถลบข้อมูลได้',
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
            })
        },
    }
}

Vue.createApp(dasbord).mount('#dasbord-component');