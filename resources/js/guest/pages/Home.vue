<template>
    <div class="home">
        <MainPosts/>
        <LatestPosts/>
    </div>
</template>

<script>
import MainPosts from '../components/sections/MainPosts.vue'
import LatestPosts from '../components/sections/LatestPosts.vue'

export default {
    name: "Home",
    components: {
        MainPosts,
        LatestPosts
    }
};
</script>

<style lang="scss" scoped>

.home {
    padding: 25px;
}

</style>
