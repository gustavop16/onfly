import { RouteRecordRaw } from 'vue-router';

const token = localStorage.getItem('token')
const routes: RouteRecordRaw[] = [
  

  {
    path: '/auth/login',
    name: 'auth',
    component: () => import('pages/Login.vue'),   
  },
  {
    path: '',
    name: 'authDefault',
    component: () => import('pages/Login.vue'),   
  },
  {
    path: '',
    component: () => import('layouts/AdminLayout.vue'),
    beforeEnter: function (to, from, next) {
      (!token) ? next('/') : next()
    },
    children: [
      { 
        path: 'usuarios', 
        name:'users', 
        component: () => import('pages/users/index.vue')},
      { 
        path: 'usuarios/novo', 
        name:'new_user', 
        component: () => import('pages/users/create.vue') 
      },
      { 
        path: 'despesas', 
        name:'expense', 
        component: () => import('pages/expense/index.vue'), 
        beforeEnter: function (to, from, next) {
          
          console.log('token');
          console.log(token);

          (!token) ? next('/') : next()
        },
      },
      { 
        path: 'despesas/novo', 
        name:'new_expense', 
        component: () => import('pages/expense/form.vue'),
        beforeEnter: function (to, from, next) {
          (!token) ? next('/') : next()
        }, 
      },
      { 
        path: 'despesas/edit/:id', 
        name:'item_expense', 
        component: () => import('pages/expense/form.vue'),
        beforeEnter: function (to, from, next) {
          (!token) ? next('/') : next()
        }, 
    },
      
    ],
  },
 

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];

export default routes;
