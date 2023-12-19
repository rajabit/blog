<div class="menu">
    <!--Basics-->
    <div>
        <button type="button" @click="toggleBold()" title="Toggle Bold"
            :class="{ 'is-active' : isActive('bold', updatedAt) }">
            <x-icons.italic />
        </button>
        <button type="button" @click="toggleItalic()" title="Toggle Italic"
            :class="{ 'is-active' : isActive('italic', updatedAt) }">
            <x-icons.bold />
        </button>
        <button type="button" @click="toggleStrike()" title="Toggle Strike">
            <x-icons.strike />
        </button>
        <button type="button" @click="setParagraph()" title="Set Paragraph">
            <x-icons.paragraph />
        </button>
    </div>
    <!-- Font Family-->
    <div>
        <select @change="setFont" class="rounded text-input border-none">
            <option value="Inter">Inter</option>
            <option value="Comic Sans MS, Comic Sans">Sans</option>
            <option value="serif">Serif</option>
            <option value="monospace">Monospace</option>
            <option value="cursive">Cursive</option>
        </select>

    </div>
    <!--Heading-->
    <div>
        <button type="button" @click="toggleHeading({ level: 1 })"
            :class="{ 'is-active': isActive('heading', { level: 1 }, updatedAt) }">
            <x-icons.h1 />
        </button>
        <button type="button" @click="toggleHeading({ level: 2 })"
            :class="{ 'is-active': isActive('heading', { level: 1 }, updatedAt) }">
            <x-icons.h2 />
        </button>
        <button type="button" @click="toggleHeading({ level: 3 })"
            :class="{ 'is-active': isActive('heading', { level: 1 }, updatedAt) }">
            <x-icons.h3 />
        </button>
        <button type="button" @click="toggleHeading({ level: 4 })"
            :class="{ 'is-active': isActive('heading', { level: 1 }, updatedAt) }">
            <x-icons.h4 />
        </button>
        <button type="button" @click="toggleHeading({ level: 5 })"
            :class="{ 'is-active': isActive('heading', { level: 1 }, updatedAt) }">
            <x-icons.h5 />
        </button>
        <button type="button" @click="toggleHeading({ level: 6 })"
            :class="{ 'is-active': isActive('heading', { level: 1 }, updatedAt) }">
            <x-icons.h6 />
        </button>
    </div>
    <!--Alignement-->
    <div>
        <button type="button" @click="setTextAlign('left')" title="Text Left"
            :class="{'is-active' : isActive({ textAlign: 'left' })}">
            <x-icons.text-left />
        </button>
        <button type="button" @click="setTextAlign('justify')" title="Text Justify"
            :class="{'is-active' : isActive({ textAlign: 'justify' })}">
            <x-icons.text-justify />
        </button>
        <button type="button" @click="setTextAlign('center')" title="Text Center"
            :class="{'is-active' : isActive({ textAlign: 'center' })}">
            <x-icons.text-center />
        </button>
        <button type="button" @click="setTextAlign('right')" title="Text Right"
            :class="{'is-active' : isActive({ textAlign: 'right' })}">
            <x-icons.text-right />

        </button>
    </div>
    <!--List-->
    <div>
        <button type="button" @click="toggleBulletList()" title="Toggle bullet List">
            <x-icons.list-dots />
        </button>
        <button type="button" @click="toggleOrderedList()" title="Toggle Ordered List">
            <x-icons.list-decimal />
        </button>
        <button type="button" @click="liftListItem()" title="Lift List Item">
            <x-icons.list-close />
        </button>
    </div>
    <!--Attachement-->
    <div>
        <button type="button" @click="addLink()" title="Add Link">
            <x-icons.link />
        </button>
        <button type="button" @click="addImage()" title="Add Image">
            <x-icons.image />
        </button>
        <button type="button" @click="toggleBlockquote()" title="Toggle Blockquote">
            <x-icons.quote />
        </button>
        <button type="button" @click="toggleCodeBlock()" title="Toggle Code Block">
            <x-icons.code-json />
        </button>
    </div>
    <!--State-->
    <div>
        <button type="button" @click="undo()" title="Undo">
            <x-icons.undo />
        </button>
        <button type="button" @click="redo()" title="Redo">
            <x-icons.redo />
        </button>
        <button type="button" @click="clearNodes()" title="Clear nodes">
            <x-icons.text-clear />
        </button>
    </div>
</div>
