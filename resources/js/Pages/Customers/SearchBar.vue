<template>
        <div class="mb-4">
          <input
            type="text"
            v-model="query"
            
            placeholder="جستجو..."
            class="border rounded p-2 w-full"
          />
          <button @click="h">بگرد</button>
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
        alert("Button clicked!"); // تست فراخوانی تابع

         axios.get('/customers', { params: { query: query.value } })
        .then(response => {
            // می‌توانید نتیجه را در اینجا پردازش کنید
            
        })
        .catch(error => {
            // مدیریت خطا
            console.error("Error fetching customers:", error);
        });
};

          
      
      
      </script>
      
      <style scoped>
      /* استایل های نوار جستجو */
      </style>
      