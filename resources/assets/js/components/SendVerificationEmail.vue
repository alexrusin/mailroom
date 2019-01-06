<template>
    <div class="container">
        <div class="row">
            <div v-if="!emailSent">
                <button type="button" class="btn btn-primary btn-sm" @click="sendEmail" id="send-email">
                    <span class="buttonText">Resend Email</span>
                    <span class="buttonLoadingImage hiddenButtonElement"></span>
                </button>
            </div>
            <div v-else>
                <p class="notification">Email has been sent.  Please check your email in a few minutes</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                emailSent: false
            };
        },
        methods: {
            sendEmail() {
                axios.post('/resend-verification-email');
                this.emailSent = true;
            }
        }
    }
</script>

<style>
    .notification {
        font-size: 0.9em;
        color: green;
    }
</style>
