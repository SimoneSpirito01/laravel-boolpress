<template>
    <div class="post">
        <h2>{{ post.title }}</h2>
        <div v-if="post.image" class="image">
            <img :src="`/storage/${post.image}`" :alt="post.title" />
        </div>
        <div v-if="post.category" class="category">
            <strong>Category: </strong>
            <router-link
                :to="{ name: 'category', params: { slug: post.category.slug } }"
            >
                {{ post.category.name }}
            </router-link>
        </div>
        <div v-if="post.tags">
            <div v-if="post.tags.length" class="tags">
                <strong>Tags: </strong>
                <div v-for="(tag, i) in post.tags" :key="i" class="tag">
                    <router-link
                        :to="{
                            name: 'tag',
                            params: { slug: tag.slug },
                        }"
                    >
                        {{ tag.name }}
                    </router-link>
                </div>
            </div>
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
            .catch((error) => {
                this.$router.push({ name: "not-found" });
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
    .category, .tags {
        a {
            color: black;
            text-decoration: none;
            &:hover {
                color: lightseagreen;
            }
        }
    }
    .tags {
        display: flex;

        .tag {
            margin-left: 5px;

            &:not(:last-child)::after {
                content: ",";
            }
        }
    }
}
</style>
