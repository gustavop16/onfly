<template>
  <q-page class="row justify-evenly">

    
   
    <q-list bordered class="rounded-borders" style="width: 100%">
      <q-item-label header>DESPESAS 
        <q-btn class="glossy" color="teal" label="Novo" to="/despesas/novo"/>
      </q-item-label>

      <q-item v-for="item in expenses" :key="item.id">
        <q-item-section top>
          <q-item-label lines="1">
            <span class="text-weight-medium">{{ item.date }}</span>
          </q-item-label>
          <q-item-label lines="1">{{ item.description }} - {{ item.value }}</q-item-label>
        </q-item-section>
        <q-item-section top side>
          <div class="text-grey-8 q-gutter-xs">
            <q-btn size="12px" flat dense round icon="delete" @click="deleteExpense(item.id)" />
            <q-btn size="12px" flat dense round icon="edit" @click="edit(item.id)" />
          </div>
        </q-item-section>
      </q-item>
      
    </q-list>
    
    
  </q-page>

</template>

<script lang="ts">

import { ExpenseModel } from 'src/shared/api/models';
import store from 'src/shared/store';
import { defineComponent, ref } from 'vue';
import ExpenseService from '../../shared/api/services/expense.service';

export default defineComponent({
  name: 'ExpenseIndex',
  setup(){

    const expenses = ref<ExpenseModel[]>([]);

    async function loadData() {
      const userId =  Number(store.state.user?.id);
      const expenseResponse = await ExpenseService.list(userId);
      expenses.value = expenseResponse.data.data;
    }

    function deleteExpense(expenseId: number) {
     
      ExpenseService
        .delete(expenseId)
        .then(() => {
          alert('Despesa excluída com sucesso');
          loadData();
        })
        .catch((err) => {
          alert('Ocorreu um erro ao salvar os dados - '+ err);
        });
    }
    loadData();

    return{ expenses, deleteExpense }


  },
  methods: {
    edit(expenseId: number) {
      this.$router.push('/despesas/edit/'+expenseId);
    }
  },
  
});
</script>
<style>
.q-card {
  width: 360px;
}
</style>