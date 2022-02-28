<template>
    <div class="container">
        <Header />
        <Main />
    </div>
</template>

<script>
import Header from "./components/macro/Header.vue";
import Main from "./components/macro/Main.vue";

export default {
    name: "App",
    components: {
        Header,
        Main,
    },
};
</script>

<style lang="scss" scoped>

.container {
    display: flex;
    height: 100vh;
    overflow-y: hidden;
}

</style>
