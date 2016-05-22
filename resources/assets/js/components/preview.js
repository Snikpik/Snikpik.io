Vue.component('preview', {
    data(){
        return {
            url: '',
            webpage: null
        }
    },
    methods: {
        preview() {
            let $button = $('button[type="submit"]');
            $button.button('loading');
            this.$http.get(`demo?url=${this.url}`).then(({data}) => {
                this.webpage = data.data;
                this.url = '';
                $button.button('reset');
            });
        },

        follow(link) {
            alert('Follow the link');
        }
    }
});
