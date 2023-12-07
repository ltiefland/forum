<template>

    <AppLayout>
        <Container>
            <h1>Posts</h1>
            <ul>
                <li v-for="post in posts" :key="post.id">
                    <inertia-link :href="route('posts.show',post.id)">
                        {{ post.title }}
                    </inertia-link>
                </li>
            </ul>
        </Container>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";

defineProps(["posts"]);
</script>
