import './bootstrap';

import Alpine from 'alpinejs';
import { Editor } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'
import Document from '@tiptap/extension-document'
import Paragraph from '@tiptap/extension-paragraph'
import Text from '@tiptap/extension-text'
import Heading from '@tiptap/extension-heading'
import Image from '@tiptap/extension-image'
import Dropcursor from '@tiptap/extension-dropcursor'
import TextAlign from '@tiptap/extension-text-align'
import Link from '@tiptap/extension-link'
import BulletList from '@tiptap/extension-bullet-list'
import ListItem from '@tiptap/extension-list-item'
import OrderedList from '@tiptap/extension-ordered-list'
import FontFamily from '@tiptap/extension-font-family'
import TextStyle from '@tiptap/extension-text-style'

document.addEventListener('alpine:init', () => {
     Alpine.data('editor', (content) => {
          let editor
          return {
               updatedAt: Date.now(),
               init() {
                    const _this = this
                    editor = new Editor({
                         element: this.$refs.element,
                         extensions: [
                              StarterKit,
                              Document,
                              Paragraph,
                              Text,
                              Image,
                              Dropcursor,
                              OrderedList,
                              ListItem,
                              BulletList,
                              TextStyle,
                              FontFamily.configure({
                                   types: ['textStyle'],
                              }),
                              Link.configure({
                                   autolink: true,
                                   openOnClick: true,
                                   linkOnPaste: true,
                                   protocols: ['https', 'http', 'mailto'],
                                   HTMLAttributes: {
                                        class: 'custom-link',
                                        target: '_blank',
                                   },
                                   validate: href => /^https?:\/\//.test(href),
                              }),
                              TextAlign.configure({
                                   defaultAlignment: 'left',
                                   types: ['heading', 'paragraph'],
                                   alignments: ['left', 'center', 'right', 'justify']
                              }),
                              Heading.configure({
                                   levels: [1, 2, 3, 4, 5, 6],
                              }),
                         ],
                         content: content,
                         onCreate({ editor }) {
                              _this.updatedAt = Date.now()
                         },
                         onUpdate({ editor }) {
                              _this.updatedAt = Date.now()
                         },
                         onSelectionUpdate({ editor }) {
                              _this.updatedAt = Date.now()
                         }
                    })
               },
               isLoaded() {
                    return editor
               },
               addImage() {
                    const url = window.prompt('URL')
                    if (url) {
                         editor.chain().setImage({ src: url }).focus().run()
                    }
               },
               addLink() {
                    const url = window.prompt('URL')
                    if (url) {
                         editor.chain().setLink({ href: url }).focus().run()
                    }
               },
               isActive(type, opts = {}) {
                    return editor.isActive(type, opts)
               },
               toggleHeading(opts) {
                    editor.chain().toggleHeading(opts).focus().run()
               },
               setParagraph() {
                    editor.chain().setParagraph().focus().run()
               },
               toggleStrike() {
                    editor.chain().toggleStrike().focus().run()
               },
               toggleBold() {
                    editor.chain().toggleBold().focus().run()
               },
               toggleItalic() {
                    editor.chain().toggleItalic().focus().run()
               },
               setTextAlign(input = 'left') {
                    editor.chain().setTextAlign(input).focus().run()
               },
               toggleCode() {
                    editor.chain().toggleCode().focus().run()
               },
               clearNodes() {
                    editor.chain().clearNodes().focus().run()
               },
               toggleCodeBlock() {
                    editor.chain().toggleCodeBlock().focus().run()
               },
               toggleBlockquote() {
                    editor.chain().toggleBlockquote().focus().run()
               },
               undo() {
                    editor.chain().undo().focus().run()
               },
               redo() {
                    editor.chain().redo().focus().run()
               },
               toggleBulletList() {
                    editor.chain().focus().toggleBulletList().run()
               },
               toggleOrderedList() {
                    editor.chain().focus().toggleOrderedList().run()
               },
               liftListItem() {
                    editor.chain().focus().liftListItem('listItem').run()
               },
               setFont(font) {
                    editor.chain().focus().setFontFamily(font.target.value).run()
               },
               unsetFont() {
                    editor.chain().focus().unsetFontFamily().run()
               }
          }
     })
})


window.Alpine = Alpine;
Alpine.start();
window.ToggleTheme = () => {
     if (document.documentElement.classList.contains('dark')) {
          document.documentElement.classList.remove('dark')
          localStorage.theme = 'light'
     } else {
          document.documentElement.classList.add('dark')
          localStorage.theme = 'dark'
     }
}

window.addEventListener("load", (event) => {
     if (localStorage.theme === 'dark' || (!('theme' in localStorage)
          && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
          document.documentElement.classList.add('dark')
     } else {
          document.documentElement.classList.remove('dark')
     }
});

window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
     localStorage.removeItem("theme")
     if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
          document.documentElement.classList.add('dark')
     } else {
          document.documentElement.classList.remove('dark')
     }
});