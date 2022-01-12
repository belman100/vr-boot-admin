const listComponent = {
    //props: ['attraction'],
    data() {
        return {
            attraction: [],
            attraction_type_id: '61d85ed74a41313a64469803',
            pre_tag: 0,
            attraction_point_img: [],
        }
    },
    mounted() {
        this.getAttraction();
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
        }
    },
};

Vue.createApp(listComponent).mount('#content-component');