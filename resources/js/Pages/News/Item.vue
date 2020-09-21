<template>
    <div class="max-w rounded overflow-hidden shadow-lg bg-white mb-4">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">
                {{title}}
            </div>
            <p>{{date}}</p>

            <p class="text-gray-700 text-base">
                {{body}}
            </p>

            <button @click="getComments" v-show="!commentsLoaded" class="inline-flex items-center mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                <spinner v-show="loadingComments" />
                Show comments
            </button>
            <button class="inline-flex items-center mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full" @click="$emit('deleteNews')">Delete news</button>

            <div class="divide-y-2 divide-gray-500 divide-dashed">
                <comment v-for="(comment, key) in comments" :key="key" :id="comment.id" :body="comment.body" @deleteComment="deleteComment(comment.id, key)" />
            </div>
            <p v-show="commentsLoaded && comments.length == 0">There is no comment in this news.</p>
        </div>
    </div>
</template>

<script>
    import Comment from './../News/Comment'
    import Spinner from './../Utils/Spinner'

    export default {
        components: {
            Comment,
            Spinner
        },

        props: {
            id: {
                type: Number,
            },
            title: {
                type: String,
            },
            body: {
                type: String,
            },
            date: {
                type: String,
            }
        },

        data() {
            return {
                comments: [],
                loading: true,
                loadingComments: false,
                commentsLoaded: false,
                error: ''
            }
        },

        methods: {
            update() {
                axios.put('/api/news/' + this.id + '/comments', {
                    title: this.title,
                    body: this.body
                })
                    .then(response => {
                        this.comments = response.data.data
                        this.loading = false
                    })
                    .catch(this.handleError)
            },

            delete() {
                axios.delete('/api/news/' + this.id)
                    .then(response => {
                        this.loading = false
                    })
                    .catch(this.handleError)
            },

            getComments() {
                this.loadingComments = true
                axios.get('/api/news/' + this.id + '/comments')
                    .then(response => {
                        this.comments = response.data.data
                        this.loadingComments = false
                        this.commentsLoaded = true
                    })
                    .catch(this.handleError)
            },

            deleteComment(commentId, key) {
                axios.delete('/api/news/' + this.id + '/comments/' + commentId)
                    .then(response => {
                        this.$delete(this.comments, key)
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
