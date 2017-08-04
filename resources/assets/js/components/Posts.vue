<template>
    <div class="col-xs-12">
        <ul>
            <li v-for="post in posts"><a href="">{{post.title}}</a></li>
        </ul>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'posts',
        data() {
            return {
                posts: []
            }
        },
        created() {
            this.fetchPosts();
        },
        methods: {
            fetchPosts() {
                axios.get('posts')
                    .then(({data}) => this.posts = data)
            }
        }
    }
</script>
