//audio file
var audio_file;
var audio_file_name = '';
var audio_file_type = '';
var audio_file_base64 = '';
//image file name
var image_file;
var image_file_name = '';
var image_file_type = '';

const updatePointAttr = {
    data() {
        return {
            point_id: "",
            attr_point: {
                _id: {},
                attr_name: "",
                attr_id: {},
                point_number: 0,
                point_name: "",
                details: "",
                audio_file_name: "",
                image_file_name: "",
                created_at: "",
                updated_at: "",
                status: true,
                user_id: ""
            },
            file_audio_Select_show: "** กรณีอัพเตดเสียงคำบรรยาย รองรับ mp3 เท่านั้น **",

        }
    },
    mounted() {
        this.getHotspot();
    },
    methods: {
        //get point id from localstorage
        getPointId() {
            this.point_id = localStorage.getItem('point-edit');
        },
        getHotspot() {
            Swal.showLoading()
            this.getPointId();
            axios.get('../admin/get-select-point-vr-by-id/' + this.point_id)
                .then(response => {
                    console.log(response);
                    if (response.data.status == 200) {
                        //swal success
                        Swal.close();
                        this.attr_point = response.data.data;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ผิดพลาด',
                            text: 'ไม่พบข้อมูล !',
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
        },
        getAudioFile() {
            //event on change input file
            var input = document.getElementById('audio-file-input');
            input.addEventListener('change', function() {
                Swal.showLoading();
                //check file is exist
                if (input.files.length > 0) {
                    //console.log('get audio file');
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        //add file to hostpot
                        //check file type
                        var file_type = input.files[0].type;
                        console.log(file_type);
                        if (file_type == 'audio/mp3' || file_type == 'audio/mpeg') {
                            var fileBase64 = e.target.result;
                            audio_file_base64 = fileBase64;
                            audio_file_name = input.files[0].name;
                            audio_file_type = input.files[0].type;
                            audio_file = input.files[0];
                            this.file_audio_Select_show = input.files[0].name;
                            console.log(this.file_audio_Select_show);
                            //close swal
                            Swal.close();
                        } else {
                            //swal('Error', 'File type is not valid', 'error');
                            Swal.fire({
                                icon: 'error',
                                type: 'error',
                                title: 'ผิดพลาด',
                                text: 'ชนิดไฟล์ไม่ถูกต้อง กรุณาเลือกไฟล์เสียงเป็น .mp3 เท่านั้น !',
                            });
                            return;
                        }
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    Swal.fire({
                        icon: 'error',
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please choose file audio',
                    });
                }
            });
        },
        getImgFile() {
            //event on change input file img
            var input = document.getElementById('img-file-input');
            input.addEventListener('change', function() {
                //show loading
                Swal.showLoading();
                //check file is exist
                if (input.files.length > 0) {
                    //convert file to base64
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        //check file type
                        var file_type = input.files[0].type;
                        if (file_type == 'image/jpeg' || file_type == 'image/jpg' || file_type == 'image/png') {
                            //add file to hostpot
                            var fileBase64 = e.target.result;
                            //var files_type = e.target.files
                            //console.log(fileBase64);
                            //image_file_base64 = fileBase64;
                            image_file_name = input.files[0].name;
                            image_file_type = input.files[0].type;
                            image_file = input.files[0];
                            //console.log(image_file);
                            //preview image to div
                            var img = document.getElementById('image-preview');
                            img.src = fileBase64;
                            //console.log(this.image_file_name);
                            //close swal
                            Swal.close();
                        } else {
                            input = null;
                            //swal('Error', 'File type is not valid', 'error');
                            Swal.fire({
                                icon: 'error',
                                type: 'error',
                                title: 'ผิดพลาด',
                                text: 'ชนิดไฟล์ไม่ถูกต้อง กรุณาเลือกรูปภาพเป็น .jpeg/jpg หรือ .png เท่านั้น !',
                            });
                            return;
                        }
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    //swal('Error', 'File is not exist', 'error');
                    Swal.fire({
                        icon: 'error',
                        type: 'error',
                        title: 'ผิดพลาด',
                        text: 'ไม่พบไฟล์รูปภาพ !',
                    });
                    return;
                }

            });
        },
        checkData() {
            var message = "";
            var is_valid = true;
            //check data
            if (this.attr_point.point_name == '') {
                is_valid = false;
                message = "กรุณากรอกชื่อจุดท่องเที่ยว\n";
            }
            if (this.attr_point.details == '') {
                is_valid = false;
                message += "กรุณากรอกรายละเอียด";
            }
            if (!is_valid) {
                Swal.fire({
                    icon: 'error',
                    title: 'ผิดพลาด',
                    text: message,
                });
            }
            //check file audio is not null
            if (audio_file == null) {
                audio_file_name = this.attr_point.audio_file_name;
            }
            //check file img is not null
            if (image_file == null) {
                image_file_name = this.attr_point.image_file_name;
            }

            return is_valid;
        },
        updateData() {
            //swal loading
            Swal.showLoading();
            //check data
            if (this.checkData()) {
                const hostpot = new FormData();
                hostpot.append('_id', this.attr_point._id.$oid);
                hostpot.append('attr_id', this.attr_point.attr_id.$oid);
                hostpot.append('attr_name', this.attr_point.attr_name);
                hostpot.append('point_name', this.attr_point.point_name);
                hostpot.append('details', this.attr_point.details);
                //hostpot.append('audio_file', audio_file);
                hostpot.append('audio_file_base64', audio_file_base64);
                hostpot.append('audio_file_pre_name', this.attr_point.audio_file_name);
                hostpot.append('audio_file_name', audio_file_name);
                hostpot.append('audio_file_type', audio_file_type);
                hostpot.append('image_file', image_file);
                hostpot.append('image_file_pre_name', this.attr_point.image_file_name);
                hostpot.append('image_file_name', image_file_name);
                hostpot.append('image_file_type', image_file_type);
                //upload data
                console.log(hostpot.get("audio_file"));

                axios.post('../admin/edit-point-vr-post', hostpot, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(response => {
                        //check status
                        console.log(response.data);
                        if (response.data.status == 200) {
                            //close swal
                            Swal.close();
                            //show success
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                timer: 2000,
                                timerProgressBar: true,
                                text: 'อัพเดทข้อมูลสำเร็จ',
                            });
                            //redirect to list
                            setTimeout(() => {
                                window.location.href = '../admin/dashboard';
                            }, 2000);
                        } else {
                            //close swal
                            Swal.close();
                            //show error
                            Swal.fire({
                                icon: 'error',
                                title: 'ผิดพลาด',
                                text: 'อัพเดทข้อมูลไม่สำเร็จ',
                            });
                        }
                    }).catch(error => {
                        //console.log(error);
                        //close swal
                        Swal.close();
                        //show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'ผิดพลาด',
                            text: error,
                        });
                    });
            }
        },
    }
}
Vue.createApp(updatePointAttr).mount('#update-point-attr-component');