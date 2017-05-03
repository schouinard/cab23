<template>
    <div class="alert alert-success alert-flash" v-show="show">
        <h4><i class="icon fa fa-check"></i> Succès!</h4>
        {{ body }}
    </div>
</template>

<script>
    export default {
        props: ['message'],
        data(){
            return {
                body: this.message,
                show: false
            }
        },

        created() {
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on('flash', message => {
                this.flash(message);
            });
        },

        methods: {
            flash(message) {
                this.body = message;
                this.show = true;

                this.hide();
            },
            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 5000);
            }
        }
    };
</script>

<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        top: 75px;
    }
</style>