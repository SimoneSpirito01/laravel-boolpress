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
    margin: 40px 0;
}
</style>
