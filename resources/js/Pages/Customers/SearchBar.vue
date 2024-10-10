

<script setup>
import { ref, defineEmits } from 'vue';
import axios from 'axios';
import { router } from '@inertiajs/vue3';
const emit = defineEmits(['search']);
const query = ref('');
      
      // const search = () => {
      //   emit('search', query.value);
      // };
      const h = () => {
        

          router.get(route('customers.index' ,{_query : {query : query.value}})    )    
};
</script>
  <template lang="pug">
    div.flex.items-center.justify-center
      .mb-4
        input(
          type="text"
          v-model="query"
          placeholder="جستجو..."
          class="border border-gray-300 rounded-lg p-3 w-2/3 focus:outline-none focus:ring-2 focus:ring-blue-400"  
        )
        button(
          type="button"
          @click="h"
          class="ml-2 bg-blue-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-600 transition duration-200"
        ) بگرد
  </template>
  
          

      
    
      
      