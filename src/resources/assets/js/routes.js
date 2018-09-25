import ExampleComponent from './components/ExampleComponent'
import Login from './components/Auth/Login.vue'
import Register from './components/Auth/Register.vue'

export default [
    { path: '/', component: ExampleComponent, meta: { requiresAuth: true } },
    { path: '/login', component: Login, meta: { requiresAuth: false } },
    { path: '/register', component: Register, meta: { requiresAuth: false } }
]