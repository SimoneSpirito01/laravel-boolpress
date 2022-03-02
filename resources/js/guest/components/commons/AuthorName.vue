<template>
    <div v-if="author">
        <router-link :to="{ name: 'author', params: { slug: author.slug } }">
            <div class="author">{{ author.username }}</div>
        </router-link>
    </div>
</template>

<script>
export default {
    name: "AuthorName",
    props: {
        author: Object,
    },
};
</script>

<style lang="scss" scoped>
a {
    text-decoration: none;
    color: initial;
    .author {
        color: var(--author-name);
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 8px;
        &:hover {
            color: #a800a0;
        }
    }
}
</style>
