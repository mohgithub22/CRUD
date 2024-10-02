<template>
<app-layout>
<template #index>
  <div class="max-w-md mx-auto my-12 p-6 bg-gray-100 rounded-lg shadow-md">
    <h1 class="text-center text-2xl mb-6 text-gray-800 font-semibold">ویرایش مشتری</h1>
    <form @submit.prevent="submit" class="flex flex-col gap-4">
      <div class="flex flex-col">
        <label class="text-gray-700 mb-1">نام:</label>
        <input v-model="form.name" type="text" class="p-2 border border-gray-300 rounded focus:border-green-500 focus:outline-none" />
      </div>
      <div class="flex flex-col">
        <label class="text-gray-700 mb-1">ایمیل:</label>
        <input v-model="form.email" type="email" class="p-2 border border-gray-300 rounded focus:border-green-500 focus:outline-none" />
      </div>
      <div class="flex flex-col">
        <label class="text-gray-700 mb-1">تلفن:</label>
        <input v-model="form.phone" type="text" class="p-2 border border-gray-300 rounded focus:border-green-500 focus:outline-none" />
      </div>
      <button type="submit" class="self-center mt-4 py-2 px-4 text-white bg-green-500 rounded hover:bg-green-600 transition duration-300">به‌روزرسانی</button>
    </form>
  </div></template>
</app-layout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'

import { useForm } from '@inertiajs/inertia-vue3'
import { defineProps } from 'vue'

const props = defineProps({
  cus: Object,
})

const form = useForm({
  name: props.cus.name || '',
  email: props.cus.email || '',
  phone: props.cus.phone || ''
})

function submit() {
  form.put(`/customers/${props.cus.id}`)
}
</script>
