<template>
  <q-page class="row items-center justify-evenly">
   
    <div class="column">
      <div class="row">
        <h5 class="text-h5 text-white q-my-md">Register</h5>
      </div>
      <div class="row">
        <q-card square bordered class="q-pa-lg shadow-1">
          <q-card-section>
            <q-form class="q-gutter-md">
              <q-input square filled clearable v-model="nome" type="text" label="nome" />
              <q-input square filled clearable v-model="email" type="email" label="email" />
              <q-input square filled clearable v-model="telefone" type="text" label="telefone" />
              <q-input square filled clearable v-model="password" type="password" label="password" />
            </q-form>
          </q-card-section>
          <q-card-actions class="q-px-md">
            <q-btn unelevated color="light-green-7" size="lg" class="full-width" label="Login" />
          </q-card-actions>
        </q-card>
      </div>
    </div>
    
  </q-page>
</template>

<script lang="ts">

import { defineComponent, ref } from 'vue';

export default defineComponent({
  name: 'PageRegister',
});
</script>
<style>
.q-card {
  width: 100%;
}
</style>