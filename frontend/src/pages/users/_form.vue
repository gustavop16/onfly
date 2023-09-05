
<template>
<q-page class="column items-center justify-center">
    <q-card class="create-account-card">
      <q-form>
        <q-card-section>
          <div class="text-h6">Create New Account</div>
          <div class="text-subtitle1">
            Fill out the following form to create your new account.
          </div>
        </q-card-section>
        <q-separator inset />
        <q-card-section class="column q-gutter-md">
          <q-input label="Name *"></q-input>
          <q-input label="Email *"></q-input>
          <q-input label="Password *" type="password"></q-input>
          <div class="password-criteria q-pa-sm">
            <div class="text-subtitle2 q-mb-sm">Password Criteria:</div>
            <div>
              <q-icon name="cancel" color="negative"></q-icon>
              Must be at least 12 characters long.
            </div>
            <div>
              <q-icon name="cancel" color="negative"></q-icon>
              Must contain at least one capital letter.
            </div>
            <div>
              <q-icon name="cancel" color="negative"></q-icon>
              Must contain at least one number.
            </div>
            <div>
              <q-icon name="cancel" color="negative"></q-icon>
              Must contain at least one symbol.
            </div>
          </div>
          <q-input label="Confirm Password *" type="password"></q-input>
        </q-card-section>
        <q-card-actions align="right">
          <q-btn flat>Cancel</q-btn>
          <q-btn color="primary" type="submit">Create Account</q-btn>
        </q-card-actions>
      </q-form>
    </q-card>
  </q-page>

</template>

<script lang="ts">

import { defineComponent, ref } from 'vue';

export default defineComponent({
  name: 'FormUser',
});
</script>
<style>
.q-card {
  width: 360px;
}
</style>