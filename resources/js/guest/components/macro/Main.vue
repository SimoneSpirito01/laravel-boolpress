<template>
    <main>
        <div class="container">
            <router-view></router-view>
        </div>
    </main>
</template>

<script>
export default {
    name: "Main",
};
</script>

<style lang="scss" scoped>
main {
    margin: 70px 0;

    .container {
        width: 80%;
        max-width: 1200px;
        margin: 0 auto;
    }
}
</style>
