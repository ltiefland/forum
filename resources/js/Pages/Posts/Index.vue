<template>
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
</template>
