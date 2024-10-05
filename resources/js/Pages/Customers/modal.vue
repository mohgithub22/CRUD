<!-- Modal.vue -->
<template>
        <div v-if="isVisible" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
          <div class="bg-white rounded-lg p-6 w-full max-w-lg relative">
            <button @click="closeModal" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">
              &times;
            </button>
            <slot name="t"></slot>
          </div>
        </div>
      </template>
      
      <script setup>
      import { ref } from 'vue';
      
      defineProps({
        isVisible: Boolean, // وضعیت نمایش مدال
        closeModal: Function, // تابع بستن مدال
      });
      </script>
      
      <style scoped>
      /* استایل مدال */
      </style>
      