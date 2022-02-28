<template>
    <div v-if="posts.length > 0" class="main-posts">
        <div class="left">
            <h1 class="title">{{ posts[0].title }}</h1>
            <div class="author">{{ posts[0].author.username }}</div>
            <div class="image">
                <img
                    :src="`/storage/${posts[0].image}`"
                    :alt="posts[0].title"
                />
            </div>
        </div>
        <div class="right">
            <MainPost v-for="i in 4" :key="i" :post="posts[i]" />
        </div>
    </div>
</template>

<script>
import MainPost from "../commons/MainPost.vue";

export default {
    name: "MainPosts",
    components: {
        MainPost,
    },
    data() {
        return {
            posts: [],
        };
    },
    created() {
        axios
            .get("/api/posts-main")
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
.main-posts {
    display: flex;
    margin-bottom: 60px;
    .left {
        width: 65%;
        padding-right: 45px;
        transition: opacity 0.15s linear;
        cursor: pointer;
        &:hover {
            opacity: 0.7;
        }
        .title {
            font-size: 45px;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .author {
            color: var(--author-name);
            font-size: 16px;
            margin-bottom: 8px;
        }
        .image {
            img {
                width: 100%;
            }
        }
    }
    .right {
        width: 35%;
    }
}
</style>
