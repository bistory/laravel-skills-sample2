<template>
    <div class="w-full max-w-xs">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="create">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Title
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Title" v-model="title">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Body
                </label>
                <textarea class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="body" v-model="body"></textarea>
            </div>
            <div class="flex items-center justify-between">
                <button class="inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    <spinner v-show="loading" />
                    Save
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    import Spinner from './../Utils/Spinner'

    export default {
        components: {
            Spinner
        },

        data() {
            return {
                title: '',
                body: '',
                loading: false,
                error: ''
            }
        },

        methods: {
            create() {
                this.loading = true
                axios.post('/api/news', {
                    title: this.title,
                    body: this.body
                })
                    .then(response => {
                        this.loading = false
                        this.$emit('createNews')
                    })
                    .catch(this.handleError)
            },

            handleError(error) {
                this.error = error.response.data
                if(!this.errorMsg) {
                    this.errorMsg = 'An unknown error occured.'
                }
            }
        }
    }
</script>
