//audio file
var audio_file;
var audio_file_name = '';
var audio_file_type = '';
var audio_file_base64 = '';
//image file name
var image_file;
var image_file_name = '';
var image_file_type = '';

const addPoinrAttr = {
    //props: ['attraction', 'attraction_type_id'],
    data() {
        return {
            attraction: {},
            hostpot: {
                attr_name: "",
                attr_id: "",
                point_number: 0,
                point_name: '',
                details: '',
            },
            audio: '',
            image: ''

        }
    },
    mounted() {
        this.getAttraction();
    },
    methods: {
        getAttraction() {
            //get attraction frmo local storage
            var attr_json = localStorage.getItem('attr-point');
            //attr to json
            this.attraction = JSON.parse(attr_json);
            //console.log(this.attraction);
            //add attraction to hostpot
            this.hostpot.attr_name = this.attraction.attr_name;
            this.hostpot.attr_id = this.attraction._id.$oid;
            console.log(this.hostpot.attr_id);
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
                        if (file_type == 'audio/mp3' || file_type == 'audio/mpeg') {
                            var fileBase64 = e.target.result;
                            audio_file_base64 = fileBase64;
                            audio_file_name = input.files[0].name;
                            audio_file_type = input.files[0].type;
                            audio_file = input.files[0];
                            //console.log(this.audio);
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
            if (this.hostpot.point_name == '') {
                is_valid = false;
                message = "กรุณากรอกชื่อจุดท่องเที่ยว\n";
            }
            if (this.hostpot.details == '') {
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
            return is_valid;
        },
        addHostpotToApi() {
            if (this.checkData()) {
                //console.log(image_file);
                //if data is valid
                //show loading
                Swal.showLoading();
                //add hostpot to form post data
                //const hostpot = new URLSearchParams();
                const hostpot = new FormData();
                hostpot.append('attr_id', this.hostpot.attr_id);
                hostpot.append('attr_name', this.hostpot.attr_name);
                hostpot.append('point_name', this.hostpot.point_name);
                hostpot.append('details', this.hostpot.details);
                //hostpot.append('audio_file', audio_file);
                hostpot.append('audio_file_base64', audio_file_base64);
                hostpot.append('audio_file_name', audio_file_name);
                hostpot.append('audio_file_type', audio_file_type);
                hostpot.append('image_file', image_file);
                hostpot.append('image_file_name', image_file_name);
                hostpot.append('image_file_type', image_file_type);
                //send data to api
                //console.log(hostpot.get('image_file'));
                axios.post('../admin/add-point-vr-post', hostpot, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(function(response) {
                        console.log(response);
                        if (response.data.status == 200) {
                            //close modal
                            //$('#add-hostpot-modal').modal('hide');
                            //swal('Success', 'Add hostpot success', 'success');
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
                            //show error message
                            Swal.fire({
                                icon: 'error',
                                title: 'ผิดพลาด',
                                text: 'เพิ่มจุดท่องเที่ยวไม่สำเร็จ !',
                            });
                        }
                    }.bind(this))
                    .catch(function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'ผิดพลาด',
                            text: error,
                        });
                    });
            }
        },
    }
};

Vue.createApp(addPoinrAttr).mount("#add-point-attr-component");