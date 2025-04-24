<template>
  <div>
    <button @click="showModal = true" 
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 float-right">
      + Add Offer VUE.JS
    </button>

    <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded shadow w-full max-w-lg">
        <h2 class="text-lg font-semibold mb-4">Add Offer</h2>
        <p class="text-sm text-gray-600">[Vue Form will go here later]</p>
        <div class="text-right mt-4">
          <button @click="showModal = false" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
const showModal = ref(false)
</script>
