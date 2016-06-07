Vue.component('preview', {
    data(){
        return {
            url: '',
            webpage: null
        }
    },
    methods: {
        /**
         * Send the request to fetch the URL preview
         */
        preview() {
            let $button = $('button[type="submit"]');
            $button.button('loading');
            this.$http.get(`demo?url=${this.url}`).then(({data}) => {
                this.webpage = data.data;
                this.url = '';
                $button.button('reset');
            }).catch(({data}) => {
                swal({
                    title: "Whoooops!",
                    text: `${data.details.url}`,
                    html: true,
                    type: "error",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Got it!"
                }, () => {
                    $('input[type="url"]').focus();
                });
                $button.button('reset');
            });
        },

        closePreview() {
            this.webpage = null;
            $('input[type="url"]').focus();
        },
        
        /**
         * Validate the url format to add http if needed
         */
        validateUrl() {
            let regex = /^(http|https)/;
            if(this.url.length > 3 && !this.url.match(regex)) {
                this.url = 'http://' + this.url;
            }
        }
    }
});
