<template>
        <div class="mb-4">
          <input
            type="text"
            v-model="query"
            @keydown="h"
            placeholder="جستجو..."
            class="border rounded p-2 w-full"
            @input="search"
          />
        </div>
      </template>
      
      <script setup>
      import { ref, defineEmits } from 'vue';
      
      const emit = defineEmits(['search']);
      const query = ref('');
      
      const search = () => {
        emit('search', query.value);
      };
      const h = (event)=>{
          if(event.key === 'Backspace'){
            search()
          }
      }
      </script>
      
      <style scoped>
      /* استایل های نوار جستجو */
      </style>
      