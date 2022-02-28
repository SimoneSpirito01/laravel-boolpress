<template>
    <article class="main-post">
        <h2 class="title">{{post.title}}</h2>
        <div class="author">{{post.author.username}}</div>
    </article>
</template>

<script>
export default {
    name: 'MainPost',
    props: {
        post: Object
    }
}
</script>

<style lang="scss" scoped>

.main-post {
    cursor: pointer;
    margin-bottom: 15px;
    border-bottom: 1px solid #dddddd;
    transition: opacity .15s linear;
    &:hover {
        opacity: 0.7;
    }
    .title {
        font-size: 32.5px;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .author {
        color: var(--author-name);
        font-size: 16px;
        margin-bottom: 8px;
    }
}

</style>