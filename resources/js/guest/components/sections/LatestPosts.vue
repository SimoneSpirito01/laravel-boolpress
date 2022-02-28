<template>
    <div class="latest-posts">
        <h4>The Latest</h4>
        <LatestPost v-for="post in posts" :key="post.id" :post="post"/>
    </div>
</template>

<script>
import LatestPost from '../commons/LatestPost.vue'

export default {
    name: 'LatestPosts',
    components: {
        LatestPost
    },
    data() {
        return {
            posts: []
        }
    },
    created() {
        axios
            .get("/api/posts-latest")
            .then((response) => {
                this.posts = [...response.data];
            })
            .catch(function (error) {
                console.log(error);
            });
    }
}
</script>

<style lang="scss" scoped>

.latest-posts {
    h4 {
        font-size: 22.5px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f1f1f1;
    }
}

</style>