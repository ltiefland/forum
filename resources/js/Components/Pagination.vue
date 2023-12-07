<template>
    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
            <a href="#"
               class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
            <a href="#"
               class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    {{ ' ' }}
                    <span class="font-medium">{{ meta.from }}</span>
                    {{ ' ' }}
                    to
                    {{ ' ' }}
                    <span class="font-medium">{{ meta.to }}</span>
                    {{ ' ' }}
                    of
                    {{ ' ' }}
                    <span class="font-medium">{{ meta.total }}</span>
                    {{ ' ' }}
                    results
                </p>
            </div>
            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <a  v-for="link in meta.links" :href="link.url"
                       class="relative inline-flex items-center first-of-type:rounded-l-md last-of-type:rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0" v-html="link.label">
                    </a>
                </nav>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ChevronLeftIcon, ChevronRightIcon} from '@heroicons/vue/20/solid'

defineProps(["meta"]);

const items = [
    {id: 1, title: 'Back End Developer', department: 'Engineering', type: 'Full-time', location: 'Remote'},
    {id: 2, title: 'Front End Developer', department: 'Engineering', type: 'Full-time', location: 'Remote'},
    {id: 3, title: 'User Interface Designer', department: 'Design', type: 'Full-time', location: 'Remote'},
]
</script>
