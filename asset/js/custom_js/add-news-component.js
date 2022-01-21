//image file
var image_file;
var image_file_name = '';
var image_file_type = '';
//vue create
const addNewsComponent = {
    data() {
        return {
            attr_id: '61d85ed74a41313a64469803',
            news: {
                name: '',
                description: '',
                date_time_start: '',
                date_time_end: '',
                video_url: '',
            }

        }
    },
    methods: {
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
            //check validate data
            if (this.news.name == '') {
                message += "กรุณากรอกชื่อข่าว !\n";
                is_valid = false;
            }
            if (this.news.description == '') {
                message += "กรุณากรอกรายละเอียดข่าว !\n";
                is_valid = false;
            }
            if (this.news.date_time_start == '') {
                message += "กรุณากรอกวันที่เริ่มข่าว !\n";
                is_valid = false;
            }
            if (this.news.date_time_end == '') {
                message += "กรุณากรอกวันที่สิ้นสุดข่าว !\n";
                is_valid = false;
            }
            //check start date is greater than end date
            if (this.news.date_time_start > this.news.date_time_end) {
                message += "วันที่เริ่มข่าว ต้องน้อยกว่าวันที่สิ้นสุดข่าว !\n";
                is_valid = false;
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
        //get video youtube url and get video id
        getYoutubeUrl(url) {
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            var match = url.match(regExp);
            if (match && match[2].length == 11) {
                return match[2];
            } else {
                return '';
            }
        },
        //add news
        addNews() {
            //check validate data
            if (this.checkData()) {
                //swal loading
                Swal.showLoading();

                //create data form
                const formData = new FormData();
                formData.append('attr_type_id', this.attr_id);
                formData.append('name', this.news.name);
                formData.append('details', this.news.description);
                formData.append('date_time_start_valid', this.news.date_time_start);
                formData.append('date_time_end_valid', this.news.date_time_end);
                formData.append('image_file', image_file);
                formData.append('image_name', image_file_name);
                formData.append('image_type', image_file_type);
                formData.append('video_youtube', this.getYoutubeUrl(this.news.video_url));

                //send data
                axios.post('../admin/add-news-post', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function(response) {
                    Swal.close();
                    console.log(response);
                    if (response.data.status == 200) {
                        //show success
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            timer: 2000,
                            timerProgressBar: true,
                            text: 'เพิ่มข้อมูลสำเร็จ',
                        });
                        //redirect to dashboard
                        setTimeout(() => {
                            window.location.href = '../admin/dashboard';
                        }, 2000);
                    } else {
                        //show error message
                        Swal.fire({
                            icon: 'error',
                            title: 'ผิดพลาด',
                            text: 'เพิ่มข่าวสารไม่สำเร็จ !',
                        });
                    }
                }.bind(this)).catch(function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'ผิดพลาด',
                        text: error,
                    });
                });
            }
        }
    }
};
Vue.createApp(addNewsComponent).mount('#add-news-componet');