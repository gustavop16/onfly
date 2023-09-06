
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
            v-model="payload.description" 
              type="text" 
              label="Descrição" 
              :rules="[val => !!val || 'Campo obrigatório']" 
               />  

          <q-input square filled clearable 
              v-model="payload.date" 
              type="text" 
              label="Data" 
              placeholder="DD/MM/AAAA"
              :rules="[val => !!val || 'Campo obrigatório']" 
               />  
                
          <q-input square filled clearable 
              v-model="payload.value" 
              type="text" 
              label="Valor" 
              :rules="[val => !!val || 'Campo obrigatório']" 
              />     

    
        </q-card-section>
        <q-card-actions align="right">
        
          <q-btn color="primary" type="submit">Salvar</q-btn>
        </q-card-actions>
      </q-form>
    </q-card>
  </q-page>

</template>

<script lang="ts">

import store from '../../shared/store';
import { defineComponent, onMounted, ref } from 'vue';
import { CreateExpenseDTO} from '../../shared/api/dtos';
import ExpenseService from '../../shared/api/services/expense.service';
import { ExpenseModel } from 'src/shared/api/models';
import { useRoute } from 'vue-router';
import {date} from 'quasar';

export default defineComponent({
  name: 'FormExpense',
  setup(){

    const route = useRoute();
    const expenseResponse = ref<ExpenseModel | null>(null);
    const expenseIdCurrent = ref<Number | null>(null);
    const payload = ref<CreateExpenseDTO>({ 
      description: '', 
      date: '', 
      value: ''
    });
  
    onMounted(()=>{
      if(route.params.id){
        expenseIdCurrent.value = Number(route.params.id)
        getExpense(route.params.id);
      }
    })

    const getExpense = async(expenseId)=>{
      const response = await ExpenseService.findById(expenseId);
      expenseResponse.value = response.data.data; 
      payload.value = { 
        description: expenseResponse.value.description, 
        date: date.formatDate(expenseResponse.value.date, 'DD/MM/YYYY'), 
        value: expenseResponse.value.value, 
      };
    }

    return {
      expenseResponse, 
      payload, 
      expenseIdCurrent
    }
 
  },
  
  methods: {
    submitForm() {
      if(this.expenseIdCurrent){
        this.update();
      }else{
        this.create();
      }
    },

    create() {

      const date =this.payload.date.split('/');
      const data = { 
        description: this.payload.description, 
        date: date[2]+'-'+date[1]+'-'+date[0], 
        value: this.payload.value,
        user_id: Number(store.state.user?.id)  
      };

      ExpenseService
        .create(data)
        .then(() => {
            alert('Despesa criada com sucesso');
            this.$router.push('/despesas')
          })
          .catch((err) => {
            alert ('Ocorreu um erro ao salvar os dados - '+ err);
          });
    },

    update() {

      const date =this.payload.date.split('/');
      const data = { 
        description: this.payload.description, 
        date: date[2]+'-'+date[1]+'-'+date[0], 
        value: this.payload.value, 
      };

      ExpenseService
        .update(Number(this.expenseIdCurrent), data)
        .then(() => {
          alert('Despesa alterada com sucesso');
            this.$router.push('/despesas')
          })
          .catch((err) => {
            alert('Ocorreu um erro ao salvar os dados - '+ err);
          });
    },

  }
   
});
</script>
<style>
.q-card {
  width: 360px;
}
</style>