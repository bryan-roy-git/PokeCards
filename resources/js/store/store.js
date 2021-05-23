
// window.Vue = require('vue').default;
import Vue from 'vue';
import Vuex from 'vuex'
import axios from 'axios'
axios.defaults.withCredentials = true

Vue.use(Vuex)

export default new Vuex.Store({
    state:{
        user: null,
        auth: false,
        monedas: 0,
        cards: '',

    },
    getters:{
        isAuthenticated(state){
            return state.auth;
        },

        user: (state) => {
            return state.user;
        },  
        
        cards: (state) => {
            return state.cards;
        },
        
    },
    mutations: {
        SET_USER(state, user){
            
            state.user = user
            state.auth = Boolean(user) 
            if (state.auth){
                state.monedas = user.coins
                state.cards =  user.pokemon   
            } 
        },

        SET_PRICE_LESS(state, price){
            state.monedas -= price
        },
        
        SET_PRICE_MORE(state, price){
            state.monedas += price
        }
        // SET_USER_CARDS(state)
        // LESS_COINS(state, price){

        // }
        
    },
    actions: {
        
        async login ({ dispatch },credentials) {
            await axios.get('/sanctum/csrf-cookie') //await = espera a que termine la primera peticion
            console.log(credentials, 'credentials')
            const log= await axios.post('login',credentials)
            if (log.data.nick!=null){
                localStorage.setItem("who", true);
 
            } else{
                localStorage.removeItem("who")
            }
            
            return dispatch("getUser") // dispatch => ejecutar una accion
            .catch(error => {
                console.log(error)
                localStorage.removeItem("who")
            })
        },

        async logout ({ dispatch }) {
            localStorage.removeItem("who")
            localStorage.removeItem('length')
            await axios.post('logout')
            return dispatch("getUser") // dispatch => ejecutar una accion
        },

        async getUser({ commit }) { // commit => sirve para ejecutar una mutacion
            const requestOne = axios.get("/api/user");
            if(requestOne){
                const requestTwo = axios.get("/api/pokesUser");
                axios.all([requestOne, requestTwo]).then(axios.spread((...responses) => {
                const responseOne = responses[0]
                const responseTwo = responses[1]
                //console.log(responseOne)
                var usuari=responseOne.data
                var pokes =responseTwo.data
                //console.log(responseTwo)
                // use/access the results 
                usuari.pokemon=pokes.toString()
                //console.log(user, 'user');
                commit("SET_USER", usuari)
                })).catch(errors => {
                    commit("SET_USER", null)
                    localStorage.removeItem("who")
                })

            }
            
        },

        async add_poke ({commit}, price){
            await commit('SET_PRICE_LESS',price)
        },

        async del_poke ({commit}, price){
            await commit('SET_PRICE_MORE',price)
        }

        // async update_card ({commit}) {
        //     await commit()
        // }

            
    }

})