<template>
  <div class="container">
    <h1>ثبت مشتری جدید</h1>
    <form @submit.prevent="submit" class="form">
      <div class="form-group">
        <input v-model="form.name" type="text" placeholder="نام مشتری" />
      </div>
      <div class="form-group">
        <input v-model="form.email" type="email" placeholder="ایمیل مشتری" />
      </div>
      <div class="form-group">
        <input v-model="form.phone" type="text" placeholder="تلفن مشتری" />
      </div>
      <button type="submit" class="btn-primary">ثبت</button>
    </form>
  </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3'

export default {
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
<style scoped>
.container {
  max-width: 500px;
  margin: 50px auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}

.form-group {
  margin-bottom: 15px;
}

input {
  width: 100%;
  padding: 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  transition: border-color 0.3s ease;
}

input:focus {
  border-color: #4CAF50;
  outline: none;
}

button {
  width: 100%;
  padding: 12px;
  background-color: #4CAF50;
  color: white;
  font-size: 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #45a049;
}

.form {
  display: flex;
  flex-direction: column;
}

@media (max-width: 600px) {
  .container {
    width: 100%;
    padding: 15px;
  }
}
</style>
