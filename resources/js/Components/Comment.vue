<template>
    <div class="sm:flex">
        <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4">
            <img
                :src="comment.user.profile_photo_url"
                class="h-10 w-10 rounded-full"
            />
        </div>
        <div class="flex-1">
            <div
                class="prose prose-sm mt-1 max-w-none"
                v-html="comment.html"
            ></div>
            <span
                class="block pt-1 text-xs text-gray-600 first-letter:uppercase"
                >By {{ comment.user.name }}
                {{ relativeDate(comment.created_at) }}</span
            >
            <div class="mt-2 flex justify-end space-x-3 empty:hidden">
                <form
                    v-if="comment.can?.update"
                    @submit.prevent="$emit('edit', comment.id)"
                >
                    <button class="font-mono text-xs hover:font-semibold">
                        Edit
                    </button>
                </form>
                <form
                    v-if="comment.can?.delete"
                    @submit.prevent="$emit('delete', comment.id)"
                >
                    <button
                        class="font-mono text-xs text-red-700 hover:font-semibold"
                    >
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { relativeDate } from "@/Utilities/date.js";
import { router, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps(["comment"]);

const emit = defineEmits(["edit", "delete"]);
</script>
