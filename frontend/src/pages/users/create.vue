
<template>
<q-page class="column items-center justify-center">
    <q-card class="create-account-card">
      <q-form @submit="submitForm">
        <q-card-section>
          <div class="text-h6">Novo usuário</div>

        </q-card-section>
        <q-separator inset />
        <q-card-section class="column q-gutter-md">
          <q-input  filled v-model="name" 
            label="Name *" 
            name="name" 
            type="text" 
            :rules="[val => !!val || 'Campo obrigatório']" 
            :value = "payload.name"
            @update:modelValue="event => {
              payload.name = event;
            }"></q-input>

          <q-input filled v-model="email"  
          label="Email *" 
          name="email" 
          type="email"
          :rules="[val => !!val || 'Campo obrigatório']" 
          :value = "payload.email"
          @update:modelValue="event => {
              payload.email = event;
            }"></q-input>

          <q-input filled v-model="password" 
          label="Password *" 
          name="password" type="password"
          :rules="[val => !!val || 'Campo obrigatório']" 
          :value = "payload.password"
          @update:modelValue="event => {
              payload.password = event;
            }"></q-input>

          <q-input filled v-model="confirm_password"  label="Confirm Password *" type="password"></q-input>
        </q-card-section>
        <q-card-actions align="right">
          <q-btn color="primary" type="submit">Cadastrar</q-btn>
        </q-card-actions>
      </q-form>
    </q-card>
  </q-page>

</template>

<script lang="ts">

import { CreateUserDTO } from 'src/shared/api/dtos';
import { defineComponent, ref } from 'vue';

export default defineComponent({
  name: 'UserIndex',
  methods: {
    submitForm() {
      console.log(this.payload)
      
      /*
      categoriesService
          .create(data)
          .then(() => {
            formLoading.value = false;
            closeModal();
            refresh();

            AlertModal.success({ title: 'Categoria criada com sucesso' });
          })
          .catch(() => {
            formErrorMsg.value = 'Ocorreu um erro ao salvar os dados';
            formLoading.value = false;
          });
          */


    },
  },
  data() {
    const payload = ref<CreateUserDTO>({
      name:  '',
      email: '',
      password: '',
    });

    return { payload };
  },
});
</script>

<style>
.q-card {
  width: 60%;
}
</style>