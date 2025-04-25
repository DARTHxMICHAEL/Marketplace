<template>
  <div>
    <button @click="showModal = true"
      class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 float-right">
      + Add Offer VUE.JS
    </button>

    <div v-if="showModal"
      class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded shadow w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <h2 class="text-lg font-semibold mb-4">Create a New Offer</h2>

        <form @submit.prevent="submitForm" enctype="multipart/form-data">
          <!-- Title -->
          <div class="mb-4">
            <label class="block font-medium text-sm text-gray-700">Title</label>
            <input v-model="form.title" type="text" class="form-input w-full" maxlength="90" required>
          </div>

          <!-- Description -->
          <div class="mb-4">
            <label class="block font-medium text-sm text-gray-700">Description</label>
            <textarea v-model="form.description" rows="4" maxlength="500"
              class="form-textarea w-full" required></textarea>
          </div>

          <!-- Price -->
          <div class="mb-4">
            <label class="block font-medium text-sm text-gray-700">Price</label>
            <input v-model="form.price" type="number" step="0.01" class="form-input w-full" required>
          </div>

          <!-- Currency -->
          <div class="mb-4">
            <label class="block font-medium text-sm text-gray-700">Currency</label>
            <select v-model="form.currency_id" class="form-select w-full">
              <option value="">-- Select Currency --</option>
              <option v-for="currency in currencies" :key="currency.id" :value="currency.id">
                {{ currency.code }}
              </option>
            </select>
          </div>

          <!-- Show Phone -->
          <div class="mb-4 flex items-center">
            <input type="checkbox" v-model="form.show_phone" class="mr-2" />
            <label class="text-sm text-gray-700">Show Phone Number</label>
          </div>

          <!-- Visible -->
          <div class="mb-4 flex items-center">
            <input type="checkbox" v-model="form.visible" class="mr-2" />
            <label class="text-sm text-gray-700">Visible</label>
          </div>

          <!-- Categories -->
          <div class="mb-4">
            <label class="block font-medium text-sm text-gray-700">Categories</label>
            <select v-model="form.categories" multiple class="form-multiselect w-full">
              <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                {{ cat.name }}
              </option>
            </select>
            <p class="mt-1 text-xs text-gray-500">Hold Ctrl or Command to select multiple</p>
          </div>

          <!-- Photos -->
          <div class="mb-4">
            <label class="block font-medium text-sm text-gray-700">Upload Photos (max 5)</label>
            <input type="file" accept="image/*" multiple @change="handlePhotoUpload" />
            <div class="flex gap-2 mt-2">
              <img v-for="(preview, index) in photoPreviews" :src="preview" :key="index"
                class="w-20 h-20 object-cover rounded shadow" />
            </div>
          </div>

          <!-- Submit -->
          <div class="text-right mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
              Save Offer
            </button>
            <button type="button" @click="showModal = false" class="ml-2 px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios'

  const showModal = ref(false)
  const currencies = ref([])
  const categories = ref([])

  const form = ref({
    title: '',
    description: '',
    price: '',
    currency_id: '',
    show_phone: false,
    visible: false,
    categories: [],
    photos: [],
  })

  const photoPreviews = ref([])

  const fetchFormData = async () => {
    const { data } = await axios.get('/api/offer-form-data')
    currencies.value = data.currencies
    categories.value = data.categories
  }

  const handlePhotoUpload = (event) => {
    const files = Array.from(event.target.files)
    form.value.photos = files
    photoPreviews.value = files.map(file => URL.createObjectURL(file))
  }

  const submitForm = async () => {
    const formData = new FormData()

    for (const key in form.value) {
      if (key === 'photos') {
        form.value.photos.forEach(photo => formData.append('photos[]', photo))
      } else if (Array.isArray(form.value[key])) {
        form.value[key].forEach(val => formData.append(`${key}[]`, val))
      } else if (key === 'show_phone' || key === 'visible') {
      // Cast booleans to 1 or 0
      formData.append(key, form.value[key] ? 1 : 0)
      } else {
        formData.append(key, form.value[key])
      }
    }

    try {
      await axios.post('/offers/store', formData)
      showModal.value = false
    } catch (err) {
      console.error(err)
      alert('There was an error saving your offer.')
    }
  }

  onMounted(fetchFormData)
</script>
