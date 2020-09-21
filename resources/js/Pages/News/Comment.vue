<template>
    <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
            <p class="mt-1 text-sm text-gray-600">
                {{body}}
            </p>
            <p>{{date}}</p>
            <button class="inline-flex items-center mt-4 mb-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full" @click="$emit('deleteComment')">Delete comment</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            body: {
                type: String,
            },
            date: {
                type: String,
            }
        }
    }
</script>
