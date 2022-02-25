<template>
    <div class="category">
        <h2>{{ category.name }}</h2>
        <div v-if="category.posts">
            <div v-if="category.posts.length">
                <h4>Associated posts:</h4>
            <ul>
                <li v-for="post in category.posts" :key="post.id">
                    <router-link
                        :to="{ name: 'post', params: { slug: post.slug } }"
                    >
                        {{ post.title }}
                    </router-link>
                </li>
            </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Category",
    data() {
        return {
            category: {},
        };
    },
    created() {
        axios
            .get("/api/categories/" + this.$route.params.slug)
            .then((response) => {
                this.category = response.data;
            })
            .catch((error) => {
                this.$router.push({ name: "not-found" });
            });
    },
};
</script>

<style lang="scss" scoped>
.category {
    > * {
        margin: 15px 0;
    }
    ul {
        padding-left: 20px;

        li {
            margin: 10px;

            a {
                color: black;
                text-decoration: none;
                &:hover {
                    color: lightseagreen;
                }
            }
        }
    }
}
</style>
