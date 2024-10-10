
<script setup>
import { ref } from 'vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import {TailwindPagination} from  'laravel-vue-pagination';
import axios from 'axios';
import { route } from 'ziggy-js';
import SearchBar from './SearchBar.vue'; // ایمپورت کامپوننت نوار جستجو
import Cookies from 'js-cookie';
import modal from './modal.vue';

function createCustomer() {
  axios.get(`/api/customers/Create`).then((response) => {

  })
}
function dashbord(){
  return router.get(`/dashboard`)
}
const newCustomer = ref({ name: '', email: '', phone: '' }); // اطلاعات مشتری جدید
const edit = ref({ name: '', email: '', phone: '' ,id:'' }); // اطلاعات مشتری جدید
const errors = ref({})
// تابع برای ثبت مشتری جدید
const submitNewCustomer = () => {
  
    axios.post('/api/customers', newCustomer.value).then((response) => {
      getCustomers(); // به‌روزرسانی لیست مشتریان
      isNewCustomerFormVisible.value = false; // پنهان کردن فرم
      newCustomer.value = { name: '', email: '', phone: '' };
      customers.value.data.push(response.data.Allcustomers) // بازنشانی فرم
    })
    .catch((error)=>{
      if(error.response && error.response.data.errors){
        errors.value = error.response.data.errors

      }else{
        console.error(error)
      }
    });
  }




function editCustomer(customer) {
router.get(`/customers/${customer.id}/edit`)
}
const isNewCustomerFormVisible = ref(false); // وضعیت نمایش فرم ثبت مشتری جدید
const isNewCustomereditFormVisible =ref(false);
const users = ref({
    "data": [], // لیست داده‌ها به‌صورت خالی
    "meta": {
        current_page: 1, // صفحه فعلی
        last_page: 1, // آخرین صفحه
        per_page: 10, // تعداد موارد در هر صفحه
        total: 0 // تعداد کل موارد
    }
})

const editerrors = ref({})
function truecreatecustomer(){
  isNewCustomerFormVisible.value =true;
}
function trueeditcustomer(customer){
  edit.value.name = customer.name
  edit.value.email = customer.email
  edit.value.phone = customer.phone
  edit.value.id = customer.id
  isNewCustomereditFormVisible.value =true;
}
// const token = Cookies.get('token');
function submitEditCustomer(){
  console.log(usePage().props.auth.token); // بررسی اینکه توکن به درستی دریافت شده

 axios.put(`/api/customers/${edit.value.id}` ,edit.value, { 
  headers:{
    Authorization: usePage().props.auth.token

  },
   withCredentials: true

 }).then((response) => {
  let updatedCustomer = response.data.Allcustomers
  const index = customers.value.data.findIndex((customer) => customer.id === updatedCustomer.id);
  customers.value.data[index]=updatedCustomer; 
  isNewCustomereditFormVisible.value =false;

  })    .catch((error)=>{
      if(error.response && error.response.data.errors){
        editerrors.value = error.response.data.errors
        console.log(edit.value.id);

      }else{
        console.error(error)
      }
    });
}



const closeCreateCustomer = () => {
  isNewCustomerFormVisible.value = false;
};
const closeEditCustomer = () => {
  isNewCustomereditFormVisible.value = false;
};
function deleteCustomer(id) {
  if (confirm('آیا از حذف این مشتری اطمینان دارید؟')) {
    axios.delete(`/customers/${id}`).then((response)=>{
          customers.value = response.data.allcustomers
    })
  }
};
 const getCustomers = (page = 1) => {
            axios.get(`/api/customers?page=${page}`).then((response)=>{
            users.value = response.data;

            });
    }
