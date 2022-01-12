//var image_preview = '../resource/image/';
const VoiewPoint = {
    data() {
        return {
            hostpot: {},
            image_preview: '',
            //audio_url: '',
            audio: null,
        }
    },
    mounted() {
        this.getAttractionPoint();
    },
    methods: {
        getAttractionPoint() {
            axios.get('../get-preview/' + id)
                .then(response => {
                    console.log(response);
                    if (response.data.status == 200) {
                        this.hostpot = response.data.point;
                        this.image_preview = '../resource/image/' + this.hostpot.image_file_name;
                        this.setImageToBase64(this.image_preview);
                    } else {
                        this.hostpot = [];
                    }
                })
        },
        setImageToBase64(image) {
            //console.log(image);
            fetch(image)
                .then(response => response.blob())
                .then(blob => {
                    //img to base64
                    var reader = new FileReader();
                    reader.onloadend = function() {
                        //ad image to img tag src
                        this.image_preview = reader.result;
                        //document.getElementById('image-preview').className = reader.result;
                        //$('#image-preview').attr('src', reader.result);
                    }.bind(this);
                    reader.readAsDataURL(blob);
                    //send to src tag
                    //this.attraction_point_img.push(image_base64);
                })
        },
        PlayAndPushAudio() {
            //check audio is exist
            //console.log(this.hostpot.audio_file_name);
            if (this.hostpot.audio_file_name != "") {
                if (this.audio == null) {
                    let audio_url = '../resource/audio/' + this.hostpot.audio_file_name;
                    this.audio = new Audio(audio_url);
                }
                //console.log(this.audio);
                //audio wait to load
                //this.audio.oncanplaythrough = function() {
                //check audio is exist
                if (this.audio.canPlayType('audio/mp3')) {
                    if (this.audio.paused) {
                        this.audio.play();
                    } else {
                        this.audio.pause();
                    }
                }
                //}
            }
        },
    },
};
Vue.createApp(VoiewPoint).mount("#preview-point");