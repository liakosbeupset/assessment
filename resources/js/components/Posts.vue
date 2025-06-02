<template>
    <div class="p-6 max-w-6xl mx-auto font-sans antialiased">
        <!-- Table -->
        <div v-if="!loading && items.length > 0">
      <span class="flex items-center pb-4">
        <span class="h-px flex-1 bg-gray-300"></span>
        <span class="shrink-0 px-4 text-gray-900">All Posts</span>
        <span class="h-px flex-1 bg-gray-300"></span>
      </span>

            <div class="overflow-x-auto rounded border border-gray-300 shadow-sm">
                <table class="min-w-full divide-y-2 divide-gray-200">
                    <thead class="text-left">
                    <tr class="*:font-medium *:text-gray-900">
                        <th class="px-3 py-2 whitespace-nowrap">#</th>
                        <th class="px-3 py-2 whitespace-nowrap">Title</th>
                        <th class="px-3 py-2 whitespace-nowrap">Slug</th>
                        <th class="px-3 py-2 whitespace-nowrap">Body</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                    <tr v-for="post in items" :key="post.id" class="*:text-gray-900 *:first:font-medium">
                        <td class="px-3 py-2 whitespace-nowrap">{{ post.id }}</td>
                        <td class="px-3 py-2 whitespace-nowrap max-w-[150px] truncate">{{ post.title }}</td>
                        <td class="px-3 py-2 whitespace-nowrap max-w-[120px] truncate">{{ post.slug }}</td>
                        <td class="px-3 py-2 whitespace-nowrap max-w-[200px] truncate">{{ post.body }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Fetch Button -->
        <div v-if="!loading && items.length === 0">
            <button
                @click="importAndFetch"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-2 text-sm font-medium text-white shadow hover:bg-blue-700"
            >
                Fetch Data
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const items = ref([])
//defined loading state here so we can hide the button initially and check for posts from database.
//if this is not done then it shows the button initially until the axios call is completed
const loading = ref(true)

const fetchPosts = async () => {
    try {
        const response = await axios.get('/api/fetch-posts')
        items.value = response.data.data
    } catch (e) {
        alert('Failed to fetch posts.')
    } finally {
        //after the axios call is completed - set loading to false to show the button if needed
        loading.value = false
    }
}

const importAndFetch = async () => {
    loading.value = true
    try {
        await axios.post('/api/import-posts')
        await fetchPosts()
    } catch (e) {
        alert('Failed to import posts.')
        //if anything goes wrong - show the button again to try and import the posts again
        loading.value = false
    }
}

onMounted(() => {
    //get posts on mount
    fetchPosts()
})
</script>
