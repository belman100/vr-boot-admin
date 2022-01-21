const addEditVideo = {
    data() {
        return {
            type_id: '61d85ed74a41313a64469803',
            video: {
                _id: { $oid: '' },
                type_id: '',
                video_url: '',
                created_at: '',
                updated_at: '',
            },
        }
    },
    mounted() {
        this.getVideo();
    },
    methods: {
        validateVideo() {
            var valid = true;
            if (this.video.video_url == '') {
                valid = false;
                Swal.fire({
                    icon: 'error',
                    title: 'ผิดพลาด',
                    text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                    footer: ''
                })
            }
            return valid;

        },
        getVideo() {
            let url = '../admin/get-video/' + this.type_id;
            axios.get(url).then(response => {
                console.log(response);
                if (response.data.status == 200) {
                    this.video = response.data.video;
                    //console.log(this.video);
                    this.video.video_url = "https://www.youtube.com/watch?v=" + this.video.video_url;

                } else {
                    this.video = {
                        _id: '',
                        type_id: '',
                        video_url: '',
                        created_at: '',
                        updated_at: '',
                    }
                }
            }).catch(error => {
                console.log(error);
            });
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
        //add edit data to api
        addEditVideo() {
            //check validate
            if (this.validateVideo()) {
                //add data to form
                let formData = new FormData();
                formData.append('_id', this.video._id.$oid);
                formData.append('type_id', this.type_id);
                formData.append('video_url', this.getYoutubeUrl(this.video.video_url));
                //swal loading
                Swal.showLoading();
                //send data to api
                axios.post('../admin/add-edit-video', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    //console.log(response);
                    Swal.close();
                    if (response.data.status == 200) {
                        //swal success
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: 'บันทึกข้อมูลสำเร็จ',
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
                        })

                        .then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ผิดพลาด',
                            text: 'บันทึกข้อมูลไม่สำเร็จ',
                            footer: ''
                        })
                    }
                })

            }
        }
    },
}
Vue.createApp(addEditVideo).mount("#ModaladAdd-youtube");