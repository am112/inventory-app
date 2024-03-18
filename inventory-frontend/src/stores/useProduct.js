import { reactive, watch } from 'vue'
import { defineStore } from 'pinia'
import { debounce, pickBy } from 'lodash'

import axios from 'axios'

export const useProductStore = defineStore('useProduct', () => {
  const data = reactive({
    products: [],
    error: null,
    loading: false,
    paginations: null
  })

  const params = reactive({
    search: null,
    field: null,
    direction: null
  })

  const fetchProduct = async (url = null) => {
    if (url === null) {
      return
    }

    data.loading = true
    data.error = null

    try {
      const response = await axios.get(url, {
        params: pickBy(params)
      })
      data.products = response.data.data
      data.paginations = response.data.meta.links
    } catch (exception) {
      data.error = exception
    } finally {
      data.loading = false
    }
  }

  const sort = (field) => {
    params.field = field
    params.direction = params.direction === 'asc' ? 'desc' : 'asc'
    console.log(params)
  }

  watch(
    params,
    debounce(async () => {
      await fetchProduct(`${import.meta.env.VITE_API_URL}/products`)
    }, 500)
  )

  return { data, params, sort, fetchProduct }
})
