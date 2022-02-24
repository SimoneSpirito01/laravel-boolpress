<template>
    <div class="post">
        <h2>{{ post.title }}</h2>
        <div v-if="post.image" class="image">
            <img :src="`/storage/${post.image}`" :alt="post.title" />
        </div>
        <div v-if="post.category" class="category">
            <strong>Category: </strong>{{ post.category.name }}
        </div>
        <div v-if="post.tags" class="tags">
            <strong>Tags: </strong>
            <div v-for="(tag, i) in post.tags" :key="i" class="tag">{{ tag.name }}</div>
        </div>
        <div class="content">
            {{ post.content }}
        </div>
    </div>
</template>

<script>
export default {
    name: "Post",
    data() {
        return {
            post: {},
        };
    },
    created() {
        axios
            .get("/api/posts/" + this.$route.params.slug)
            .then((response) => {
                this.post = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
    },
};
</script>

<style lang="scss" scoped>
.post {
    width: 50%;

    > * {
        margin: 15px 0;
    }

    h2 {
        text-transform: uppercase;
    }
    .image {
        width: 500px;

        img {
            width: 100%;
        }
    }
    .tags {
        display: flex;

        .tag {
            margin-left: 5px;

            &:not(:last-child)::after {
                content: ',';
            }
        }
    }
}
</style>
