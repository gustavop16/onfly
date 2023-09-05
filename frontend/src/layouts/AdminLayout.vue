<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-toolbar-title>
          TESTE ONFLY
        </q-toolbar-title>

        <div class="q-pa-md q-gutter-sm">
          <q-btn flat color="white" label="Despesas" to="/despesas" />
          <q-btn flat color="amber"  label="Sair" @click="logout" />
        </div>
      </q-toolbar>
    </q-header>
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import authenticationService from '../shared/api/services/authentication.service';

export default defineComponent({
  name: 'AdminLayout',

  components: {

  },

  setup () {
   
    function logout() {
      authenticationService.signOut();
    }

    return { logout};

  }
});
</script>
