<script setup>
import { ref, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'



const props = defineProps({ customers: Object })

function createCustomer() {
  router.get('/customers/Create')
}
function dashbord(){
  return router.get('/dashboard')
}

function editCustomer(customer) {
  router.get(`/customers/${customer.id}/edit`)
}

function deleteCustomer(id) {
  if (confirm('آیا از حذف این مشتری اطمینان دارید؟')) {
    Inertia.delete(`/customers/${id}`)
  }
}
</script>

<template>
  <div class="container">
    <h1>لیست مشتریان</h1>
        <button class="btn-primary" @click="dashbord">حساب کاربری</button>

    <button class="btn-primary" @click="createCustomer">ثبت مشتری جدید</button>

    <table>
      <thead>
        <tr>
          <th>نام</th>
          <th>ایمیل</th>
          <th>تلفن</th>
          <th>عملیات</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="customer in customers" :key="customer.id">
          <td>{{ customer.name }}</td>
          <td>{{ customer.email }}</td>
          <td>{{ customer.phone }}</td>
          <td>
            <button class="btn-secondary" @click="editCustomer(customer)">ویرایش</button>
            <button class="btn-danger" @click="deleteCustomer(customer.id)">حذف</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped>
/* کانتینر اصلی */
.container {
  max-width: 900px;
  margin: 40px auto;
  padding: 20px;
  background-color: #f7f7f7;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* استایل عنوان */
h1 {
  text-align: center;
  font-size: 2rem;
  margin-bottom: 30px;
  color: #333;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* استایل دکمه اصلی (ثبت مشتری جدید) */
.btn-primary {
  display: block;
  margin: 0 auto 20px;
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-primary:hover {
  background-color: #45a049;
}

/* استایل جدول */
table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

th, td {
  padding: 15px;
  border-bottom: 1px solid #ddd;
  text-align: center;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: #333;
}

/* استایل هدر جدول */
thead {
  background-color: #f0f0f0;
  font-weight: bold;
}

/* استایل دکمه‌ها */
button {
  padding: 8px 15px;
  font-size: 14px;
  cursor: pointer;
  border-radius: 5px;
  border: none;
  transition: background-color 0.3s ease;
}

/* استایل دکمه ویرایش */
.btn-secondary {
  background-color: #008CBA;
  color: white;
  margin-right: 10px;
}

.btn-secondary:hover {
  background-color: #007bb5;
}

/* استایل دکمه حذف */
.btn-danger {
  background-color: #f44336;
  color: white;
}

.btn-danger:hover {
  background-color: #e53935;
}

/* تغییر رنگ برای سطرهای جدول در حالت هاور */
tbody tr:hover {
  background-color: #f1f1f1;
}

/* استایل برای نمایش بهتر در دستگاه‌های موبایل */
@media (max-width: 600px) {
  table, th, td {
    font-size: 12px;
  }

  .btn-primary {
    padding: 8px 16px;
    font-size: 14px;
  }
}
</style>
