<template>
    <div class="main-posts">
        <router-link
            class="left"
            :to="{ name: 'post', params: { slug: posts[0].slug } }"
        >
            <h1 class="title">{{ posts[0].title }}</h1>
            <AuthorName :author="posts[0].author" />
            <div class="image">
                <img
                    :src="`/storage/${posts[0].image}`"
                    :alt="posts[0].title"
                />
            </div>
        </router-link>
        <div class="right">
            <MainPost v-for="i in 4" :key="i" :post="posts[i]" />
        </div>
    </div>
</template>

<script>
import MainPost from "../commons/MainPost.vue";
import AuthorName from "../commons/AuthorName.vue";
import dataShared from '../../share/dataShared';

export default {
    name: "MainPosts",
    components: {
        MainPost,
        AuthorName,
    },
    props: {
        posts: Array
    },
    data() {
        return {
            dataShared,
        };
    },
};
</script>

<style lang="scss" scoped>
.main-posts {
    display: flex;
    margin-bottom: 100px;
    .left {
        width: 65%;
        padding-right: 45px;
        text-decoration: none;
        color: initial;
        .title {
            font-size: 45px;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .image {
            width: 100%;
            img {
                width: 100%;
                display: block;
            }
        }
    }
    .right {
        width: 35%;
    }
}
</style>
