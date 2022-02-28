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
        <div class="comments">
            <form @submit.prevent="newComment()">
                <div class="form-group">
                    <label for="inputUsername">Username</label>
                    <input
                        v-model="formData.name"
                        type="text"
                        class="form-control"
                        id="inputUsername"
                        placeholder="Insert the username"
                    />
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1"
                        >Example textarea</label
                    >
                    <textarea
                        v-model="formData.content"
                        class="form-control"
                        id="exampleFormControlTextarea1"
                        rows="3"
                    >
                    </textarea>
                    <div v-if="formErrors.content">
                        <ul>
                            <li
                                v-for="(error, i) in formErrors.content"
                                :key="i"
                            >
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                </div>
                <button type="submit" class="btn btn-light">Submit</button>
            </form>
            <div v-if="commentSent" class="comment-sent">Comment sent!</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Post",
    data() {
        return {
            post: {},
            formData: {
                name: "",
                content: "",
                post_id: null,
            },
            commentSent: false,
            formErrors: {},
        };
    },
    methods: {
        newComment() {
            axios
                .post("/api/comments", this.formData)
                .then((response) => {
                    this.formData.name = "";
                    this.formData.content = "";
                    this.commentSent = true;
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error.response.data.errors);
                    this.formErrors = error.response.data.errors;
                });
        },
    },
    created() {
        axios
            .get("/api/posts/" + this.$route.params.slug)
            .then((response) => {
                this.post = response.data;
                this.formData.post_id = this.post.id;
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
    .category,
    .tags {
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
