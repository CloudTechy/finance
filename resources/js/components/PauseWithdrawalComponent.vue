<template>
    <div class="modal-dialog">
        <div v-if="days" class="modal-content">
            <div class="modal-header align-items-center justify-content-center">
                <h3 class="modal-title font-weight-bold text-center justify-content-center text-secondary text-capitalize "> <span>Account Setup </span></h3>
                <button @click="closeModal" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="alert blockquote alert-info">How long would you want your withdrawal to be on hold?</div>
                <!-- <div class="error-msg  m-3" v-if="error">
                    <ul v-if="error.pop" v-for="err in error.pop" class="p-2 m-3">
                        <li class="text-danger">{{err}}</li>
                    </ul>
                </div> -->
                <form role="form" ref="form" @keydown="form.onKeydown($event)" @submit.prevent='sendRequest'>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="sel1">Days</label>
                            <select v-model="form.duration" class="form-control" id="sel1">
                                <option :value="day.duration" v-for="day in days">{{day.description}}</option>
                            </select>
                        </div>
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
        this.getDays()
    },
    data() {
        return {
            form: new Form({
                duration: 30
            }),
            err: '',
            msg: '',
            error: '',
            days: '',
        }
    },
    beforeDestroy() {
        this.$refs.closeButton.click()
        this.form.reset()
    },
    computed: {
        uploadItem() {
            return this.$root.uploadItem
        },
    },
    methods: {
        closeModal() {
            this.$refs.closeButton.click()
        },
        sendRequest() {
            this.form.post("/auth/withdrawdurations")
                .then(response => {
                    this.$root.refreshUser()
                    this.msg = response.data.message
                    this.$root.alert('success', ' ', this.msg)
                    this.$refs.closeButton.click()
                })
                .catch(error => {
                    this.error = error.response.data.error
                    this.err = error.response.data.message
                    console.log(error.response)
                })
        },
        getDays() {
            this.form.get("/auth/durations")
                .then(response => {
                    this.days = response.data.data.item
                })
                .catch(error => {
                    console.log(error.response)
                    this.days = []
                })
        }
    }

}

</script>
