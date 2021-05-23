import Vue from 'vue'
import VueRouter from 'vue-router'
import store from "../store/store";
import axios from 'axios';

// import ExampleComponent from '../components/ExampleComponent'
import RegistroComponent from '../components/RegistroComponent'
import LoginController from '../components/LoginController'
import Forgot from '../components/Forgot';
import Reset from '../components/Reset';
import Home from '../components/Home';
import Comienzo from '../components/Comienzo';
import Tutorial from '../components/Tutorial';
import Adventure from '../components/Adventure';
import WildMap from '../components/WildMap';
import getPokemons from '../components/GetPokemons';
import Avatar from '../components/PerfilComponent';
import Shop from '../components/TiendaPokeComponent';
import MyShops from '../components/MyShopComponent';
import MyGamesOff from '../components/MyGamesOffComponent';
import ChangePass from '../components/ChangePass';
import ChangeProfile from '../components/ChangeProfile';
import Decks from '../components/MiMazo';

Vue.use(VueRouter)

const router = new VueRouter({
    mode:'history',
 
    routes: [

        { path: '/register', component:  RegistroComponent, name: 'register', meta: { requiresVisitor: true }},
        { path: '/login', component:  LoginController , name: 'login', meta: { requiresVisitor: true }},
        { path: '/', name: 'base', component: () => import(/* webpackChunkName: "Raiz" */"../components/Home.vue")},
        { path: '/Squirtle',  name: 'Squirtle', component: Tutorial, meta: { requiresAuth: true, requiresNoPokemon: true } },
        { path: '/Bulbasaur',  name: 'Bulbasaur', component: Tutorial, meta: { requiresAuth: true, requiresNoPokemon: true } },
        { path: '/Charmander',  name: 'Charmander', component: Tutorial, meta: { requiresAuth: true, requiresNoPokemon: true } },
        { path: '/home', name: 'home', component: Home , meta: { requiresAuth: true }},
        { path: '/forgot', name: 'forgot',  component: Forgot , meta: { requiresVisitor: true }},
        { path: '/reset/:token', name: 'reset', component: Reset,  meta: { requiresVisitor: true }},
        { path: '/starting',  name: 'starting', component: Comienzo, meta: { requiresAuth: true, requiresNoPokemon: true } },
        { path: '/adventure', name: 'adventure', component: Adventure,  meta: { requiresAuth: true }},
        { path: '/wildMap/:area', name: 'wildMap', component: WildMap,  meta: { requiresAuth: true } },
        { path: '/shop', name: 'shop', component: Shop,  meta: { requiresAuth: true } },
        { path: '/myshops', name: 'myshops', component: MyShops,  meta: { requiresAuth: true } },
        { path: '/myGamesOff', name: 'myGamesOff', component: MyGamesOff,  meta: { requiresAuth: true } },
        { path: '/decks', name: 'decks', component: Decks,  meta: { requiresAuth: true } },

        { path: '/changeAvatar', name: 'avatar', component: Avatar,  meta: { requiresAuth: true } },
        { path: '/changePass', name: 'changePass', component: ChangePass,  meta: { requiresAuth: true }},
        { path: '/changeProfile', name: 'changeProfile', component: ChangeProfile,  meta: { requiresAuth: true }},

        //solo usar path pokemons cuando se quiera obtener datos de la api externa y guardarlos en la DDBB
        // { path: '/pokemons', name: 'pokemons', component:getPokemons,  meta: { requiresAuth: true } },
        { path: '*', name: 'error', component: () => import(/* webpackChunkName: "Error" */"../components/Error.vue")},
    ],   
    
})


  


router.beforeEach( (to, from, next) => {

  if (to.matched.some(record => record.meta.requiresAuth)) {  
        
      if (!localStorage.getItem('who')){
          next('login')
      } 
      else{ 
        next()
      }
  } 
 else if (to.matched.some(record => record.meta.requiresVisitor)) {
      if (localStorage.getItem('who')) {
        next('home')
      } else {
        next()
      }

  } else {
    next()
  }

if (to.matched.some(record => record.meta.requiresNoPokemon)) {

  if (localStorage.getItem('length')) {
    next('home')
  } else {
    next()
  }
}

 
  
});   

export default router
  