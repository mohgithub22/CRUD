<template lang="pug">
app-layout
  template(#index)
    div.max-w-md.mx-auto.my-12.p-6.bg-gray-100.rounded-lg.shadow-md
      h1.text-center.text-2xl.mb-6.text-gray-800.font-semibold ویرایش مشتری
      form(@submit.prevent="submit" class="flex flex-col gap-4")
        .flex.flex-col
          label.text-gray-700.mb-1 نام:
          input(p-2 border border-gray-300 rounded focus:border-green-500 focus:outline-none v-model="form.name" type="text")
        .flex.flex-col
          label.text-gray-700.mb-1 ایمیل:
          input(p-2 border border-gray-300 rounded focus:border-green-500 focus:outline-none v-model="form.email" type="email")
        .flex.flex-col
          label.text-gray-700.mb-1 تلفن:
          input(p-2 border border-gray-300 rounded focus:border-green-500 focus:outline-none v-model="form.phone" type="text")
        button.self-center.mt-4.py-2.px-4.text-white.bg-green-500.rounded.hover.bg-green-600.transition.duration-300 به‌روزرسانی

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
