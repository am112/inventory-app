<script setup>
const props = defineProps({
  activeField: Object,
  field: String
})

const { activeField, field } = props
</script>

<template>
  <svg
    v-show="activeField.field === field && activeField.direction == 'desc'"
    class="w-4 h-4 text-gray-800 dark:text-white"
    aria-hidden="true"
    xmlns="http://www.w3.org/2000/svg"
    width="24"
    height="24"
    fill="none"
    viewBox="0 0 24 24"
  >
    <path
      stroke="currentColor"
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="m19 9-7 7-7-7"
    />
  </svg>
  <svg
    v-show="activeField.field === field && activeField.direction == 'asc'"
    class="w-4 h-4 text-gray-800 dark:text-white"
    aria-hidden="true"
    xmlns="http://www.w3.org/2000/svg"
    width="24"
    height="24"
    fill="none"
    viewBox="0 0 24 24"
  >
    <path
      stroke="currentColor"
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="m5 15 7-7 7 7"
    />
  </svg>
</template>
