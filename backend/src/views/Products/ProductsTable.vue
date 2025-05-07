<template>
    <div class="bg-white p-4 rounded-lg shadow animate-fade-in-dawn">
      <div class="flex justify-between border-b-2 pb-3">
        <div class="flex items-center">
          <span class="whitespace-nowrap mr-3">Per Page</span>
          <select @change="getProducts(null)" v-model="perPage"
            class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
          <!-- <span class="ml-3">Found {{ products.total }} products</span> -->
        </div>
        <div>
          <input v-model="search" @change="getProducts(null)"
            class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
            placeholder="Type to Search products">
        </div>
      </div>
  
  
      <table class="table-auto w-full">
        <thead>
          <tr >
            <TableHeaderCell @click="sortProduct" field="id" :sort-field="sortField" :sort-direction="sortDirection">ID
            </TableHeaderCell>
            <TableHeaderCell field="" :sort-field="sortField" :sort-direction="sortDirection">Image
            </TableHeaderCell>
            <TableHeaderCell @click="sortProduct" field="title" :sort-field="sortField" :sort-direction="sortDirection">
              Title</TableHeaderCell>
            <TableHeaderCell @click="sortProduct" field="price" :sort-field="sortField" :sort-direction="sortDirection">
              Price</TableHeaderCell>
            <TableHeaderCell @click="sortProduct" field="updated_at" :sort-field="sortField"
              :sort-direction="sortDirection">Last Update At</TableHeaderCell>
            <TableHeaderCell @click="sortProduct" field="action">Action</TableHeaderCell>
          </tr>
        </thead>
        <tbody v-if="products.loading">
          <tr>
            <td colspan="6">
              <Spinner class="my-6" />
            </td>
          </tr>
        </tbody>
        <tbody v-else>
          <tr v-for="(product,index) of products.data" class="animate-fade-in-dawn" :style="{'animation-delay':`${index*0.1}s`}">
            <td class="border-b p-2 ">{{ product.id }}</td>
            <td class="border-b p-2 ">
              <img class="w-16" :src="product.image_url" :alt="product.title">
            </td>
            <td class="border-b p-2 max-w-[200px] whitespace-nowrap overflow-hidden text-ellipsis">
              {{ product.title }}
            </td>
            <td class="border-b p-2">
              {{ product.price }}
            </td>
            <td class="border-b p-2 ">
              {{ product.updated_at }}
            </td>
            <td class="border-b p-2 ">
              <div class="flex">
              <button
              @click="editProduct(product)"
              class="flex w-full items-center rounded-md px-2  text-sm">
                <PencilIcon class=" h-5 w-5 text-violet-400 hover:text-violet-500" aria-hidden="true" />
              </button>
              <button 
              @click="deleteProduct(product)"
              class="flex w-full items-center rounded-md px-2  text-sm">
                <TrashIcon  class="h-5 w-5 text-red-700 hover:text-red-600" aria-hidden="true" />
              </button>
            </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div v-if="!products.loading" class="flex justify-between items-center mt-5">
        <span>
          Showing from {{ products.from }} to {{ products.to }}
        </span>
        <nav v-if="products.total > products.limit"
          class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px" aria-label="Pagination">
          <a v-for="(link, i) of products.links" :key="i" :disabled="!link.url" href="#"
            @click.prevent="getFroPage($event, link)" aria-current="page"
            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap" :class="[
              link.active
                ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                : 'bg-white border-gray-300 text-indigo-500 hover:bg-gray-50',
              i == 0 ? 'rounded-l-md' : '',
              i == products.links.length - 1 ? 'rounded-r-md' : '',
              !link.url ? 'bg-gray-100 text-gray-700' : ''
            ]" v-html="link.label">
          </a>
        </nav>
      </div>
    </div>
  </template>
  
  <script setup>
  import Spinner from '@/components/core/Spinner.vue';
  import TableHeaderCell from '@/components/core/Table/TableHeaderCell.vue';
  import store from '@/store/index.js';
  import { PRODUCTS_PER_PAGE } from '@/constant';
  import { computed, onMounted, ref } from "vue";
  import { TrashIcon, PencilIcon} from '@heroicons/vue/20/solid'
  const emit = defineEmits(['clickEdit'])
  const perPage = ref(PRODUCTS_PER_PAGE)
  const search = ref('')
  const products = computed(() => store.state.products)
  const sortField = ref('updated_at')
  const sortDirection = ref('desc')
  onMounted(() => {
    getProducts();
  })
  
  function getProducts(url = null) {
    store.dispatch('getProducts', {
      url,
      sortField: sortField.value,
      sortDirection: sortDirection.value,
      search: search.value,
      perPage: perPage.value,
    })
  }
  
  function getFroPage(ev, link) {
    if (!link.url || link.active) {
      return;
    }
    getProducts(link.url);
  }
  function sortProduct(field) {
    if (sortField.value === field) {
      if (sortDirection.value === 'asc') {
        sortDirection.value = 'desc';
      } else {
        sortDirection.value = 'asc';
      }
    } else {
      sortField.value = field;
      sortDirection.value = 'asc';
    }
    getProducts()
  }
  function editProduct(product){
    emit('clickEdit',product)
  }
  function deleteProduct(product) {
    if (!confirm('Are sure you want delete the product?')) {
      return;
    }
    store.dispatch('deleteProduct', product.id)
      .then(res => {
        store.dispatch('getProducts');
      })
  }
  </script>
  
  <style></style>