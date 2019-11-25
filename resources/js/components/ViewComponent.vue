<template>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header align-items-center justify-content-center">
            <h3 class="modal-title font-weight-bold text-center justify-content-center text-secondary text-capitalize "> <span v-if = "viewItem"> {{viewItem.title}} </span></h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
          </div>
          <div class="modal-body">
            <div class="error-msg  m-3" v-if="error">
                <ul v-if="error.pop" v-for = "err in error.pop" class="p-2 m-3"><li class="text-danger">{{err}}</li></ul>
            </div>
                <div class="card bg-dark text-white">
                  <img :src="$root.basepath + '/img/uploads/'+viewItem.imgUrl" class="card-img" alt="">
                  <div class="card-img-overlay">
                    <h5 class="card-title">BFIN</h5>
                  </div>
                </div>
                <div class="modal-footer">
                    <button @click = "closeView" style="color: white; background-color: darkred;" type="button" ref = "closeButton" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
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
            }
        },
        computed : {
            viewItem(){
                return this.$root.viewItem
            }
        },
        methods: {
            closeView() {
                this.$emit('viewModalClosed')
            }
        }

    }

</script>