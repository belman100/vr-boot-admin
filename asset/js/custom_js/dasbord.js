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
        }
    },
    mounted() {
        this.attractionAndHotspot();
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
    },
}

Vue.createApp(dasbord).mount('#dasbord-component');