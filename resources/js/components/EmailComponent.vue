<template>


    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header align-items-center justify-content-center">
            <h2 class="modal-title font-weight-bold text-center justify-content-center text-secondary text-capitalize "> SEND EMAIL TO {{user.username}}</h2>
            <button @click = "closeModal" type="button" class="close" data-dismiss="modal">&times;</button>
            
          </div>
          <div class="modal-body">
            <div class="error-msg  m-3" v-if="error">
                <ul v-if="error.pop" v-for = "err in error.pop" class="p-2 m-3"><li class="text-danger">{{err}}</li></ul>
            </div>
                
            <form role="form" ref="form" @keydown="form.onKeydown($event)" @submit.prevent='sendEmail' >
                <div class="card-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" required="" @change = "" class="custom-file-input" ref="fileInput" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01" aria-describedby="inputGroupFileAddon01">{{label}}</label>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click = "closeModal" style="color: white; background-color: darkred;" type="button" ref = "closeButton" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button style="color: white; background-color: dodgerblue;" type="submit":disabled="form.busy" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
      
</template>
<script>
    
    export default {
        created(){

        },
        data() { 
            return {
                form : new Form({
                    id = 
                }),
                error : '',
            }
        },
        beforeDestroy(){
            this.$refs.closeButton.click()
            this.form.reset()
        },
        computed : {
            user(){
                return this.$root.mailUser
            }
        },
        methods: {
            sendEmail(){
            this.form.post("/auth/email")
                .then(response => {
                    this.$root.alert('success', '', response.data.message)
                    this.form.reset()
                    this.$refs.closeButton.click()
                })
                .catch(error => {
                    this.$root.alert('error', '', 'Email could not be sent, try again.')
                    this.error = error.response.data.error
                })
            },
            closeModal(){
                this.form.reset() 
                this.$emit('emailModalClosed')
                this.$refs.closeButton.click()
            }
        }

    }

</script>