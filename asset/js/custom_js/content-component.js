const listComponent = {
    //props: ['attraction'],
    data() {
        return {
            attraction: [],
            attraction_type_id: '61d85ed74a41313a64469803',
            pre_tag: 0,
            attraction_point_img: [],
            news: [],
            server_date_thime: '',
        }
    },
    mounted() {
        this.getAttraction();
        this.getListNews();
        //console.log(this.attraction_type_id);
    },
    methods: {
        getAttraction() {
            //loading swal
            Swal.showLoading();
            axios.get('../admin/get-all-attraction-by-type/' + this.attraction_type_id)
                .then(response => {
                    //console.log(response);
                    if (response.data.status == 200) {
                        this.attraction = response.data.attr;
                        //wait for swal close
                        //console.log(this.server_date_thime);
                        Swal.close();
                    } else {
                        this.attraction = [];
                        Swal.fire({
                            icon: 'error',
                            title: 'ผิดพลาด',
                            text: 'ไม่พบข้อมูล !',
                            footer: ''
                        })
                    }
                })

        },
        checkActiveByDateTime(date_time_start, date_time_end) {
            //console.log(date_time_start);
            //console.log(date_time_end);
            //console.log(this.server_date_thime);
            //if (date_time_start == '' && date_time_end == '') {
            var date_now = new Date(this.server_date_thime);
            var date_start = new Date(date_time_start);
            var date_end = new Date(date_time_end);
            if (date_now >= date_start && date_now <= date_end) {
                //console.log('active');
                return true;
            } else {
                //console.log('inactive');
                return false;
            }
            //}
        },

        editPointAttr(point_id) {
            //redirect to edit point    
            localStorage.setItem('point-edit', point_id);
            window.location.href = "../admin/edit-point-vr/";
        },
        deletePointAttr(attr_index, point_index) {
            //delete point
            Swal.fire({
                icon: 'warning',
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณต้องการลบ hotspot " + this.attraction[attr_index].attraction_point[point_index].point_name + " หรือไม่?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ต้องการลบ!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.value) {
                    //delete point
                    axios.get('../admin/delete-point-vr/' + this.attraction[attr_index].attraction_point[point_index]._id.$oid)
                        .then(response => {
                            console.log(response);
                            if (response.data.status == 200) {
                                Swal.fire(
                                    'ทำการลง!',
                                    'ข้อมูลที่คุณต้องการลงได้ทำการลบเสร็จสมบูรณ์แล้ว',
                                    'สมบูรณ์'
                                ).then(() => {
                                    //reflesh page
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ผิดพลาด',
                                    text: 'ลบจุดท่องเที่ยวไม่สำเร็จ !',
                                });
                            }
                        })
                        .catch(function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'ผิดพลาด',
                                text: error,
                            });
                        });
                }
            })

        },
        getTypeAttraction(tag) {
            if (tag == 0) {
                this.attraction_type_id = "61d85e8f4a41313a64469802";
                if (this.pre_tag == 1) {
                    this.getAttraction();
                    this.pre_tag = 0;
                }

            } else {
                this.attraction_type_id = "61d85ed74a41313a64469803";
                if (this.pre_tag == 0) {
                    this.getAttraction();
                    this.pre_tag = 1;
                }
            }
            //console.log(this.attraction_type_id);
        },
        gotoAddPointAttr(attr) {
            //attr to json
            var attr_json = JSON.stringify(attr);
            //add attr to local storage
            localStorage.setItem('attr-point', attr_json);
            //redirect to add point
            window.location.href = "../admin/add-point-vr";
        },
        gotoViewPage(attr) {

            //redirect to add point
            window.open("../preview/" + attr);
        },
        //get list news
        getListNews() {
            let url = '../admin/get-all-news/' + this.attraction_type_id;
            axios.get(url).then(response => {
                console.log(response);
                if (response.data.status == 200) {
                    this.news = response.data.news;
                    this.server_date_thime = response.data.server_date;
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
        gotoNewsVideoPage(news_id) {
            //new tap
            window.open('../preview-news-video/' + news_id, '_blank');
        },
        editNews(news_id) {
            //news_id to localStorage
            localStorage.setItem('news_id', news_id);
            window.location.href = '../admin/edit-news/';
        },
        //preview date to string local format 05/05/2561
        previewDate(date) {
            var date_split = date.split('-');
            var date_string = date_split[2] + '/' + date_split[1] + '/' + date_split[0];
            return date_string;
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
                            //swal time out
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบข้อมูลสำเร็จ',
                                text: 'ข้อมูลของคุณถูกลบแล้ว',
                                footer: '',
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector('b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                },
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    window.location.reload();
                                }
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
    },
};

Vue.createApp(listComponent).mount('#content-component');