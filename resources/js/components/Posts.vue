<template>
    <div class="p-6 max-w-6xl mx-auto font-sans antialiased">
        <span class="flex items-center pb-4">
          <span class="h-px flex-1 bg-gray-300"></span>

          <span class="shrink-0 px-4 text-gray-900">All Posts</span>

          <span class="h-px flex-1 bg-gray-300"></span>
        </span>
        <div class="overflow-x-auto rounded border border-gray-300 shadow-sm">
            <table class="min-w-full divide-y-2 divide-gray-200">
                <thead class="ltr:text-left rtl:text-right">
                <tr class="*:font-medium *:text-gray-900">
                    <th class="px-3 py-2 whitespace-nowrap">#</th>
                    <th class="px-3 py-2 whitespace-nowrap">Title</th>
                    <th class="px-3 py-2 whitespace-nowrap">Slug</th>
                    <th class="px-3 py-2 whitespace-nowrap">Body</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                <tr v-for="post in items" class="*:text-gray-900 *:first:font-medium">
                    <td class="px-3 py-2 whitespace-nowrap max-w-[150px] overflow-hidden text-ellipsis truncate">
                        {{ post.id }}
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap max-w-[150px] overflow-hidden text-ellipsis truncate">
                        {{ post.title }}
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap max-w-[120px] overflow-hidden text-ellipsis truncate">
                        {{ post.slug }}
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap max-w-[200px] overflow-hidden text-ellipsis truncate">
                        {{ post.body }}
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
defineProps({
    items: Array
});
</script>
