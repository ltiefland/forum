<template>
    <div>
        <EditorContent :editor="editor"/>
    </div>
</template>
<script setup>
import {useEditor, EditorContent} from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import {watch} from "vue";
import {Markdown} from "tiptap-markdown";

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
    onUpdate: () => emit('update:modelValue', editor.value?.storage.markdown.getMarkdown()),
});

watch(() => props.modelValue, (value) => {
    if(value===editor.value?.storage.markdown.getMarkdown())
    {
        return;
    }
    editor.value?.commands.setContent(value);
}, {
    immediate: true,
})
</script>
