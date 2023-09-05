import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [

  {
    path: '/auth/login',
    name: 'login',
    component: () => import('pages/Login.vue'),   
  },
  {
    path: '',
    component: () => import('layouts/AdminLayout.vue'),
    children: [
      { path: 'usuarios', name:'users', component: () => import('pages/users/index.vue') },
      { path: 'usuarios/novo', name:'new_user', component: () => import('pages/users/create.vue') },
      { path: 'despesas', name:'expense', component: () => import('pages/expense/index.vue') },
      { path: 'despesas/novo', name:'new_expense', component: () => import('pages/expense/form.vue') },
      { path: 'despesas/edit/:id', name:'item_expense', component: () => import('pages/expense/form.vue') },
      
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
