<template>
    <div v-if="post.title" class="post">
        <div class="top">
            <div class="title">
                <h1>{{ post.title }}</h1>
            </div>
            <div class="info">
                <div class="left">
                    <AuthorName :author="post.author" />
                    <span class="slash">/</span>
                    <div class="date">{{ post.created_at }}</div>
                </div>
                <div class="right">
                    <svg
                        class="icon-comment"
                        viewBox="0 0 20 20"
                        version="1.1"
                        aria-labelledby="title"
                    >
                        <path
                            d="M15.3,14.1h2.4v2.4h-2.4V14.1z M12.5,11.8H0v2.4h15.3v-2.4H12.5z M7.1,2.4h10.6V0H2.4v2.4H7.1z M17.6,18.8H20V0h-2.4V18.8zM2.4,5.9V0H0v11.8h2.4V5.9z"
                        ></path>
                    </svg>
                    <a href="#comments" class="comment-link">Comment</a>
                </div>
            </div>
            <div class="tags">
                <div class="tags-container">
                    <h4>Tags</h4>
                    <router-link
                        :to="{
                            name: 'tag',
                            params: { slug: tag.slug },
                        }"
                        v-for="tag in post.tags"
                        :key="tag.id"
                        class="tag"
                        >{{ tag.name }}</router-link
                    >
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="image">
                <img :src="`/storage/${post.image}`" :alt="post.name" />
            </div>
            <div v-html="post.content" class="post-content"></div>
            <div id="comments">
                <div class="left"></div>
                <div class="right">
                    <h4>Add your comment</h4>
                    <form @submit.prevent="newComment()">
                        <div class="comment-container">
                            <input
                                v-model="formData.name"
                                type="text"
                                id="inputUsername"
                                placeholder="Insert the username..."
                            />
                            <i class="my_caret fa-solid fa-caret-right"></i>
                        </div>
                        <div class="comment-container">
                            <textarea
                                v-model="formData.content"
                                id="inputComment"
                                rows="4"
                                placeholder="Insert the comment..."
                            >
                            </textarea>
                            <i class="my_caret fa-solid fa-caret-right"></i>
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
                        <div v-if="commentSent" class="button button-end">
                            <div class="comment-sent">Comment sent!</div>
                            <button type="submit" class="btn btn-light">
                                Send
                            </button>
                        </div>
                        <div v-else class="button">
                            <button type="submit" class="btn btn-light">
                                Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AuthorName from "../components/commons/AuthorName.vue";

export default {
    name: "Post",
    components: {
        AuthorName,
    },
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
    padding: 35px 25px 35px 65px;
    .top {
        .title {
            h1 {
                font-size: 45px;
            }
            margin-bottom: 22px;
        }
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 22px;
            .left {
                display: flex;
                span {
                    margin: 0 15px;
                    color: var(--green);
                }
                .date {
                    font-size: 15px;
                    font-weight: 300;
                    color: var(--nav-color);
                }
            }
            .right {
                display: flex;
                align-items: center;
                a {
                    display: block;
                    font-size: 14px;
                    font-family: "Nimbus Sans", sans-serif;
                    color: var(--nav-color);
                    text-decoration: none;
                    margin-left: 8px;
                }
                .icon-comment {
                    width: 20px;
                    path {
                        fill: var(--green);
                    }
                }
            }
        }
        .tags {
            margin-bottom: 22px;
            h4 {
                font-size: 18px;
                margin-right: 17px;
            }
            .tags-container {
                margin-top: 12px;
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                .tag {
                    margin-right: 17px;
                    color: var(--green);
                    background: var(--nav-color);
                    border-radius: 20px;
                    padding: 2px 6px;
                    font-size: 14px;
                    color: white;
                    display: block;
                    text-decoration: none;
                    &::before {
                        content: "#";
                    }
                }
            }
        }
    }
    .bottom {
        img {
            width: 100%;
            margin: 15px 0;
        }
        &::v-deep .post-content {
            font-size: 20px;
            color: var(--author-name);
            letter-spacing: -0.1px;
            overflow-wrap: break-word;
            line-height: 1.5;
            font-family: "Nimbus Sans", sans-serif;
            img {
                width: 100%;
                margin: 15px 0;
            }
            p {
                margin-bottom: 20px;
                a {
                    color: var(--green);
                    border-bottom: 1px solid #f1f1f1;
                    text-decoration: none;
                }
            }
            h3 {
                color: black;
                font-family: "Aktiv", sans-serif;
            }
        }
        #comments {
            margin-top: 60px;
            display: flex;
            .left {
                width: 60%;
            }
            .right {
                width: 40%;
                h4 {
                    font-size: 24px;
                    font-weight: 700;
                    color: black;
                    padding-bottom: 10px;
                    padding-left: 20px;
                }
                form {
                    .comment-container {
                        position: relative;
                        padding-left: 20px;
                        .my_caret {
                            font-size: 18px;
                            position: absolute;
                            top: 15px;
                            left: -10px;
                            color: black;
                            opacity: 0;
                            transition: 0.3s;
                        }
                        input,
                        textarea {
                            width: 100%;
                            font-size: 16px;
                            color: var(--nav-color);
                            border: none;
                            border-bottom: 1px solid var(--nav-color);
                            padding: 6px 0;
                            margin-top: 10px;
                            margin-bottom: 15px;
                            resize: none;
                            font-family: "Nimbus Sans", sans-serif;

                            &:focus {
                                outline: none;
                                border-color: var(--green);
                            }
                            &:focus + .my_caret {
                                opacity: 1;
                                color: var(--green);
                                left: 0;
                            }
                        }
                    }
                    .button {
                        display: flex;
                        justify-content: flex-end;
                        margin-top: 10px;
                        padding-left: 20px;

                        .comment-sent {
                            color: var(--green);
                        }

                        &.button-end {
                            justify-content: space-between;
                            align-items: center;
                        }

                        button {
                            font-size: 14px;
                            border: none;
                            background-color: var(--nav-color);
                            border-radius: 40px;
                            padding: 10px 20px;
                            color: white;
                            cursor: pointer;
                            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
                            &:hover {
                                background-color: var(--green);
                            }
                        }
                    }
                }
            }
        }
    }
}
</style>
