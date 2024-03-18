import { reactive } from 'vue'
import axios from 'axios'
import { useProductStore } from './useProduct'

export const useUploadProduct = () => {
  const { fetchProduct } = useProductStore

  const data = reactive({
    file: null,
    loading: false,
    error: null
  })

  const onFileChange = (event) => {
    data.file = event.target.files[0]
  }

  const submitProduct = async () => {
    data.loading = true
    data.error = false

    try {
      const formData = new FormData()
      formData.append('file', data.file)

      await axios.post(`${import.meta.env.VITE_API_URL}/products`, formData)
      data.file = null

      // for unqueue api
      await fetchProduct(`${import.meta.env.VITE_API_URL}/products`)
    } catch (error) {
      data.error = error.response.data.message
    } finally {
      data.loading = false
    }
  }

  return { data, onFileChange, submitProduct }
}
