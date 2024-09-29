<template>
  <div class="container">
    <h1>ویرایش مشتری</h1>
    <form @submit.prevent="submit" class="form-container">
      <div class="form-group">
        <label>نام:</label>
        <input v-model="form.name" type="text" class="input-field" />
      </div>
      <div class="form-group">
        <label>ایمیل:</label>
        <input v-model="form.email" type="email" class="input-field" />
      </div>
      <div class="form-group">
        <label>تلفن:</label>
        <input v-model="form.phone" type="text" class="input-field" />
      </div>
      <button type="submit" class="btn-submit">به‌روزرسانی</button>
    </form>
  </div>
</template>

<script setup>
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
<style scoped>
/* کانتینر اصلی */
.container {
  max-width: 600px;
  margin: 50px auto;
  padding: 20px;
  background-color: #f7f7f7;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* عنوان */
h1 {
  text-align: center;
  font-size: 1.8rem;
  margin-bottom: 20px;
  color: #333;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* استایل فرم */
.form-container {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

/* استایل گروه فرم */
.form-group {
  display: flex;
  flex-direction: column;
}

label {
  font-size: 1rem;
  margin-bottom: 5px;
  color: #555;
}

/* استایل ورودی‌ها */
.input-field {
  padding: 10px;
  font-size: 1rem;
  border: 1px solid #ddd;
  border-radius: 5px;
  transition: border-color 0.3s ease;
}

.input-field:focus {
  border-color: #4CAF50;
  outline: none;
}

/* دکمه ارسال */
.btn-submit {
  padding: 10px 20px;
  font-size: 1rem;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  align-self: center;
  margin-top: 20px;
}

.btn-submit:hover {
  background-color: #45a049;
}

/* استایل برای نمایش بهتر در دستگاه‌های موبایل */
@media (max-width: 600px) {
  .container {
    padding: 15px;
  }

  h1 {
    font-size: 1.5rem;
  }

  .btn-submit {
    font-size: 0.9rem;
  }
}
</style>
