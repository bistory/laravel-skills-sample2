<template>
    <guest-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                News
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="mb-4">
                    <button @click="toggleCreateForm" class="inline-flex items-center mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        Create a news
                    </button>

                    <create v-show="showCreateForm" @createNews="getNews" />
                </div>

                <news-item v-for="(newsItem, key) in news"
                    :key="key"
                    :id="newsItem.id"
                    :title="newsItem.title"
                    :body="newsItem.body"
                    :date="newsItem.created_at"
                    @deleteNews="deleteNews(newsItem.id, key)" />
            </div>
        </div>
    </guest-layout>
</template>

<script>
    import GuestLayout from './../../Layouts/GuestLayout'
    import JetApplicationLogo from './../../Jetstream/ApplicationLogo'
    import NewsItem from './../News/Item'
    import Create from './../News/Create'

    export default {
        components: {
            GuestLayout,
            JetApplicationLogo,
            NewsItem,
            Create
        },
        /*
            * The component's data.
            */
        data() {
            return {
                news: [],
                loading: true,
                saveLoading: false,
                showCreateForm: false,
                error: ''
            }
        },

        mounted() {
            this.prepareComponent()
        },

        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getNews()
            },

            toggleCreateForm() {
                this.showCreateForm = !this.showCreateForm
            },

            getNews() {
                axios.get('/api/news')
                    .then(response => {
                        this.news = response.data.data
                        this.loading = false
                        this.showCreateForm = false
                    })
                    .catch(this.handleError)
            },

            deleteNews(newsId, key) {
                axios.delete('/api/news/' + newsId)
                    .then(response => {
                        this.$delete(this.news, key)
                        this.loading = false
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
