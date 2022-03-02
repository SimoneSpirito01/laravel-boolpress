<template>
    <div v-if="posts.length > 0">
        <h4>The Latest</h4>
        <div class="latest-posts">
            <LatestPost v-for="post in posts" :key="post.id" :post="post" />
        </div>
    </div>
</template>

<script>
import LatestPost from "../commons/LatestPost.vue";

export default {
    name: "LatestPosts",
    components: {
        LatestPost,
    },
    data() {
        return {
            posts: [],
        };
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
    },
};
</script>

<style lang="scss" scoped>
h4 {
    font-size: 22.5px;
    padding-bottom: 15px;
}
</style>
