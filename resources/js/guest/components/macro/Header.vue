<template>
    <header>
        <div class="container">
            <nav>
                <ul>
                    <li>
                        <router-link :to="{ name: 'home' }">Home</router-link>
                    </li>
                    <li v-for="category in categories" :key="category.id">
                        <router-link :to="{ name: 'category', params: { slug:category.slug } }">
                            {{category.name}}
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'categories' }"
                            >Categories</router-link
                        >
                    </li>
                    <li>
                        <router-link :to="{ name: 'tags' }"
                            >Tags</router-link
                        >
                    </li>
                    <li>
                        <router-link :to="{ name: 'about' }"
                            >About Us</router-link
                        >
                    </li>
                    <li><a href="/admin/home">Reserved area</a></li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            categories: []
        }
    },
    created() {
        axios
            .get("/api/categories")
            .then((response) => {
                this.categories = [...response.data];
            })
            .catch(function (error) {
                console.log(error);
            });
    }
};
</script>

<style lang="scss" scoped>
header {
    width: 14%;
    ul {
        list-style: none;
        padding: 25px 30px;

        li {
            margin-bottom: 12px;
            a {
                font-size: 28px;
                font-weight: 200;
                color: var(--nav-color);
                text-decoration: none;
                &:hover {
                    color: var(--green);
                }
            }
        }
    }
}
</style>
