<template>
    <router-link :to="{ name: 'post', params: { slug: post.slug } }">
        <article class="main-post">
            <h2 class="title">{{ post.title }}</h2>
            <AuthorName :author="post.author" />
        </article>
    </router-link>
</template>

<script>
import AuthorName from "../commons/AuthorName.vue";

export default {
    name: "MainPost",
    components: {
        AuthorName,
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
    background: white;
    padding: 0 10px;
    transition: 0.3s;
    &:hover {
        background-color: #f1f1f1;
        -webkit-box-shadow: 1px 1px #3e3e3e, 2px 2px #3e3e3e, 3px 3px #3e3e3e,
            4px 4px #3e3e3e, 5px 5px #3e3e3e, 6px 6px #3e3e3e, 7px 7px #3e3e3e,
            8px 8px #3e3e3e;
        box-shadow: 1px 1px #3e3e3e, 2px 2px #3e3e3e, 3px 3px #3e3e3e,
            4px 4px #3e3e3e, 5px 5px #3e3e3e, 6px 6px #3e3e3e, 7px 7px #3e3e3e,
            8px 8px #3e3e3e;
        -webkit-transform: translateX(-8px) translateY(-8px);
        transform: translateX(-8px) translateY(-8px);
        .main-post {
            border: none;
        }
    }
    &:hover + a .main-post,
    &:hover .main-post {
        border-top: 1px solid transparent;
    }
    &:first-child .main-post {
        border-top: 1px solid transparent;
    }
    .main-post {
        border-top: 1px solid #dddddd;
        padding: 12px 0;
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
