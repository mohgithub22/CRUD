
<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'

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

defineProps({
    title: String,
    customers:Object
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(router('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(router('logout'));
};
const changePage = (page) => {
  router.get(`/customers?page=${page}`);
};
</script>

<template>
  <app-layout>
  <template #index>
  <!-- ارتفاع 30px --><div class="h-8"></div>
  <div class="max-w-4xl mx-auto p-6 bg-gray-100 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">لیست مشتریان</h1>

    <div class="flex justify-center gap-4 mb-6">
      <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded" @click="dashbord">حساب کاربری</button>
      <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded" @click="createCustomer">ثبت مشتری جدید</button>
    </div>

    <table class="w-full table-auto bg-white rounded-lg shadow-md overflow-hidden">
      <thead class="bg-gray-200">
        <tr>
          <th class="px-4 py-2 text-gray-600">نام</th>
          <th class="px-4 py-2 text-gray-600">ایمیل</th>
          <th class="px-4 py-2 text-gray-600">تلفن</th>
          <th class="px-4 py-2 text-gray-600">عملیات</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="customer in customers.data" :key="customer.id " class="text-center border-b hover:bg-gray-100">
          <td class="px-4 py-2">{{ customer.name }}</td>
          <td class="px-4 py-2">{{ customer.email }}</td>
          <td class="px-4 py-2">{{ customer.phone }}</td>
          <td class="px-4 py-2">
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded mr-2" @click="editCustomer(customer)">ویرایش</button>
            <button class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded" @click="deleteCustomer(customer.id)">حذف</button>
          </td>
        </tr>
      </tbody>
    </table>
<div class="flex justify-center mt-4">
          <button v-if="customers.current_page > 1" @click="changePage(customers.current_page - 1)">قبلی</button>
          <button v-if="customers.current_page < customers.last_page" @click="changePage(customers.current_page + 1)">بعدی</button>
        </div>
  </div></template>
  </app-layout>
</template>