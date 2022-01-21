const ListPreviewAttractionCountComponent = {
    data() {
        return {
            attraction_view: [],
        }
    },
    mounted() {
        this.getListAttractionCount();
        console.log(this.attraction_view);
    },
    methods: {
        getListAttractionCount() {
            let url = '../admin/get-attraction-view-all';
            axios.get(url).then(response => {
                console.log(response);
                if (response.data.status == 200) {
                    this.attraction_view = response.data.attr_view;
                    console.log(this.attraction_view[0].attr_name);
                } else {
                    this.attraction_view = [];
                }
            }).catch(error => {
                console.log(error);
            });
        },
    },
}

Vue.createApp(ListPreviewAttractionCountComponent).mount('#list-attraction-count-component')