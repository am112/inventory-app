<script setup>
// import { useProductStore } from '@/stores/useProduct'
import { useUploadProduct } from '@/stores/useUploadProduct'

const useProduct = useUploadProduct()
const { onFileChange, submitProduct, data } = useProduct
</script>
<template>
  <div>
    <div class="flex gap-3">
      <div>
        <input
          class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50focus:outline-none"
          type="file"
          name="productFile"
          id="productFile"
          @change="onFileChange"
          accept="csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
        />
      </div>
      <div>
        <button
          type="button"
          class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
          @click.prevent="submitProduct"
          :disabled="data.loading"
        >
          Upload
        </button>
      </div>
    </div>
    <p v-if="data.loading">loading...</p>
    <p v-if="data.error">{{ data.error }}</p>
  </div>
</template>
