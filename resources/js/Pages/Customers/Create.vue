

<script >

import { useForm } from '@inertiajs/inertia-vue3'


import AppLayout from '@/Layouts/AppLayout.vue'


export default {
  components:{
    AppLayout
  },
  setup() {
    
    const form = useForm({
      name: '',
      email: '',
      phone: ''
    })

    function submit() {
      form.post('/customers')
    }

    return {
      form,
      submit
    }
  }
}
</script>
<template>
 <app-layout>
 <template #index>
  <div class="max-w-md mx-auto my-12 p-6 bg-gray-100 rounded-lg shadow-md">
    <h1 class="text-center text-2xl mb-6 text-gray-800 font-semibold">ثبت مشتری جدید</h1>
    <form @submit.prevent="submit" class="flex flex-col gap-4">
      <div class="flex flex-col">
        <input v-model="form.name" type="text" placeholder="نام مشتری" class="p-3 border border-gray-300 rounded focus:border-green-500 focus:outline-none" />
      </div>
      <div class="flex flex-col">
        <input v-model="form.email" type="email" placeholder="ایمیل مشتری" class="p-3 border border-gray-300 rounded focus:border-green-500 focus:outline-none" />
      </div>
      <div class="flex flex-col">
        <input v-model="form.phone" type="text" placeholder="تلفن مشتری" class="p-3 border border-gray-300 rounded focus:border-green-500 focus:outline-none" />
      </div>
      <button type="submit" class="mt-4 py-2 px-4 text-white bg-green-500 rounded hover:bg-green-600 transition duration-300">ثبت</button>
    </form>
  </div>
 </template>
 </app-layout>
</template>