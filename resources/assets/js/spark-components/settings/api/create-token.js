var base = require('settings/api/create-token');

Vue.component('spark-create-token', {
    mixins: [base],

    methods: {
        /**
         * Create a new API token.
         */
        create() {
            Spark.post('/settings/api/token', this.form)
                .then(response => {
                    this.showToken(response.token);

                    this.resetForm();

                    this.$dispatch('updateTokens');
                });
        },

        /**
         * Reset the token form back to its default state.
         */
        resetForm() {
            this.form.name = '';

            this.assignDefaultAbilities();

            this.allAbilitiesAssigned = false;
        },

        /**
         * Validate the url format to add http if needed
         */
        validateUrl() {
            let regex = /^(http|https)/;
            if(this.form.domain.length > 3 && !this.form.domain.match(regex)) {
                this.form.domain = 'http://' + this.form.domain;
            }
        }
    }
});
