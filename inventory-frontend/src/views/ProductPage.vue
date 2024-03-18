<script setup>
import { onMounted, ref } from 'vue'
import { storeToRefs } from 'pinia'
import { useProductStore } from '@/stores/useProduct'
import { pusher } from '@/pusher'

import SortIcon from '@/components/SortIcon.vue'
import UploadProduct from '@/components/UploadProduct.vue'

const useProduct = useProductStore()
const { data, sort, fetchProduct } = useProduct
const { params } = storeToRefs(useProduct)
const message = ref(null)

onMounted(async () => {
  await fetchProduct(`${import.meta.env.VITE_API_URL}/products`)

  // Using pusher for realtime datatable update because of backend are using queue for file upload. alternative is using polling which consume resources.
  const channel = pusher.subscribe(import.meta.env.VITE_PUSHER_CHANNEL)
  channel.bind(import.meta.env.VITE_PUSHER_EVENT, async (data) => {
    message.value = data.message
    await fetchProduct(`${import.meta.env.VITE_API_URL}/products`)
  })
})
</script>

<template>
  <div>
    <!-- upload product component -->
    <UploadProduct />

    <h4 class="mt-10">Product Master List</h4>

    <!-- search input -->
    <div class="overflow-x-auto mt-1">
      <div class="mb-5 w-full flex justify-end items-center gap-2">
        <label for="search">Search:</label>
        <input
          v-model="params.search"
          type="text"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        />
      </div>

      <!-- message from pusher for live datatable update -->
      <p v-if="message">{{ message }}</p>

      <!-- Table component -->
      <table class="w-full text-sm text-left text-gray-800 border">
        <thead class="text-xs text-gray-700 uppercase bg-gray-5 bg-blue-100">
          <tr>
            <th scope="col" class="px-4 py-3"><span>No</span></th>
            <th scope="col" @click="sort('id')" class="px-4 py-3 cursor-pointer">
              <div class="flex gap-2">
                <span>Product ID</span>
                <SortIcon :active-field="params" field="id" />
              </div>
            </th>
            <th scope="col" @click="sort('type')" class="px-4 py-3 cursor-pointer">
              <div class="flex gap-2">
                <span>Types</span>
                <SortIcon :active-field="params" field="type" />
              </div>
            </th>
            <th scope="col" @click="sort('brand')" class="px-4 py-3 cursor-pointer">
              <div class="flex gap-2">
                <span>Brand</span>
                <SortIcon :active-field="params" field="brand" />
              </div>
            </th>
            <th scope="col" @click="sort('model')" class="px-4 py-3 cursor-pointer">
              <div class="flex gap-2">
                <span>Model</span>
                <SortIcon :active-field="params" field="model" />
              </div>
            </th>
            <th scope="col" @click="sort('capacity')" class="px-4 py-3 cursor-pointer">
              <div class="flex gap-2">
                <span>Capacity</span>
                <SortIcon :active-field="params" field="capacity" />
              </div>
            </th>
            <th scope="col" @click="sort('quantity')" class="px-4 py-3 cursor-pointer">
              <div class="flex gap-2">
                <span>Quantity</span>
                <SortIcon :active-field="params" field="quantity" />
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in data.products" :key="item.id">
            <td class="px-4 py-3">{{ index + 1 }}</td>
            <td class="px-4 py-3">{{ item.id }}</td>
            <td class="px-4 py-3">{{ item.type }}</td>
            <td class="px-4 py-3">{{ item.brand }}</td>
            <td class="px-4 py-3">{{ item.model }}</td>
            <td class="px-4 py-3">{{ item.capacity }}</td>
            <td class="px-4 py-3">{{ item.quantity }}</td>
          </tr>
          <tr v-if="data.error">
            <td class="px-4 py-3 text-center" colspan="7">{{ data.error }}</td>
          </tr>
          <tr v-if="data.loading">
            <td class="px-4 py-3 text-center" colspan="7">loading...</td>
          </tr>
        </tbody>
      </table>
      <!-- paginations -->
      <nav class="mt-2 flex justify-end" aria-label="Page navigation example">
        <ul class="inline-flex text-sm">
          <li v-for="(link, index) in data.paginations" :key="index">
            <button
              @click="fetchProduct(link.url)"
              aria-current="page"
              class="flex items-center justify-center px-3 h-8 border border-gray-300 hover:bg-blue-100 hover:text-blue-700"
              :class="link.active ? 'text-blue-600 bg-blue-50' : ''"
            >
              <span v-html="link.label"></span>
            </button>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>
