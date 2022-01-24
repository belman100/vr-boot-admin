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
            vr_view: 0,
        }
    },
    mounted() {
        this.attractionAndHotspot();
        this.getListAttractionCount();
        this.getVrTypeView();
        //this.getListNews();
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
                //console.log(response);
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
        getVrTypeView() {
            let url = '../admin/get-type-vr-count/' + this.type_id;
            axios.get(url).then(response => {
                console.log(response);
                if (response.data.status == 200) {
                    this.vr_view = response.data.type_view;
                    //console.log(this.attraction_view[0].attr_name);
                } else {
                    this.vr_view = 0;
                }
            }).catch(error => {
                console.log(error);
            });
        },
    }
}

Vue.createApp(dasbord).mount('#dasbord-component');