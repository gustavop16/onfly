
<template>
  <q-page class="row justify-evenly">
   
    <q-list bordered class="rounded-borders" style="width: 100%">
      <q-item-label header>USUÁRIOS 
        <q-btn class="glossy" color="teal" label="Novo" to="/admin/novo"/>
      </q-item-label>
      
      <q-item>
        <q-item-section top>
          <q-item-label lines="1">
            <span class="text-weight-medium">Nome completo</span>
            <span class="text-grey-8"> - email</span>
          </q-item-label>
        </q-item-section>
        <q-item-section top side>
          <div class="text-grey-8 q-gutter-xs">
            <q-btn size="12px" flat dense round icon="delete" />
            <q-btn size="12px" flat dense round icon="edit" />
          </div>
        </q-item-section>
      </q-item>

      <q-separator spaced />
      
      <q-item>
        <q-item-section top>
          <q-item-label lines="1">
            <span class="text-weight-medium">Nome completo</span>
            <span class="text-grey-8"> - email</span>
          </q-item-label>
        </q-item-section>
        <q-item-section top side>
          <div class="text-grey-8 q-gutter-xs">
            <q-btn size="12px" flat dense round icon="delete" />
            <q-btn size="12px" flat dense round icon="edit" />
          </div>
        </q-item-section>
      </q-item>

    </q-list>
    
    
  </q-page>

</template>

<script lang="ts">

import { defineComponent, ref } from 'vue';

export default defineComponent({
  name: 'UserIndex',
});
</script>
<style>
.q-card {
  width: 360px;
}
</style>