<template>
    <header>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="/admin/home">Reserved area</a></li>
                    <li><router-link :to="{ name: 'home' }">Home</router-link></li>
                    <li><router-link :to="{ name: 'about' }">About Us</router-link></li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<script>
export default {
    name: "Header",
};
</script>

<style lang="scss" scoped>

header {
    padding-top: 40px;

    ul {
        list-style: none;

        a {
            color: blue;
            text-decoration: none;
        }
    }
}

</style>
