<template>
    <div class="border-2 border-gray-700 rounded-md">
        <div v-if="editor" class="menu-bar bg-slate-950">
            <button
                @click="editor.chain().focus().toggleBold().run()"
                :disabled="!editor.can().chain().focus().toggleBold().run()"
                :class="{ 'is-active': editor.isActive('bold') }"
            >
                <i class="fas fa-bold"></i>
            </button>
            <button
                @click="editor.chain().focus().toggleItalic().run()"
                :disabled="!editor.can().chain().focus().toggleItalic().run()"
                :class="{ 'is-active': editor.isActive('italic') }"
            >
                <i class="fas fa-italic"></i>
            </button>
            <button
                @click="editor.chain().focus().toggleStrike().run()"
                :disabled="!editor.can().chain().focus().toggleStrike().run()"
                :class="{ 'is-active': editor.isActive('strike') }"
            >
                <i class="fas fa-strikethrough"></i>
            </button>
            <button
                @click="editor.chain().focus().toggleCode().run()"
                :disabled="!editor.can().chain().focus().toggleCode().run()"
                :class="{ 'is-active': editor.isActive('code') }"
            >
                <i class="fas fa-code"></i>
            </button>
            <button
                @click="editor.chain().focus().toggleCodeBlock().run()"
                :class="{ 'is-active': editor.isActive('codeBlock') }"
            >
                <i class="fas fa-laptop-code"></i>
            </button>
            <!-- <button @click="editor.chain().focus().unsetAllMarks().run()">
            clear marks
        </button>
        <button @click="editor.chain().focus().clearNodes().run()">
            clear nodes
        </button> -->
            <button
                @click="editor.chain().focus().setParagraph().run()"
                :class="{ 'is-active': editor.isActive('paragraph') }"
            >
                <i class="fas fa-paragraph"></i>
            </button>
            <button
                @click="
                    editor.chain().focus().toggleHeading({ level: 1 }).run()
                "
                :class="{
                    'is-active': editor.isActive('heading', { level: 1 }),
                }"
            >
                h1
            </button>
            <button
                @click="
                    editor.chain().focus().toggleHeading({ level: 2 }).run()
                "
                :class="{
                    'is-active': editor.isActive('heading', { level: 2 }),
                }"
            >
                h2
            </button>
            <button
                @click="
                    editor.chain().focus().toggleHeading({ level: 3 }).run()
                "
                :class="{
                    'is-active': editor.isActive('heading', { level: 3 }),
                }"
            >
                h3
            </button>
            <button
                @click="
                    editor.chain().focus().toggleHeading({ level: 4 }).run()
                "
                :class="{
                    'is-active': editor.isActive('heading', { level: 4 }),
                }"
            >
                h4
            </button>
            <button
                @click="
                    editor.chain().focus().toggleHeading({ level: 5 }).run()
                "
                :class="{
                    'is-active': editor.isActive('heading', { level: 5 }),
                }"
            >
                h5
            </button>
            <button
                @click="
                    editor.chain().focus().toggleHeading({ level: 6 }).run()
                "
                :class="{
                    'is-active': editor.isActive('heading', { level: 6 }),
                }"
            >
                h6
            </button>
            <button
                @click="editor.chain().focus().toggleBulletList().run()"
                :class="{ 'is-active': editor.isActive('bulletList') }"
            >
                <i class="fas fa-list-ul"></i>
            </button>
            <button
                @click="editor.chain().focus().toggleOrderedList().run()"
                :class="{ 'is-active': editor.isActive('orderedList') }"
            >
                <i class="fas fa-list-ol"></i>
            </button>

            <button
                @click="editor.chain().focus().toggleBlockquote().run()"
                :class="{ 'is-active': editor.isActive('blockquote') }"
            >
                <i class="fas fa-quote-left"></i>
            </button>
            <!-- <button @click="editor.chain().focus().setHorizontalRule().run()">
            horizontal rule
        </button>
        <button @click="editor.chain().focus().setHardBreak().run()">
            hard break
        </button> -->
            <button
                @click="editor.chain().focus().undo().run()"
                :disabled="!editor.can().chain().focus().undo().run()"
            >
                <i class="fas fa-undo-alt"></i>
            </button>
            <button
                @click="editor.chain().focus().redo().run()"
                :disabled="!editor.can().chain().focus().redo().run()"
            >
                <i class="fas fa-redo-alt"></i>
            </button>
        </div>
        <editor-content :editor="editor" />
    </div>
</template>

<script>
import StarterKit from "@tiptap/starter-kit";
import BulletList from "@tiptap/extension-bullet-list";
import ListItem from "@tiptap/extension-list-item";
import Document from "@tiptap/extension-document";
import Blockquote from "@tiptap/extension-blockquote";
import OrderedList from "@tiptap/extension-ordered-list";
import { Editor, EditorContent } from "@tiptap/vue-3";

export default {
    components: {
        EditorContent,
    },

    data() {
        return {
            editor: null,
        };
    },

    mounted() {
        this.editor = new Editor({
            extensions: [
                StarterKit,
                BulletList,
                OrderedList,
                ListItem,
                Document,
                Blockquote,
            ],
            content: `
          <h2>
            Hi there,
          </h2>
          <p>
            this is a <em>basic</em> example of <strong>tiptap</strong>. Sure, there are all kind of basic text styles you’d probably expect from a text editor. But wait until you see the lists:
          </p>
          <ul>
            <li>
              That’s a bullet list with one …
            </li>
            <li>
              … or two list items.
            </li>
          </ul>
          <p>
            Isn’t that great? And all of that is editable. But wait, there’s more. Let’s try a code block:
          </p>
          <pre><code class="language-css">body {
    display: none;
  }</code></pre>
          <p>
            I know, I know, this is impressive. It’s only the tip of the iceberg though. Give it a try and click a little bit around. Don’t forget to check the other examples too.
          </p>
          <blockquote>
            Wow, that’s amazing. Good work, boy! 👏
            <br />
            — Mom
          </blockquote>
        `,
        });
    },

    beforeUnmount() {
        this.editor.destroy();
    },
};
</script>

<style lang="scss">
/* Basic editor styles */
.tiptap {
    > * + * {
        margin-top: 0.75em;
    }

    ul,
    ol {
        padding: 0 1rem;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        line-height: 1.1;
    }

    code {
        background-color: rgba(#616161, 0.1);
        color: #616161;
    }

    pre {
        background: #0d0d0d;
        color: #fff;
        font-family: "JetBrainsMono", monospace;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;

        code {
            color: inherit;
            padding: 0;
            background: none;
            font-size: 0.8rem;
        }
    }

    img {
        max-width: 100%;
        height: auto;
    }

    blockquote {
        padding-left: 1rem;
        border-left: 2px solid rgba(#0d0d0d, 0.1);
    }

    hr {
        border: none;
        border-top: 2px solid rgba(#0d0d0d, 0.1);
        margin: 2rem 0;
    }
}
.menu-bar {
    button {
        display: inline-block;
        border: 1px solid #0d0d0d;
        padding: 0 12px;
        color: white;
    }
}
</style>
