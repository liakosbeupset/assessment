<template>
    <div class="p-6 max-w-6xl mx-auto font-sans antialiased">
        <!-- Search Input -->
        <div v-if="!loading" class="mb-4">
            <input v-model="sq" @input="searchAndFetch" type="text" placeholder="Search (title & slug)..." class="w-full px-4 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring focus:ring-blue-300"/>
        </div>

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
                    <tr v-for="post in items" :key="post.id" @click="openModal(post)" class="*:text-gray-900 *:first:font-medium cursor-pointer">
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
        <div v-if="!loading && !dbHasPosts">
            <button
                @click="importAndFetch"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-2 text-sm font-medium text-white shadow hover:bg-blue-700"
            >
                Fetch Data
            </button>
        </div>

        <!-- No results -->
        <div v-if="!loading && dbHasPosts && items.length === 0">
            <p>Nothing found. Please try something else.</p>
        </div>

        <!-- Modal -->
        <div v-if="showModal" @click.self="closeModal" class="fixed inset-0 z-50 flex items-center justify-center bg-transparent">
            <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6">
                <h2 class="text-xl font-bold mb-4">{{ activePost?.title }}</h2>
                <p class="text-gray-700 whitespace-pre-line">{{ activePost?.body }}</p>
                <div class="mt-6 text-right">
                    <button @click="closeModal" class="inline-flex items-center justify-center rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import debounce from 'lodash.debounce'

const items = ref([])
//defined loading state here so we can hide the button initially and check for posts from database.
//if this is not done then it shows the button initially until the axios call is completed
const loading = ref(true)
const sq = ref('')
//we need to set a variable to check if db has any post because after search if we have 0 items it shows the btn to fetch data
const dbHasPosts = ref(false)
//add modal so we can actually see the whole body of an active post
const showModal = ref(false)
const activePost = ref(null)

const fetchPosts = async () => {
    try {
        //add parameters for search
        const response = await axios.get('/api/fetch-posts', {
            params: { search: sq.value }
        })
        items.value = response.data.data

        //this will run only when we dont have any search query
        if (!sq.value) {
            dbHasPosts.value = items.value.length > 0
        }
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

//debounce fetchPosts to give user the time to type whatever he wants
const searchAndFetch = debounce(fetchPosts, 300)

//activate post first and show model afterwards to avoid flashing with empty modal
const openModal = (post) => {
    activePost.value = post
    showModal.value = true
}

//close modal first and deactivate post afterwards to avoid showing blank modal briefly before closing
const closeModal = () => {
    showModal.value = false
    activePost.value = null
}

onMounted(() => {
    //get posts on mount
    fetchPosts()
})
</script>
