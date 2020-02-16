<template>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header align-items-center justify-content-center">
                <h2 class="modal-title font-weight-bold text-center justify-content-center text-secondary text-capitalize "><span class=" font-weight-bold text-secondary text-capitalize">Send Email to {{user.username}}</span></h2>
                <button @click="closeModal" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- <div class="error-msg  m-3" v-if="error">
                    <ul v-if="error.pop" v-for="err in error.pop" class="p-2 m-3">
                        <li class="text-danger">{{err}}</li>
                    </ul>
                </div> -->
                <form role="form" ref="form" @keydown="form.onKeydown($event)" @submit.prevent='sendEmail'>
                    <div class="card-body">
                        <fieldset class="border border-secondary p-2">
                            <legend class="w-auto small font-weight-bold border bg-secondary"><span class="text-white">Quick Fill</span></legend>
                            <div class="form-group">
                                <label for="subject">Email Subject</label>
                                <input type="text" v-model="form.subject" required="" class="form-control" ref="subject" placeholder="Enter subject">
                                <has-error :form="form" field="subject"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="message">message</label>
                                <textarea class="form-control" v-model="form.message" required="" ref="message" placeholder="Enter message" rows="5"></textarea>
                                <has-error :form="form" field="message"></has-error>
                            </div>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button @click="closeModal" style="color: white; background-color: darkred;" type="button" ref="closeButton" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button style="color: white; background-color: dodgerblue;" type="submit" :disabled="form.busy" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    created() {

    },
    data() {
        return {
            form: new Form({
                id: this.$root.mailUser.id,
                message: '',
                subject: '',
            }),
            error: '',
        }
    },
    beforeDestroy() {
        this.$refs.closeButton.click()
        this.form.reset()
    },
    computed: {
        user() {
            return this.$root.mailUser
        }
    },
    methods: {
        sendEmail() {
            this.form.post("/auth/email")
                .then(response => {
                    this.$root.alert('success', ' ', response.data.message)
                    this.form.reset()
                    this.$refs.closeButton.click()
                })
                .catch(error => {
                    this.$root.alert('error', ' ', 'Email could not be sent, try again.')
                    this.error = error.response.data.error
                })
        },
        closeModal() {
            this.form.reset()
            this.$emit('emailModalClosed')
            this.$refs.closeButton.click()
        }
    }

}

</script>
