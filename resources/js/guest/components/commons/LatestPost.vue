<template>
    <router-link :to="{ name: 'post', params: { slug: post.slug } }">
        <article class="latest-post">
            <div class="left">
                <h2 class="title">
                    {{ post.title }}
                </h2>
                <AuthorName :author="post.author" />
                <div class="date">
                    <div class="hour">
                        {{ post.formattedDate.hour }}
                    </div>
                    <div class="slash">/</div>
                    <div class="year">
                        {{ post.formattedDate.date }}
                    </div>
                </div>
            </div>
            <div class="center">
                <div class="content" v-html="shortContent"></div>
            </div>
            <div class="right">
                <div class="image">
                    <img :src="`/storage/${post.image}`" :alt="post.title" />
                </div>
            </div>
        </article>
    </router-link>
</template>

<script>
import AuthorName from "../commons/AuthorName.vue";
import functionsShared from "../../share/functionsShared.js";

export default {
    name: "LatestPost",
    components: {
        AuthorName,
    },
    props: {
        post: Object,
    },
    computed: {
        shortContent() {
            if (this.post.content.length < 200) {
                return this.post.content;
            } else {
                return this.post.content.slice(0, 200) + "...";
            }
        },
    },
    created() {
        this.post.formattedDate = functionsShared.formatDate(
            this.post.created_at
        );
    },
};
</script>

<style lang="scss" scoped>
a {
    display: inline-block;
    text-decoration: none;
    color: initial;
    &:hover {
        animation: shadow-pop-br 0.3s both;
        padding: 0 20px;
    }
    &:hover + a .latest-post,
    &:hover .latest-post {
        border: none;
    }
    .latest-post {
        display: flex;
        padding: 30px 0;
        border-top: 2px solid #f1f1f1;
        > * {
            width: calc((100% - 60px) / 3);
        }
        .left {
            font-size: 16px;
            .title {
                font-size: 35px;
                margin-bottom: 10px;
            }
            .date {
                color: var(--nav-color);
                display: flex;
                .slash {
                    color: var(--green);
                    margin: 0 5px;
                }
            }
        }
        .center {
            margin: 0 30px;
            .content {
                max-height: 300px;
                color: var(--nav-color) !important;
                &::v-deep p {
                    font-size: 20px;
                }
                &::v-deep a {
                    color: var(--nav-color);
                    text-decoration: none;
                    pointer-events: none;
                }
            }
        }
        .right {
            .image {
                img {
                    width: 100%;
                }
            }
        }
    }
}
.latest-posts:hover .latest-post:not(:hover) {
    opacity: 0.8;
}
</style>
