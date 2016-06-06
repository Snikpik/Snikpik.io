import {filter} from 'lodash';

Vue.filter('showOnly', function (value, name) {

    if(name !== null) {
        return filter(value, (item) => {
            return item.token.name == name;
        })
    }

    return value;

});

Vue.component('dashboard', {
    props: ['user', 'applications'],

    data() {
        return {
            requests: {},
            page: '/internal/requests?page=1',
            filter: null
        }
    },

    computed: {
        url() {
            if(this.filter !== null) {
                return `${this.page}&filter=${encodeURIComponent(this.filter)}`
            }

            return this.page;
        }
    },

    ready() {
        this.getRequests();
    },

    methods: {
        getRequests() {
            this.$http.get(this.url)
                .then(function(response) {
                    this.requests = response.data;
                });
        },

        reloadRequests() {
            this.requests = [];
            this.getRequests();
        },

        showOnly(filter = null) {
            this.page = '/internal/requests?page=1';
            this.filter = filter;
            this.reloadRequests();
        },

        showPage(page) {
            this.page = page;
            this.reloadRequests();
        }
    }
});
