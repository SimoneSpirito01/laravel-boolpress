<template>
    <article class="latest-post">
        <div class="left">
            <h2 class="title">
                {{ post.title }}
            </h2>
            <div class="author">
                {{ post.author.username }}
            </div>
            <div class="date">
                {{ post.created_at }}
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
</template>

<script>
export default {
    name: "LatestPost",
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
};
</script>

<style lang="scss" scoped>
.latest-post {
    display: flex;
    padding: 30px 0;
    border-bottom: 2px solid #f1f1f1;
    cursor: pointer;
    transition: opacity 0.15s linear;
    &:hover {
        opacity: 0.7;
    }
    > * {
        width: calc((100% - 60px) / 3);
    }
    .left {
        font-size: 14px;
        .title {
            font-size: 35px;
            margin-bottom: 10px;
        }
        .author {
            font-weight: 600;
            color: var(--author-name);
            margin-bottom: 6px;
        }
        .date {
            color: var(--nav-color);
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
</style>
