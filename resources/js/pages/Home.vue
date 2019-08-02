<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Home</div>
            <div class="card-body">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt amet tempora sint dolor nam quam quos inventore odio hic, enim beatae nulla in tenetur odit natus facere voluptas excepturi deleniti? Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur sit eligendi rem et minus dolor hic, placeat eum sequi ipsa, debitis ex magni. Hic laudantium consectetur aliquid eos fuga cumque.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt amet tempora sint dolor nam quam quos inventore odio hic, enim beatae nulla in tenetur odit natus facere voluptas excepturi deleniti? Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur sit eligendi rem et minus dolor hic, placeat eum sequi ipsa, debitis ex magni. Hic laudantium consectetur aliquid eos fuga cumque.
                </p>
                <h2>Todos count is  {{ todosCount }}</h2>
                <h3>{{ $store.state.count }}</h3> <br> <button @click = "increment">click me</button>
                <button @click = "incrementAsync">click me asyc</button>
                <button @click = "decrementAsync">click me for decrement asyc</button>
                <h2>Todos Done</h2>
                <p v-for = "todo in todosDone">{{ todo.task }}</p>
                <h2>Todos not Done</h2>
                <p v-for = "todo in todosNotDone">{{ todo.task }}</p>
                <h2>Todos</h2>
                <p v-for = "todo in $store.state.todos">{{ todo.task }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue'
    import vuex from 'vuex';
    Vue.use(vuex);
    const store = new vuex.Store({
        state : {
            count: 3333,
            todos : [
                {'id' : 1, 'task':"i wanna ...", 'done':false},
                {'id' : 2, 'task':"i wanna ...", 'done':true},
                {'id' : 3, 'task':"i wanna ...", 'done':true}
            ]
        },
        getters : {
            todosCount (state){
                return state.todos.length
            },
            todosDone (state){
                return state.todos.filter(todo => todo.done)
            }
            ,
            todosNotDone (state){
                return state.todos.filter(todo => todo.done == false)
            }
        },
        actions: {
            actionA({commit}){
                return new Promise((resolve, reject) => {
                    setTimeout(() => {
                        commit('increment')
                        resolve('hero')
                    }, 2000);
                })
            },
            async actionB({dispatch, commit}){

                commit('decrement', await getData())
                console.log('decrement done');
            }
        },
        mutations : {
            increment : state => {
                return state.count++
            },
            decrement : state => {
                return state.count--
            }
        }
    });
    import { mapState , mapMutations, mapGetters } from 'vuex'
    export default {
        store,
        data() {
            return {
                localCount : 1
            }
        },
        computed : mapGetters([
            'todosCount', 'todosDone', 'todosNotDone'
        ]),
        methods : {
            ...mapMutations([
            'increment', 'decrement'
            ]),
            incrementAsync (){
                this.$store.dispatch('actionA').then((response)=>{
                    console.log('async function running ' + response)
                }).catch((error)=>console.log('error'))
            },
            decrementAsync (){
                this.$store.dispatch('actionB')
            }
        }
    }
</script>
