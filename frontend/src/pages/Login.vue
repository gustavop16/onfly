
<template>

<q-layout>
  <q-page-container>
 
  <q-page class="row items-center justify-evenly">
   
    <div class="column">
      <div class="row">
        <h5 class="text-h5 text-white q-my-md">Company & Co</h5>
      </div>
      <div class="row">
        <q-card square bordered class="q-pa-lg shadow-1">
          <q-card-section>
            <q-form class="q-gutter-md" @submit.prevent="submitForm">
              <q-input square filled clearable 
              v-model="email" 
              type="email" 
              label="email" 
              :rules="[val => !!val || 'Campo obrigatório']" 
              :value = "payload.email"
              @update:modelValue="event => {
                  payload.email = event;
                }" />
              
              <q-input square filled clearable 
              v-model="password" 
              type="password" 
              label="password"
              :rules="[val => !!val || 'Campo obrigatório']" 
              :value = "payload.password"
              @update:modelValue="event => {
                  payload.password = event;
                }" />

            <q-card-actions class="q-px-md">
              <q-btn unelevated color="light-green-7" size="lg" class="full-width" label="Entrar" type="submit" />
            </q-card-actions>

            </q-form>
          </q-card-section>
        
        </q-card>
      </div>
    </div>
    
  </q-page>
</q-page-container>
</q-layout>
</template>

<script lang="ts">

import { LoginDTO } from '../shared/api/dtos';
import { defineComponent, ref } from 'vue';
import authService from '../shared/api/services/auth.service'
import authenticationService from '../shared/api/services/authentication.service';
import { LoginModel } from 'src/shared/api/models';
import store from 'src/shared/store';
import { api } from 'src/shared/api/services';

export default defineComponent({
  name: 'PageLogin',
  setup(){
    const payload = ref<LoginDTO>({ email: '', password: '' });
    return {
      payload,
    };
  },
  methods: {
    submitForm() {
      authService
        .login(this.payload)
        .then((response) => {
          authenticationService.login(response.data);
          this.signIn(response.data);
        })
        .catch((err) => {
          if (err.response?.status === 401) {
            console.log('Usuário ou senha inválidos');
          } 
          else if (err.response?.status === 401) {
            console.log('Usuário sem permissão');
          }
        });
    },

    signIn(data: LoginModel) {
      this.$router.push('/despesas')
    }
  },
});
</script>
<style>
.q-card {
  width: 360px;
}
</style>