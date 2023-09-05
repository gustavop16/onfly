
<template>
<q-page class="column items-center justify-center">
    <q-card class="create-account-card">
      <q-form @submit.prevent="submitForm">
        <q-card-section>
          <div class="text-h6">Nova despesa</div>
        </q-card-section>
        <q-separator inset />
        <q-card-section class="column q-gutter-md">
          
          <q-input square filled clearable 
              v-model="description" 
              type="text" 
              label="Descrição" 
              :rules="[val => !!val || 'Campo obrigatório']" 
              :value = "payload.description"
              @update:modelValue="event => {
                  payload.description = event;
                }" />

          <q-input square filled clearable 
              v-model="date" 
              type="text" 
              label="Data" 
              :rules="[val => !!val || 'Campo obrigatório']" 
              :value = "payload.date"
              @update:modelValue="event => {
                  payload.date = date;
                }" />  
                
          <q-input square filled clearable 
              v-model="value" 
              type="text" 
              label="Valor" 
              :rules="[val => !!val || 'Campo obrigatório']" 
              :value = "payload.value"
              @update:modelValue="event => {
                  payload.value = event;
                }" />     

    
        </q-card-section>
        <q-card-actions align="right">
        
          <q-btn color="primary" type="submit">Cadastrar</q-btn>
        </q-card-actions>
      </q-form>
    </q-card>
  </q-page>

</template>

<script lang="ts">

import store from '../../shared/store';
import { defineComponent, ref } from 'vue';
import { CreateExpenseDTO} from '../../shared/api/dtos';
import ExpenseService from '../../shared/api/services/expense.service';

    

export default defineComponent({
  name: 'FormExpense',
  setup(){
    const payload = ref<CreateExpenseDTO>({ description: '', date: '0000-00-00', value: '', user_id: Number(store.state.user?.id) });
    return {
      payload,
    };
  },
  methods: {
    submitForm() {

      ExpenseService
        .create(this.payload)
        .then(() => {
            console.log({ title: 'despesa criada com sucesso' });
            this.$router.push('/despesas')
          })
          .catch(() => {
            console.log ('Ocorreu um erro ao salvar os dados');
          });
    },

    async getExpense(expenseId: number) {
  
      const expense = await ExpenseService.findById(expenseId);
   }


  },
  data(){
    console.log(this.$route.params.id)
    return {
      id: this.$route.params.id 
    }
  },
  
  
});
</script>
<style>
.q-card {
  width: 360px;
}
</style>