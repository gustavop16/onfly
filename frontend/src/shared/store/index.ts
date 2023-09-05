import { createStore } from 'vuex';

import { UserModel } from '../api/models';


export type OptionsType<T = string | number, K = string | number> = {
  key: T;
  value: K;
};

function getAvailableRoutes() {
  return '/admin/usuarios';
}

export default createStore({
  state: {
    authenticated: false,
    user: null as UserModel | null,
  },
  mutations: {
    SET_AUTH(state, authenticated: boolean) {
      state.authenticated = authenticated;
    },
    SET_USER(state, user: UserModel | null) {
      state.user = user;
    },
  
  },
  actions: {
    setAuth({ commit }, authenticated: boolean) {
      commit('SET_AUTH', authenticated);
    },
    setUser({ commit }, user: UserModel | null) {
      commit('SET_USER', user);
    },
  },
  getters: {
    availableNavRoutes() {
      return getAvailableRoutes();
    },
   
  },
});
