<template>

    <AppLayout>
        <Container>
            <h1>Posts</h1>
            <ul class="divide-y">
                <li v-for="post in posts.data" :key="post.id">
                    <Link :href="route('posts.show',post.id)" class="group block px-2 py-4">
                        <span class="font-bold text-lg  group-hover:text-indigo-500">{{ post.title }}</span>
                        <span class="block pt-1 text-sm text-gray-600" >{{ formattedDate(post.created_at) }} ago by {{ post.user.name }}</span>
                        <span>{{ post.teaser }}</span>
                    </Link>
                </li>
            </ul>
        </Container>
        <Pagination :meta="posts.meta"/>
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import Pagination from "@/Components/Pagination.vue";
import {Head, Link, router, usePage} from '@inertiajs/vue3';
import {computed} from "vue";
import {formatDistance, parseISO} from "date-fns";

const props = defineProps(["posts"]);
/*let formattedDate=[];
Array.from(props.posts.data).forEach((post)=>{
    formattedDate[post.id]=formatDistance(parseISO(post.created_at),new Date());
});*/
const formattedDate = (date) => {
    return formatDistance(parseISO(date),new Date())
}
</script>
