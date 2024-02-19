<template>
    <div v-if="editor"
         class="bg-white rounded-md border-0 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
        <menu class="flex divide-x border-b">
            <li>
                <button @click="()=>editor.chain().focus().toggleBold().run()"
                        type="button"
                        :class="[
                            editor.isActive('bold')?'bg-indigo-500 text-white' : 'hover:bg-gray-200'
                        ]"
                        class="px-3 py-2 rounded-tl-md"
                        title="Bold">
                    <i class="ri-bold"></i>
                </button>
            </li>
            <li>
                <button @click="()=>editor.chain().focus().toggleItalic().run()"
                        type="button"
                        :class="[
                            editor.isActive('italic')?'bg-indigo-500 text-white' : 'hover:bg-gray-200'
                        ]"
                        class="px-3 py-2"
                        title="Italic">
                    <i class="ri-italic"></i>
                </button>
            </li>
            <li>
                <button @click="()=>editor.chain().focus().toggleStrike().run()"
                        type="button"
                        :class="[
                            editor.isActive('strike')?'bg-indigo-500 text-white' : 'hover:bg-gray-200'
                        ]"
                        class="px-3 py-2"
                        title="Strikethrough">
                    <i class="ri-strikethrough"></i>
                </button>
            </li>
            <li>
                <button @click="()=>editor.chain().focus().toggleBlockquote().run()"
                        type="button"
                        :class="[
                            editor.isActive('blockquote')?'bg-indigo-500 text-white' : 'hover:bg-gray-200'
                        ]"
                        class="px-3 py-2"
                        title="Blockquote">
                    <i class="ri-double-quotes-l"></i>
                </button>
            </li>
            <li>
                <button @click="()=>editor.chain().focus().toggleBulletList().run()"
                        type="button"
                        :class="[
                            editor.isActive('bulletList')?'bg-indigo-500 text-white' : 'hover:bg-gray-200'
                        ]"
                        class="px-3 py-2"
                        title="Bullet list">
                    <i class="ri-list-unordered"></i>
                </button>
            </li>
            <li>
                <button @click="()=>editor.chain().focus().toggleOrderedList().run()"
                        type="button"
                        :class="[
                            editor.isActive('orderedList')?'bg-indigo-500 text-white' : 'hover:bg-gray-200'
                        ]"
                        class="px-3 py-2"
                        title="Numeric list">
                    <i class="ri-list-ordered"></i>
                </button>
            </li>
        </menu>
        <EditorContent :editor="editor"/>
    </div>
</template>
<script setup>
import {useEditor, EditorContent} from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import {watch} from "vue";
import {Markdown} from "tiptap-markdown";
import 'remixicon/fonts/remixicon.css';

const props = defineProps({
    modelValue: '',
});

const emit = defineEmits([
    'update:modelValue'
])

const editor = useEditor({
    extensions: [
        StarterKit,
        Markdown
    ],
    editorProps: {
        attributes: {
            class: 'min-h-[512px] prose prose-sm max-w-none py-1.5 px-3',
        },
    },
    onUpdate: () => emit('update:modelValue', editor.value?.storage.markdown.getMarkdown()),
});

watch(() => props.modelValue, (value) => {
    if (value === editor.value?.storage.markdown.getMarkdown()) {
        return;
    }
    editor.value?.commands.setContent(value);
}, {
    immediate: true,
})
</script>
