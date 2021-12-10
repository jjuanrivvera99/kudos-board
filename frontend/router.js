import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

const page = path => () => import(`~/pages/${path}`).then(m => m.default || m);

const routes = [
  {
    path: '/',
    name: 'index',
    component: page('index.vue'),
  },
  {
    path: '/login',
    name: 'login',
    component: page('auth/login.vue'),
  },
  {
    path: '/register',
    name: 'register',
    component: page('auth/register.vue'),
  },
  {
    path: '/verify',
    name: 'verify',
    component: page('auth/verify.vue'),
  },
  {
    path: '/forgot-password',
    name: 'forgot-password',
    component: page('auth/forgot-password.vue'),
  },
  {
    path: '/reset-password/:token',
    name: 'reset-password',
    component: page('auth/reset-password.vue'),
  },
];

export function createRouter() {
  return new Router({
    routes,
    mode: 'history',
    // scrollBehavior: () => ({ y: 0 }),
    // linkActiveClass: 'active'
  })
}
