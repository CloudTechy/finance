<template>


    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header align-items-center justify-content-center">
            <h3 class="modal-title font-weight-bold text-center justify-content-center text-secondary text-capitalize "> <span v-if = "uploadItem"> {{uploadItem.title}} </span></h3>
            <button @click = "closeModal" type="button" class="close" data-dismiss="modal">&times;</button>
            
          </div>
          <div class="modal-body">
            <div class="error-msg  m-3" v-if="error">
                <ul v-if="error.pop" v-for = "err in error.pop" class="p-2 m-3"><li class="text-danger">{{err}}</li></ul>
            </div>
                
            <form role="form" ref="form" @keydown="form.onKeydown($event)" @submit.prevent='uploadPop' >
                <div class="card-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" required="" @change = "updateLabel" class="custom-file-input" ref="fileInput" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01" aria-describedby="inputGroupFileAddon01">{{label}}</label>
                        </div>
                        
                    </div>
                     <p class="text-success small">File must be an image file and must not be more than 4MB</p>
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
                }),
                error : '',
                label : 'Choose file'
            }
        },
        beforeDestroy(){
            this.$refs.closeButton.click()
            this.form.reset()
        },
        computed : {
            uploadItem(){
                return this.$root.uploadItem
            }
        },
        methods: {
            uploadPop(){
                var data = new FormData()
                var file = this.$refs.fileInput.files[0]
                if(this.$refs.fileInput.files[0].size > 4000000){
                    return this.$root.alert('error', ' ', ' File size is too large.')   
                }
                this.form.pop = file
                this.form.id = this.uploadItem.id
                this.form.submit('post',this.uploadItem.url, {
                        transformRequest: [function(data, headers) {
                            return objectToFormData(data)
                        }]

                    })
                    .then(response => {
                        this.$emit('popUploaded')
                        this.$root.alert('success', '', response.data.message)
                        this.form.reset()
                        this.$refs.closeButton.click()
                    })
                    .catch(error => {
                        this.$root.alert('error', '', 'Upload not successful, try again.')
                        this.error = error.response.data.error
                    })
            },
            updateLabel(){
                this.label = this.$refs.fileInput.files[0].name
                if(this.$refs.fileInput.files[0].size > 4000000){
                     this.$root.alert('warning', ' ', ' File size is too large.')   
                }
            },
            closeModal(){
                this.form.reset() 
                this.$emit('PopModalClosed')
                this.$refs.closeButton.click()
            }
        }

    }

</script>