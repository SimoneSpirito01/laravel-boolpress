<template>
    <div class="tag">
        <h2>{{ tag.name }}</h2>
        <div v-if="tag.posts">
            <div v-if="tag.posts.length">
                <h4>Associated posts:</h4>
            <ul>
                <li v-for="post in tag.posts" :key="post.id">
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
    name: "Tag",
    data() {
        return {
            tag: {},
        };
    },
    created() {
        axios
            .get("/api/tags/" + this.$route.params.slug)
            .then((response) => {
                this.tag = response.data;
            })
            .catch((error) => {
                this.$router.push({ name: "not-found" });
            });
    },
};
</script>

<style lang="scss" scoped>
.tag {
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
