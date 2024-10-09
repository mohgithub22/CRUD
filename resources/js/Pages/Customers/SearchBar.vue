<template>
        <div class="mb-4">
          <input
            type="text"
            v-model="query"
            @keydown="h"
            placeholder="جستجو..."
            class="border rounded p-2 w-full"
          />
          <button type="button" @click="h">بگرد</button>
        </div>
      </template>
      
      <script setup>
      import { ref, defineEmits } from 'vue';
      import axios from 'axios';
      import { router } from '@inertiajs/vue3';
      const emit = defineEmits(['search']);
      const query = ref('');
      
      // const search = () => {
      //   emit('search', query.value);
      // };
      const h = () => {

          router.get(route('customers.index' ,{_query : {query : query.value}})    )    
};

          
      
      
      </script>
      
      <style scoped>
      /* استایل های نوار جستجو */
      </style>
      