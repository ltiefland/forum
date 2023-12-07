<template>

    <AppLayout>
        <Container>
            <h1>Posts</h1>
            <ul class="divide-y">
                <li v-for="post in posts.data" :key="post.id" class="px-2 py-4">
                    <inertia-link :href="route('posts.show',post.id)">
                        <span class="font-bold text-lg">{{ post.title }}</span>
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
