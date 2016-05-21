Vue.component('preview', {
    data(){
        return {
            url: '',
            webpage: null
        }
    },
    methods: {
        preview() {
            this.$http.get(`demo?url=${this.url}`).then(({data}) => {
                this.webpage = data.data;
            });
        },

        follow(link) {
            alert('Follow the link');
        }
    }
});