const props = defineProps({
    title: String,
    customers:Array,
    auth: Object, // اضافه کردن auth به عنوان prop

    // Allcustomers:Array
    
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(router('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};
const customers = ref(props.customers || []); // اگر props.customers موجود نیست، یک آرایه خالی می‌سازید.
const filteredCustomers = ref(customers.value); // تعریف متغیر برای مشتریان فیلترشده
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
    SearchBar() <!-- استفاده از نوار جستجو -->

    div.h-8
    div.max-w-4xl.mx-auto.p-6.bg-gray-100.rounded-lg.shadow-lg
      h1.text-3xl.font-bold.text-center.mb-8.text-gray-800 لیست مشتریان

      div.flex.justify-center.gap-4.mb-6
        button.bg-blue-500.hover.bg-blue-600.text-white.font-semibold.py-2.px-4.rounded(@click="dashbord") حساب کاربری
        button.bg-green-500.hover.bg-green-600.text-white.font-semibold.py-2.px-4.rounded(@click="truecreatecustomer") ثبت مشتری جدید
      modal(:isVisible='isNewCustomerFormVisible' :closeModal='closeCreateCustomer')
        template(#t)
         h3.text-lg.font-bold.mb-4 ثبت مشتری جدید
         input(type="text" placeholder="نام" v-model="newCustomer.name" class="border rounded p-2 w-full mb-2")
         div.text-red-500(v-if="errors.name") {{ errors.name[0] }}
         input(type="email" placeholder="ایمیل" v-model="newCustomer.email" class="border rounded p-2 w-full mb-2")
         div.text-red-500(v-if="errors.email") {{ errors.email[0] }} 
         input(type="text" placeholder="تلفن" v-model="newCustomer.phone" class="border rounded p-2 w-full mb-2")
         div.text-red-500(v-if="errors.phone") {{ errors.phone[0] }} 
         button.bg-green-500.hover.bg-green-600.text-white.font-semibold.py-2.px-4.rounded(@click="submitNewCustomer") ثبت
         
       
      modal(:isVisible='isNewCustomereditFormVisible' :closeModal='closeEditCustomer')
        template(#t)
         h3.text-lg.font-bold.mb-4 ویرایش مشتری
         input(type="text" placeholder="نام" v-model="edit.name" class="border rounded p-2 w-full mb-2")
         div.text-red-500(v-if="editerrors.name") {{ editerrors.name[0] }} 
         input(type="email" placeholder="ایمیل" v-model="edit.email" class="border rounded p-2 w-full mb-2")
         div.text-red-500(v-if="editerrors.email") {{ editerrors.email[0] }} 
         input(type="text" placeholder="تلفن" v-model="edit.phone" class="border rounded p-2 w-full mb-2")
         div.text-red-500(v-if="editerrors.phone") {{ editerrors.phone[0] }} نمایش خطای فیلد نام
         button.bg-green-500.hover.bg-green-600.text-white.font-semibold.py-2.px-4.rounded(@click="submitEditCustomer") ثبت

      table.w-full.table-auto.bg-white.rounded-lg.shadow-md.overflow-hidden
        thead.bg-gray-200
          tr
            th.px-4.py-2.text-gray-600 نام
            th.px-4.py-2.text-gray-600 ایمیل
            th.px-4.py-2.text-gray-600 تلفن
            th.px-4.py-2.text-gray-600 عملیات
        tbody
          tr( v-for="customer in  customers.data" :key="customer?.id" class="text-center border-b hover.bg-gray-100")
            td.px-4.py-2 {{ customer?.name || "eee" }}
            td.px-4.py-2 {{ customer?.email || 'email' }}
            td.px-4.py-2 {{ customer?.phone || 'phone' }}
            button.bg-blue-500.hover.bg-blue-600.text-white.font-semibold.py-1.px-3.rounded.mr-2(@click="trueeditcustomer(customer)") ویرایش
            button.bg-red-500.hover.bg-red-600.text-white.font-semibold.py-1.px-3.rounded(@click="deleteCustomer(customer.id)") حذف

      div.flex.justify-center
        TailwindPagination(:data="customers" @pagination-change-page="changePage")

</template>

 