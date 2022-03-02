<template>
    <router-link :to="{ name: 'post', params: { slug: post.slug } }">
        <article class="main-post">
            <h2 class="title">{{ post.title }}</h2>
            <AuthorName :author="post.author"/>
        </article>
    </router-link>
</template>

<script>
import AuthorName from "../commons/AuthorName.vue";

export default {
    name: "MainPost",
    components: {
        AuthorName
    },
    props: {
        post: Object,
    },
};
</script>

<style lang="scss" scoped>
a {
    text-decoration: none;
    color: initial;
    display: inline-block;
    &:hover {
        animation: shadow-pop-br 0.2s both;
        padding: 10px 20px;
        .main-post {
            border: none;
        }
    }
    .main-post {
        margin-bottom: 15px;
        border-bottom: 1px solid #dddddd;
        transition: opacity 0.15s linear;
        .title {
            font-size: 29.5px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .author {
            color: var(--author-name);
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
        }
    }
}
.right:hover .main-post:not(:hover) {
    opacity: 0.8;
}
</style>
