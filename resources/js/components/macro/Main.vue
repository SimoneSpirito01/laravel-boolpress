<template>
    <main>
        <div class="container">
            <h1>Post list</h1>
            <ul>
                <li v-for="(post, i) in visiblePosts" :key="i">
                    <div class="title">
                        <strong>Title: </strong>{{ post.title }}
                    </div>
                    <div v-if="post.category != null" class="category">
                        <strong>Category: </strong>{{ post.category.name }}
                    </div>
                    <div v-if="post.tags.length > 0" class="tags">
                        <strong>Tags: </strong>
                        <ul>
                            <li
                                v-for="(tag, i) in post.tags"
                                :key="i"
                                class="tag"
                            >
                                {{ tag.name }}
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </main>
</template>

<script>
export default {
    name: "Main",
    data() {
        return {
            visiblePosts: [],
        };
    },
    created() {
        axios
            .get("/api/posts")
            .then((response) => {
                this.visiblePosts = [...response.data];
            })
            .catch(function (error) {
                console.log(error);
            });
    },
};
</script>

<style lang="scss" scoped>
main {
    margin: 70px 0;

    .container {
        width: 80%;
        max-width: 1200px;
        margin: 0 auto;

        h1 {
            margin-bottom: 20px;
        }

        ul {
            padding-left: 20px;

            li {
                margin: 15px 0;

                > div {
                    margin: 4px 0;

                    .tag {
                        margin: 6px 0;
                    }
                }
            }
        }
    }
}
</style>
