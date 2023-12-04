<x-admin-layout>
     <form class="w-full justify-start flex-col items-start flex" wire:submit="store">
          <div class="flex w-full items-center justify-between">
               <div class="text-4xl py-5  font-bold">
                    Creare a post
               </div>
               <button type="submit" wire:confirm="Are you sure you want to share this post?" class="primary-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Create
               </button>
          </div>
          <div class="card w-full">
               <input type="hidden" class="custom-link" />
               <div class="grid gap-4 grid-cols-2">
                    <div>
                         <label for="title">Title</label>
                         <input type="text" id="title" wire:model="title" placeholder="Post title" />
                         @error('title')
                         <div class="error">{{ $message }}</div>
                         @enderror
                    </div>
                    <div>
                         <label for="slug">Slug</label>
                         <input type="text" id="slug" wire:model="slug" placeholder="Uri Slug" />
                         @error('slug')
                         <div class="error">{{ $message }}</div>
                         @enderror
                    </div>
                    <div class="col-span-2">
                         <label for="summary">Summary</label>
                         <textarea id="summary" wire:model="summary" placeholder="Content summary"></textarea>
                         @error('summary')
                         <div class="error">{{ $message }}</div>
                         @enderror
                    </div>
                    <div class="col-span-2">
                         <div class="tiptap-editor" x-data="editor('<p>Hello world! :-)</p>')">
                              <template x-if="isLoaded()">
                                   <div class="menu">
                                        <!--Basics-->
                                        <div>
                                             <button type="button" @click="toggleBold()" title="Toggle Bold"
                                                  :class="{ 'is-active' : isActive('bold', updatedAt) }">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M13.5,15.5H10V12.5H13.5A1.5,1.5 0 0,1 15,14A1.5,1.5 0 0,1 13.5,15.5M10,6.5H13A1.5,1.5 0 0,1 14.5,8A1.5,1.5 0 0,1 13,9.5H10M15.6,10.79C16.57,10.11 17.25,9 17.25,8C17.25,5.74 15.5,4 13.25,4H7V18H14.04C16.14,18 17.75,16.3 17.75,14.21C17.75,12.69 16.89,11.39 15.6,10.79Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="toggleItalic()" title="Toggle Italic"
                                                  :class="{ 'is-active' : isActive('italic', updatedAt) }">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M10,4V7H12.21L8.79,15H6V18H14V15H11.79L15.21,7H18V4H10Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="toggleStrike()" title="Toggle Strike">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M3,14H21V12H3M5,4V7H10V10H14V7H19V4M10,19H14V16H10V19Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="setParagraph()" title="Set Paragraph">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path d="M21,6V8H3V6H21M3,18H12V16H3V18M3,13H21V11H3V13Z" />
                                                  </svg>
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
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M3,4H5V10H9V4H11V18H9V12H5V18H3V4M14,18V16H16V6.31L13.5,7.75V5.44L16,4H18V16H20V18H14Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="toggleHeading({ level: 2 })"
                                                  :class="{ 'is-active': isActive('heading', { level: 1 }, updatedAt) }">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M3,4H5V10H9V4H11V18H9V12H5V18H3V4M21,18H15A2,2 0 0,1 13,16C13,15.47 13.2,15 13.54,14.64L18.41,9.41C18.78,9.05 19,8.55 19,8A2,2 0 0,0 17,6A2,2 0 0,0 15,8H13A4,4 0 0,1 17,4A4,4 0 0,1 21,8C21,9.1 20.55,10.1 19.83,10.83L15,16H21V18Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="toggleHeading({ level: 3 })"
                                                  :class="{ 'is-active': isActive('heading', { level: 1 }, updatedAt) }">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M3,4H5V10H9V4H11V18H9V12H5V18H3V4M15,4H19A2,2 0 0,1 21,6V16A2,2 0 0,1 19,18H15A2,2 0 0,1 13,16V15H15V16H19V12H15V10H19V6H15V7H13V6A2,2 0 0,1 15,4Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="toggleHeading({ level: 4 })"
                                                  :class="{ 'is-active': isActive('heading', { level: 1 }, updatedAt) }">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M3,4H5V10H9V4H11V18H9V12H5V18H3V4M18,18V13H13V11L18,4H20V11H21V13H20V18H18M18,11V7.42L15.45,11H18Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="toggleHeading({ level: 5 })"
                                                  :class="{ 'is-active': isActive('heading', { level: 1 }, updatedAt) }">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M3,4H5V10H9V4H11V18H9V12H5V18H3V4M15,4H20V6H15V10H17A4,4 0 0,1 21,14A4,4 0 0,1 17,18H15A2,2 0 0,1 13,16V15H15V16H17A2,2 0 0,0 19,14A2,2 0 0,0 17,12H15A2,2 0 0,1 13,10V6A2,2 0 0,1 15,4Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="toggleHeading({ level: 6 })"
                                                  :class="{ 'is-active': isActive('heading', { level: 1 }, updatedAt) }">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M3,4H5V10H9V4H11V18H9V12H5V18H3V4M15,4H19A2,2 0 0,1 21,6V7H19V6H15V10H19A2,2 0 0,1 21,12V16A2,2 0 0,1 19,18H15A2,2 0 0,1 13,16V6A2,2 0 0,1 15,4M15,12V16H19V12H15Z" />
                                                  </svg>
                                             </button>
                                        </div>
                                        <!--Alignement-->
                                        <div>
                                             <button type="button" @click="setTextAlign('left')"
                                                  :class="{'is-active' : isActive({ textAlign: 'left' })}">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M3,3H21V5H3V3M3,7H15V9H3V7M3,11H21V13H3V11M3,15H15V17H3V15M3,19H21V21H3V19Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="setTextAlign('justify')"
                                                  :class="{'is-active' : isActive({ textAlign: 'justify' })}">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M3,3H21V5H3V3M3,7H21V9H3V7M3,11H21V13H3V11M3,15H21V17H3V15M3,19H21V21H3V19Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="setTextAlign('center')"
                                                  :class="{'is-active' : isActive({ textAlign: 'center' })}">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M3,3H21V5H3V3M7,7H17V9H7V7M3,11H21V13H3V11M7,15H17V17H7V15M3,19H21V21H3V19Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="setTextAlign('right')"
                                                  :class="{'is-active' : isActive({ textAlign: 'right' })}">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M3,3H21V5H3V3M9,7H21V9H9V7M3,11H21V13H3V11M9,15H21V17H9V15M3,19H21V21H3V19Z" />
                                                  </svg>
                                             </button>
                                        </div>
                                        <!--List-->
                                        <div>
                                             <button type="button" @click="toggleBulletList()"
                                                  title="Toggle bullet List">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M7,5H21V7H7V5M7,13V11H21V13H7M4,4.5A1.5,1.5 0 0,1 5.5,6A1.5,1.5 0 0,1 4,7.5A1.5,1.5 0 0,1 2.5,6A1.5,1.5 0 0,1 4,4.5M4,10.5A1.5,1.5 0 0,1 5.5,12A1.5,1.5 0 0,1 4,13.5A1.5,1.5 0 0,1 2.5,12A1.5,1.5 0 0,1 4,10.5M7,19V17H21V19H7M4,16.5A1.5,1.5 0 0,1 5.5,18A1.5,1.5 0 0,1 4,19.5A1.5,1.5 0 0,1 2.5,18A1.5,1.5 0 0,1 4,16.5Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="toggleOrderedList()"
                                                  title="Toggle Ordered List">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M7,13V11H21V13H7M7,19V17H21V19H7M7,7V5H21V7H7M3,8V5H2V4H4V8H3M2,17V16H5V20H2V19H4V18.5H3V17.5H4V17H2M4.25,10A0.75,0.75 0 0,1 5,10.75C5,10.95 4.92,11.14 4.79,11.27L3.12,13H5V14H2V13.08L4,11H2V10H4.25Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="liftListItem()" title="Lift List Item">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M14 10H3V12H14V10M14 6H3V8H14V6M3 16H10V14H3V16M14.4 22L17 19.4L19.6 22L21 20.6L18.4 18L21 15.4L19.6 14L17 16.6L14.4 14L13 15.4L15.6 18L13 20.6L14.4 22Z" />
                                                  </svg>
                                             </button>
                                        </div>
                                        <!--Attachement-->
                                        <div>
                                             <button type="button" @click="addLink()" title="Add Link">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M10.59,13.41C11,13.8 11,14.44 10.59,14.83C10.2,15.22 9.56,15.22 9.17,14.83C7.22,12.88 7.22,9.71 9.17,7.76V7.76L12.71,4.22C14.66,2.27 17.83,2.27 19.78,4.22C21.73,6.17 21.73,9.34 19.78,11.29L18.29,12.78C18.3,11.96 18.17,11.14 17.89,10.36L18.36,9.88C19.54,8.71 19.54,6.81 18.36,5.64C17.19,4.46 15.29,4.46 14.12,5.64L10.59,9.17C9.41,10.34 9.41,12.24 10.59,13.41M13.41,9.17C13.8,8.78 14.44,8.78 14.83,9.17C16.78,11.12 16.78,14.29 14.83,16.24V16.24L11.29,19.78C9.34,21.73 6.17,21.73 4.22,19.78C2.27,17.83 2.27,14.66 4.22,12.71L5.71,11.22C5.7,12.04 5.83,12.86 6.11,13.65L5.64,14.12C4.46,15.29 4.46,17.19 5.64,18.36C6.81,19.54 8.71,19.54 9.88,18.36L13.41,14.83C14.59,13.66 14.59,11.76 13.41,10.59C13,10.2 13,9.56 13.41,9.17Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="addImage()" title="Add Image">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M8.5,13.5L11,16.5L14.5,12L19,18H5M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="toggleBlockquote()"
                                                  title="Toggle Blockquote">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M14,17H17L19,13V7H13V13H16M6,17H9L11,13V7H5V13H8L6,17Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="toggleCodeBlock()" title="Toggle Code Block">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M5,3H7V5H5V10A2,2 0 0,1 3,12A2,2 0 0,1 5,14V19H7V21H5C3.93,20.73 3,20.1 3,19V15A2,2 0 0,0 1,13H0V11H1A2,2 0 0,0 3,9V5A2,2 0 0,1 5,3M19,3A2,2 0 0,1 21,5V9A2,2 0 0,0 23,11H24V13H23A2,2 0 0,0 21,15V19A2,2 0 0,1 19,21H17V19H19V14A2,2 0 0,1 21,12A2,2 0 0,1 19,10V5H17V3H19M12,15A1,1 0 0,1 13,16A1,1 0 0,1 12,17A1,1 0 0,1 11,16A1,1 0 0,1 12,15M8,15A1,1 0 0,1 9,16A1,1 0 0,1 8,17A1,1 0 0,1 7,16A1,1 0 0,1 8,15M16,15A1,1 0 0,1 17,16A1,1 0 0,1 16,17A1,1 0 0,1 15,16A1,1 0 0,1 16,15Z" />
                                                  </svg>
                                             </button>
                                        </div>
                                        <!--State-->
                                        <div>
                                             <button type="button" @click="undo()" title="Undo">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M12.5,8C9.85,8 7.45,9 5.6,10.6L2,7V16H11L7.38,12.38C8.77,11.22 10.54,10.5 12.5,10.5C16.04,10.5 19.05,12.81 20.1,16L22.47,15.22C21.08,11.03 17.15,8 12.5,8Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="redo()" title="Redo">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M18.4,10.6C16.55,9 14.15,8 11.5,8C6.85,8 2.92,11.03 1.54,15.22L3.9,16C4.95,12.81 7.95,10.5 11.5,10.5C13.45,10.5 15.23,11.22 16.62,12.38L13,16H22V7L18.4,10.6Z" />
                                                  </svg>
                                             </button>
                                             <button type="button" @click="clearNodes()" title="Clear nodes">
                                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                       <path
                                                            d="M6,5V5.18L8.82,8H11.22L10.5,9.68L12.6,11.78L14.21,8H20V5H6M3.27,5L2,6.27L8.97,13.24L6.5,19H9.5L11.07,15.34L16.73,21L18,19.73L3.55,5.27L3.27,5Z" />
                                                  </svg>
                                             </button>
                                        </div>
                                   </div>
                              </template>

                              <div x-ref="element" class="p-5 editor"></div>
                         </div>
                    </div>
               </div>
          </div>
     </form>
</x-admin-layout>