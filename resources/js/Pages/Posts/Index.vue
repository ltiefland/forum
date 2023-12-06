<template>

    <AppLayout>
        <div>
            <h1>Posts</h1>
            <ul>
                <li v-for="post in posts" :key="post.id">
                    <inertia-link :href="rout('posts.show',post.id)">
                        {{ post.title }}
                    </inertia-link>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps(["posts"]);
</script>
