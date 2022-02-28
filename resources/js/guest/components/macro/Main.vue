<template>
    <main>
        <div class="container">
            <router-view :key="$route.fullPath"></router-view>
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
    overflow-y: auto;

    .container {
        width: 77%;
    }
}
</style>
