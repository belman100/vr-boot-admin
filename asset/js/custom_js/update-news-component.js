//image file
var image_file;
var image_file_name = '';
var image_file_type = '';
//vue create
const UpdateNewsComponent = {
    data() {
        return {
            attr_id: '61d85e8f4a41313a64469802',
            news: {
                name: '',
                details: '',
                date_time_start_valid: '',
                date_time_end_valid: '',
                image_name: '',
                video_youtube: '',
            }

        }
    },
    mounted() {
        this.getNewsData();
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
        //get news data
        getNewsData() {
            //show loading
            Swal.showLoading();
            //get news_id from local storage
            let news_id = localStorage.getItem('news_id');
            //get news data
            axios.get('../admin/get-select-news/' + news_id)
                .then(response => {
                    console.log(response.data);
                    //swal close
                    Swal.close();
                    //check response data
                    if (response.data.status == 200) {
                        //set news data
                        this.news = response.data.news;
                        //set image name
                        image_file_name = this.news.image_name;
                        //set youtube video id
                        if (this.news.video_youtube != '') {
                            let url = 'https://www.youtube.com/watch?v=' + this.news.video_youtube;
                            this.news.video_youtube = url;
                            //console.log(this.news.video_youtube);
                            //document.getElementById('youtube_link').value = url;
                        }
                    } else {
                        //swal('Error', 'Error get news data', 'error');
                        Swal.fire({
                            icon: 'error',
                            type: 'error',
                            title: 'ผิดพลาด',
                            text: 'ไม่สามารถดึงข้อมูลข่าวได้ !',
                        });
                    }
                })
                .catch(error => {
                    //swal('Error', 'Error get news data', 'error');
                    Swal.fire({
                        icon: 'error',
                        type: 'error',
                        title: 'ผิดพลาด',
                        text: error,
                    });
                })
        },
        checkData() {
            var message = "";
            var is_valid = true;
            //check validate data
            if (this.news.name == '') {
                message += "กรุณากรอกชื่อข่าว !\n";
                is_valid = false;
            }
            if (this.news.details == '') {
                message += "กรุณากรอกรายละเอียดข่าว !\n";
                is_valid = false;
            }
            if (this.news.date_time_start_valid == '') {
                message += "กรุณากรอกวันที่เริ่มข่าว !\n";
                is_valid = false;
            }
            if (this.news.date_time_end_valid == '') {
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
        //update news
        updateNews() {
            //check validate data
            if (this.checkData()) {
                //swal loading
                Swal.showLoading();
                //create data form
                const formData = new FormData();
                formData.append('_id', this.news._id.$oid);
                formData.append('attr_type_id', this.attr_id);
                formData.append('name', this.news.name);
                formData.append('details', this.news.details);
                formData.append('date_time_start_valid', this.news.date_time_start_valid);
                formData.append('date_time_end_valid', this.news.date_time_end_valid);
                formData.append('image_file', image_file);
                formData.append('image_old_name', this.news.image_name);
                formData.append('image_name', image_file_name);
                formData.append('image_type', image_file_type);
                let video_youtube = this.getYoutubeUrl(this.news.video_youtube);
                console.log(this.news.video_youtube);
                console.log(video_youtube);
                formData.append('video_youtube', video_youtube);
                //send data to server
                axios.post('../admin/edit-news-post', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    //console.log(response.data);
                    //close swal
                    Swal.close();
                    //check response data
                    if (response.data.status == 200) {
                        //show success
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            timer: 2000,
                            timerProgressBar: true,
                            text: 'อัพเดทข้อมูลสำเร็จ',
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
                }).catch(error => {
                    //swal error
                    Swal.fire({
                        icon: 'error',
                        title: 'ผิดพลาด',
                        text: error,
                    });
                });
            }
        },
    },
}
Vue.createApp(UpdateNewsComponent).mount('#update-news-componet');