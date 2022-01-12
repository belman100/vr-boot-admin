const addAttr = {
    //props: ['attraction', 'attraction_type_id'],
    data() {
        return {
            attraction: dasbord.data().attraction,
            attraction_type_id: listComponent.data().attraction_type_id,
            att_name_form: "",
            error_msg: "",
        }
    },
    methods: {
        addAttraction() {
            //check attr name is not empty
            if (this.att_name_form == "") {
                this.error_msg = "กรุณากรอกชื่อสถานที่ท่องเที่ยว !";
            } else {
                this.error_msg = "";
                //check attr name is not duplicate
                axios.get('../admin/check-attr-name/' + this.att_name_form)
                    .then(response => {
                        console.log(response);
                        if (response.data.status == 200) {
                            //add data to param
                            var params = new URLSearchParams();
                            params.append('type_id', this.attraction_type_id);
                            params.append('attr_name', this.att_name_form);
                            //add attr name
                            axios.post('../admin/add-attraction-post', params)
                                .then(response => {
                                    console.log(response);
                                    if (response.data.status == 200) {
                                        //refresh page
                                        window.location.reload();
                                    } else {
                                        this.error_msg = "ไม่สามารถเพิ่มสถานที่ท่องเที่ยวได้ กรุณาลองใหม่อีกครั้ง";
                                    }
                                })
                                .catch(error => {
                                    this.error_msg = error;
                                })
                        } else {
                            this.error_msg = "ชื่อสถานที่ท่องเที่ยวนี้มีอยู่แล้ว กรุณากรอกชื่อสถานที่ท่องเที่ยวใหม่ !";
                        }
                    })
                    .catch(error => {
                        this.error_msg = error;
                    })
            }
        },
    }
};
Vue.createApp(addAttr).mount('#add-attration-component');