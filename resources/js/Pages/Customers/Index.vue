
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
import { TailwindPagination } from 'laravel-vue-pagination';

function createCustomer() {
  router.get('/customers/Create')
}
function dashbord(){
  return router.get(`/dashboard`)
}

function editCustomer(customer) {
router.get(`/customers/${customer.id}/edit`)
}

function deleteCustomer(id) {
  if (confirm('آیا از حذف این مشتری اطمینان دارید؟')) {
    Inertia.delete(`/customers/${id}`)
  }
}
 const getCustomers = (page = 1) => {
      router.get(`/customers?page=${page}`, {}, {
        replace: true,
      
      })}

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

<template lang="pug">
 app-layout
  template(#index)
    // ارتفاع 30px
    div.h-8
    div.max-w-4xl.mx-auto.p-6.bg-gray-100.rounded-lg.shadow-lg
      h1.text-3xl.font-bold.text-center.mb-8.text-gray-800 لیست مشتریان

      div.flex.justify-center.gap-4.mb-6
        button.bg-blue-500.hover.bg-blue-600.text-white.font-semibold.py-2.px-4.rounded(@click="dashbord") حساب کاربری
        button.bg-green-500.hover.bg-green-600.text-white.font-semibold.py-2.px-4.rounded(@click="createCustomer") ثبت مشتری جدید

      table.w-full.table-auto.bg-white.rounded-lg.shadow-md.overflow-hidden
        thead.bg-gray-200
          tr
            th.px-4.py-2.text-gray-600 نام
            th.px-4.py-2.text-gray-600 ایمیل
            th.px-4.py-2.text-gray-600 تلفن
            th.px-4.py-2.text-gray-600 عملیات
        tbody
          tr(v-for="customer in customers.data" :key="customer.id" class="text-center border-b hover:bg-gray-100")
            td.px-4.py-2 {{ customer?.name || "eee" }}
            td.px-4.py-2 {{ customer?.email || 'email' }}
            td.px-4.py-2 {{ customer?.phone || 'phone' }}
            td.px-4.py-2
              button.bg-blue-500.hover.bg-blue-600.text-white.font-semibold.py-1.px-3.rounded.mr-2(@click="editCustomer(customer)") ویرایش
              button.bg-red-500.hover.bg-red-600.text-white.font-semibold.py-1.px-3.rounded(@click="deleteCustomer(customer.id)") حذف

      div.flex.justify-center
        TailwindPagination(:data="customers" @pagination-change-page="getCustomers")

</template>