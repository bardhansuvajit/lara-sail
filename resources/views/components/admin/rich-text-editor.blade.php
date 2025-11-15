{{-- @props(['disabled' => false, 'name']) --}}
@props(['disabled' => false, 'name', 'value' => ''])

<div class="bg-white dark:bg-gray-800 rounded border border-gray-300 dark:border-gray-700 overflow-hidden">
    <!-- Hidden input field for form submission -->
    <input type="hidden" id="content-input" name="{{ $name }}" value="sd fsdf sdf sadr wq3rw2fsd">

    <div class="hidden">{{ $value }}</div>

    <!-- Toolbar -->
    <div class="flex flex-wrap gap-2 p-3 border-b bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
        <!-- Text Formatting -->
        <div class="flex flex-wrap gap-1">
            <button type="button" id="bold" class="p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor" class="dark:text-gray-300"><path d="M253.24-185.3v-589.63h251.69q73.16 0 127.49 44.67 54.34 44.67 54.34 113.87 0 37.04-18.4 70.5t-53.84 51.17v5.76q44.68 14.44 68.46 52.87 23.78 38.44 23.78 82.72 0 72-58.24 120.03-58.24 48.04-137.82 48.04H253.24Zm124.85-109.5h120.3q29.37 0 54.73-19.05 25.36-19.04 25.36-51 0-31.95-25.24-51.12-25.24-19.16-54.61-19.16H378.09v140.33Zm0-244.31h112.3q27.57 0 49.83-17.76 22.26-17.76 22.26-46.28 0-28.28-22.02-46.28-22.03-18-50.31-18H378.09v128.32Z"/></svg>
            </button>
            <button type="button" id="italic" class="p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor" class="dark:text-gray-300"><path d="M215.77-215v-72.31h152.69l129.62-385.38H345.39V-745h366.15v72.31H571.15L441.54-287.31h140.38V-215H215.77Z"/></svg>
            </button>
            <button type="button" id="underline" class="p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor" class="dark:text-gray-300"><path d="M213.85-155v-60h532.3v60h-532.3ZM480-298.85q-93.31 0-145.65-56.65Q282-412.15 282-507.31v-316.15h74.15v319.84q0 60.62 32.23 97.16T480-369.92q59.39 0 91.62-36.54 32.23-36.54 32.23-97.16v-319.84H678v316.15q0 95.16-52.35 151.81-52.34 56.65-145.65 56.65Z"/></svg>
            </button>
        </div>

        <!-- Text Alignment -->
        <div class="flex items-center gap-1">
            <select id="textAlign" class="p-1 rounded cursor-pointer bg-gray-50 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 focus:outline-0 text-xs dark:text-gray-300">
                <option value="justifyLeft">Align Left</option>
                <option value="justifyCenter">Align Center</option>
                <option value="justifyRight">Align Right</option>
                <option value="justifyFull">Justify</option>
            </select>
        </div>

        <!-- Lists -->
        <div class="flex flex-wrap gap-1">
            <button type="button" id="insertUnorderedList" class="p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-xs">
                <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor" class="dark:text-gray-300"><path d="M372.31-210v-60H820v60H372.31Zm0-240v-60H820v60H372.31Zm0-240v-60H820v60H372.31ZM206.54-173.46q-27.45 0-46.99-19.55Q140-212.55 140-240q0-27.45 19.55-46.99 19.54-19.55 46.99-19.55 27.45 0 46.99 19.55 19.55 19.54 19.55 46.99 0 27.45-19.55 46.99-19.54 19.55-46.99 19.55Zm0-240q-27.45 0-46.99-19.55Q140-452.55 140-480q0-27.45 19.55-46.99 19.54-19.55 46.99-19.55 27.45 0 46.99 19.55 19.55 19.54 19.55 46.99 0 27.45-19.55 46.99-19.54 19.55-46.99 19.55Zm0-240q-27.45 0-46.99-19.55Q140-692.55 140-720q0-27.45 19.55-46.99 19.54-19.55 46.99-19.55 27.45 0 46.99 19.55 19.55 19.54 19.55 46.99 0 27.45-19.55 46.99-19.54 19.55-46.99 19.55Z"/></svg>
            </button>
            <button type="button" id="insertOrderedList" class="p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-xs">
                <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor" class="dark:text-gray-300"><path d="M140-100v-47.69h100V-190h-60v-47.69h60V-280H140v-47.69h113.85q14.38 0 24.11 9.73 9.73 9.73 9.73 24.11v47.7q0 14.38-9.73 24.11-9.73 9.73-24.11 9.73 14.38 0 24.11 9.73 9.73 9.73 9.73 24.12v44.61q0 14.39-9.73 24.12T253.85-100H140Zm0-266.15V-470q0-14.38 9.73-24.12 9.73-9.73 24.12-9.73H240v-42.3H140v-47.7h113.85q14.38 0 24.11 9.73 9.73 9.74 9.73 24.12v70q0 14.38-9.73 24.12-9.73 9.73-24.11 9.73h-66.16v42.3h100v47.7H140Zm60-266.16v-180h-60V-860h107.69v227.69H200ZM372.31-210v-60H820v60H372.31Zm0-240v-60H820v60H372.31Zm0-240v-60H820v60H372.31Z"/></svg>
            </button>
        </div>

        <!-- Font Size -->
        <div class="flex items-center gap-1">
            <select id="fontSize" class="p-1 rounded cursor-pointer bg-gray-50 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 focus:outline-0 text-xs dark:text-gray-300">
                <option value="1">Small</option>
                <option value="3" selected>Normal</option>
                <option value="5">Large</option>
                <option value="7">Huge</option>
            </select>
        </div>

        <!-- Font Family -->
        <div class="flex items-center gap-1">
            <select id="fontFamily" class="p-1 rounded cursor-pointer bg-gray-50 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 focus:outline-0 text-xs dark:text-gray-300">
                <option value="Arial">Arial</option>
                <option value="Courier New">Courier New</option>
                <option value="Georgia">Georgia</option>
                <option value="Times New Roman">Times New Roman</option>
                <option value="Verdana">Verdana</option>
            </select>
        </div>

        <!-- Image Upload -->
        <div class="flex items-center gap-1">
            <input type="file" id="imageUpload" accept="image/*" multiple class="hidden">
            <button type="button" id="uploadImageBtn" class="p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-xs">
                <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor" class="dark:text-gray-300"><path d="M212.31-140Q182-140 161-161q-21-21-21-51.31v-535.38Q140-778 161-799q21-21 51.31-21h535.38Q778-820 799-799q21 21 21 51.31v535.38Q820-182 799-161q-21 21-51.31 21H212.31Zm0-60h535.38q4.62 0 8.46-3.85 3.85-3.84 3.85-8.46v-535.38q0-4.62-3.85-8.46-3.84-3.85-8.46-3.85H212.31q-4.62 0-8.46 3.85-3.85 3.84-3.85 8.46v535.38q0 4.62 3.85 8.46 3.84 3.85 8.46 3.85ZM270-290h423.07L561.54-465.38 449.23-319.23l-80-102.31L270-290Zm-70 90v-560 560Z"/></svg>
            </button>
        </div>

        <!-- Paste Options -->
        <div class="flex items-center gap-1">
            <select id="pasteOption" class="p-1 rounded cursor-pointer bg-gray-50 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 focus:outline-0 text-xs dark:text-gray-300">
                <option value="clean">Paste as Clean Text</option>
                <option value="rich">Paste with Formatting</option>
            </select>
        </div>

        <!-- Show HTML -->
        <div class="flex items-center gap-1">
            <button type="button" id="showHTML" class="p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-xs">
                <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor" class="dark:text-gray-300"><path d="M320-253.85 93.85-480 320-706.15l42.77 42.77-184 184L362.15-296 320-253.85Zm320 0-42.77-42.77 184-184L597.85-664 640-706.15 866.15-480 640-253.85Z"/></svg>
            </button>
        </div>

        <!-- Toggle Output Preview -->
        <div class="flex items-center gap-1">
            <button type="button" id="toggleOutput" class="p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-xs">
                <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor" class="dark:text-gray-300"><path d="M480.09-336.92q67.99 0 115.49-47.59t47.5-115.58q0-67.99-47.59-115.49t-115.58-47.5q-67.99 0-115.49 47.59t-47.5 115.58q0 67.99 47.59 115.49t115.58 47.5ZM480-392q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm.05 172q-137.97 0-251.43-76.12Q115.16-372.23 61.54-500q53.62-127.77 167.02-203.88Q341.97-780 479.95-780q137.97 0 251.43 76.12Q844.84-627.77 898.46-500q-53.62 127.77-167.02 203.88Q618.03-220 480.05-220ZM480-500Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
            </button>
        </div>

        <!-- Clear -->
        <div class="flex items-center gap-1">
            <button type="button" id="clear" class="p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-xs">
                <svg xmlns="http://www.w3.org/2000/svg" height="16px" viewBox="0 -960 960 960" width="16px" fill="currentColor" class="dark:text-gray-300"><path d="m376-313.85 104-104 104 104L626.15-356l-104-104 104-104L584-606.15l-104 104-104-104L333.85-564l104 104-104 104L376-313.85ZM292.31-140Q262-140 241-161q-21-21-21-51.31V-720h-40v-60h180v-35.38h240V-780h180v60h-40v507.69Q740-182 719-161q-21 21-51.31 21H292.31ZM680-720H280v507.69q0 4.62 3.85 8.46 3.84 3.85 8.46 3.85h375.38q4.62 0 8.46-3.85 3.85-3.84 3.85-8.46V-720Zm-400 0v520-520Z"/></svg>
            </button>
        </div>
    </div>

    <!-- Editor Area -->
    <div class="">
        <div id="content-editor" class="p-4 bg-white dark:bg-gray-900 min-h-[300px] max-h-[500px] overflow-y-auto text-xs prose prose-sm max-w-none dark:prose-invert focus:outline-0" contenteditable="true"></div>

        <!-- Output Section -->
        <div class="mt-6 px-3 mb-4 hidden" id="outputSection">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-xs font-semibold dark:text-gray-300">Output Preview</h2>
            </div>
            <div id="output" class="border rounded p-4 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 min-h-20 text-xs prose prose-sm max-w-none dark:prose-invert">
                Your formatted content will appear here
            </div>
        </div>

        <!-- HTML Code Section -->
        <div class="mt-6 px-3 mb-4 hidden" id="htmlCodeSection">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-xs font-semibold dark:text-gray-300">HTML Code</h2>
            </div>
            <div id="htmlCode" class="border rounded p-4 bg-gray-800 dark:bg-gray-900 text-green-400 font-mono whitespace-pre-wrap overflow-auto text-xs max-h-60 dark:border-gray-600">
            </div>
        </div>
    </div>
</div>

<script>
    // DOM Elements
    const editor = document.getElementById('content-editor');
    const output = document.getElementById('output');
    const outputSection = document.getElementById('outputSection');
    const htmlCodeSection = document.getElementById('htmlCodeSection');
    const htmlCode = document.getElementById('htmlCode');
    const imageUpload = document.getElementById('imageUpload');
    const pasteOption = document.getElementById('pasteOption');

    // Toolbar buttons
    const boldBtn = document.getElementById('bold');
    const italicBtn = document.getElementById('italic');
    const underlineBtn = document.getElementById('underline');
    const textAlignSelect = document.getElementById('textAlign');
    const insertUnorderedListBtn = document.getElementById('insertUnorderedList');
    const insertOrderedListBtn = document.getElementById('insertOrderedList');
    const fontSizeSelect = document.getElementById('fontSize');
    const fontFamilySelect = document.getElementById('fontFamily');
    const uploadImageBtn = document.getElementById('uploadImageBtn');
    const showHTMLBtn = document.getElementById('showHTML');
    const toggleOutputBtn = document.getElementById('toggleOutput');
    const clearBtn = document.getElementById('clear');

    // Image-related variables
    let selectedImage = null;
    let isDragging = false;
    let isResizing = false;
    let dragStartX, dragStartY, initialX, initialY;
    let initialWidth, initialHeight, aspectRatio;

    // Update output when editor content changes
    editor.addEventListener('input', updateOutput);
    editor.addEventListener('paste', handlePaste);
    editor.addEventListener('keyup', updateOutput);
    editor.addEventListener('mouseup', updateOutput);

    // Formatting functions
    function formatText(command, value = null) {
        document.execCommand(command, false, value);
        editor.focus();
        updateOutput();
    }

    // Function to sync editor content with hidden input
    function syncWithHiddenInput() {
        const hiddenInput = document.getElementById('content-input');
        hiddenInput.value = editor.innerHTML;
    }

    // Update output preview and HTML code
    function updateOutput() {
        output.innerHTML = editor.innerHTML;
        // Apply list styling to output
        applyListStyling(output);
        // Re-initialize image controls for new images
        initializeImageControls();
        // Sync with hidden input
        syncWithHiddenInput();
        
        // Update HTML code in real-time if HTML section is visible
        if (!htmlCodeSection.classList.contains('hidden')) {
            htmlCode.textContent = editor.innerHTML;
        }
    }

    /*
    function updateOutput() {
        output.innerHTML = editor.innerHTML;
        // Apply list styling to output
        applyListStyling(output);
        // Re-initialize image controls for new images
        initializeImageControls();
        
        // Update HTML code in real-time if HTML section is visible
        if (!htmlCodeSection.classList.contains('hidden')) {
            htmlCode.textContent = editor.innerHTML;
        }
    }
    */

    // Apply proper list styling
    function applyListStyling(element) {
        // Style unordered lists
        const uls = element.querySelectorAll('ul');
        uls.forEach(ul => {
            ul.classList.add('list-disc', 'pl-6', 'my-2');
            // Style list items
            const lis = ul.querySelectorAll('li');
            lis.forEach(li => {
                li.classList.add('my-1');
            });
        });

        // Style ordered lists
        const ols = element.querySelectorAll('ol');
        ols.forEach(ol => {
            ol.classList.add('list-decimal', 'pl-6', 'my-2');
            // Style list items
            const lis = ol.querySelectorAll('li');
            lis.forEach(li => {
                li.classList.add('my-1');
            });
        });
    }

    // Enhanced paste handler for PDF/DOC content
    function handlePaste(e) {
        e.preventDefault();
        
        const pasteMode = pasteOption.value;
        const clipboardData = e.clipboardData || window.clipboardData;
        
        if (!clipboardData) return;
        
        // Get HTML content if available
        let html = clipboardData.getData('text/html');
        // Get plain text as fallback
        let text = clipboardData.getData('text/plain');
        
        if (pasteMode === 'clean' || !html) {
            // Paste as clean text - remove all formatting
            insertCleanText(text);
        } else {
            // Paste with formatting but clean it up
            insertFormattedContent(html, text);
        }
        
        updateOutput();
    }

    // Insert clean text without formatting
    function insertCleanText(text) {
        // Create a temporary div to parse and clean the text
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = text;
        
        // Get clean text content
        const cleanText = tempDiv.textContent || tempDiv.innerText || '';
        
        // Insert at cursor position
        document.execCommand('insertText', false, cleanText);
    }

    // Insert formatted content with cleanup
    function insertFormattedContent(html, plainText) {
        // Create a temporary container to parse and clean the HTML
        const tempContainer = document.createElement('div');
        tempContainer.innerHTML = html;
        
        // Clean up the content
        cleanContent(tempContainer);
        
        // Get the cleaned HTML
        const cleanedHTML = tempContainer.innerHTML;
        
        // Insert the cleaned HTML
        document.execCommand('insertHTML', false, cleanedHTML);
    }

    // Clean up pasted content from PDF/DOC
    function cleanContent(container) {
        // Remove unwanted attributes from all elements
        const allElements = container.getElementsByTagName('*');
        for (let element of allElements) {
            // Remove style attributes (clean formatting)
            if (pasteOption.value === 'clean') {
                element.removeAttribute('style');
                element.removeAttribute('class');
            }
            
            // Remove unwanted PDF/DOC specific attributes
            element.removeAttribute('lang');
            element.removeAttribute('xml:lang');
            element.removeAttribute('o');
            element.removeAttribute('rsid');
            element.removeAttribute('w');
            
            // Clean up font tags
            if (element.tagName === 'FONT') {
                const span = document.createElement('span');
                span.innerHTML = element.innerHTML;
                if (element.color) span.style.color = element.color;
                if (element.face) span.style.fontFamily = element.face;
                if (element.size) {
                    const size = parseInt(element.size);
                    if (size > 3) span.style.fontSize = 'larger';
                    else if (size < 3) span.style.fontSize = 'smaller';
                }
                element.parentNode.replaceChild(span, element);
            }
            
            // Clean up MS Word specific elements
            if (element.tagName === 'O:P') {
                element.outerHTML = element.innerHTML;
            }
        }
        
        // Remove empty paragraphs and spans
        const emptyElements = container.querySelectorAll('p:empty, span:empty, div:empty');
        for (let element of emptyElements) {
            element.remove();
        }
        
        // Clean up lists and apply proper styling
        const lists = container.querySelectorAll('ul, ol');
        for (let list of lists) {
            // Remove any MS Word specific list classes/attributes
            list.removeAttribute('type');
            list.removeAttribute('start');
            
            // Apply proper list styling
            if (list.tagName === 'UL') {
                list.classList.add('list-disc', 'pl-6', 'my-2');
            } else if (list.tagName === 'OL') {
                list.classList.add('list-decimal', 'pl-6', 'my-2');
            }
            
            // Ensure list items are properly structured
            const items = list.querySelectorAll('li');
            for (let item of items) {
                item.removeAttribute('style');
                item.removeAttribute('class');
                item.classList.add('my-1');
            }
        }
        
        // Clean up images
        const images = container.querySelectorAll('img');
        for (let img of images) {
            // Remove MS Word specific image attributes
            img.removeAttribute('v:shapes');
            img.removeAttribute('style');
            
            // Set reasonable max dimensions
            img.classList.add('max-w-full', 'h-auto');
        }
        
        // Remove MS Word specific comments and meta tags
        const comments = container.querySelectorAll('*');
        for (let element of comments) {
            if (element.nodeType === 8) { // Comment node
                element.remove();
            }
        }
    }

    // Image upload handler - now supports multiple files
    uploadImageBtn.addEventListener('click', () => {
        imageUpload.click();
    });

    imageUpload.addEventListener('change', (e) => {
        const files = e.target.files;
        if (files.length > 0) {
            // Process each selected file
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = (event) => {
                    insertImageWithControls(event.target.result);
                };
                reader.readAsDataURL(file);
            });
            
            // Reset the file input to allow uploading the same files again
            imageUpload.value = '';
        }
    });

    // Function to insert an image with drag/resize controls
    function insertImageWithControls(imageSrc) {
        const container = document.createElement('div');
        container.className = 'inline-block relative m-2';
        
        const img = document.createElement('img');
        img.src = imageSrc;
        img.className = 'max-w-full h-auto cursor-move transition-all border-2 border-dashed border-transparent hover:border-blue-500 max-h-[200px]';
        img.draggable = false;
        
        // Store original dimensions for aspect ratio
        img.onload = function() {
            // Calculate and store the natural aspect ratio
            const naturalAspectRatio = this.naturalWidth / this.naturalHeight;
            this.setAttribute('data-aspect-ratio', naturalAspectRatio);
        };
        
        // Create resize handle
        const resizeHandle = document.createElement('div');
        resizeHandle.className = 'absolute w-3 h-3 bg-blue-500 border border-white rounded-full z-10 cursor-nwse-resize -bottom-1.5 -right-1.5';
        
        container.appendChild(img);
        container.appendChild(resizeHandle);
        
        // Insert at cursor position
        const selection = window.getSelection();
        if (selection.rangeCount > 0) {
            const range = selection.getRangeAt(0);
            range.insertNode(container);
            range.setStartAfter(container);
            selection.removeAllRanges();
            selection.addRange(range);
        } else {
            // Fallback - append to editor
            editor.appendChild(container);
        }
        
        // Setup controls for this image
        setupImageControls(container, img, resizeHandle);
        updateOutput();
    }

    // Set up image controls (dragging and resizing)
    function setupImageControls(container, img, resizeHandle) {
        // Dragging functionality
        container.addEventListener('mousedown', startDrag);
        
        // Resizing functionality
        resizeHandle.addEventListener('mousedown', startResize);
        
        function startDrag(e) {
            if (e.target === resizeHandle) return;
            e.preventDefault();
            e.stopPropagation();
            
            // Deselect all other images
            document.querySelectorAll('.inline-block.relative').forEach(c => {
                c.classList.remove('border-2', 'border-blue-500');
            });
            
            // Select this image
            container.classList.add('border-2', 'border-blue-500');
            selectedImage = container;
            
            isDragging = true;
            dragStartX = e.clientX;
            dragStartY = e.clientY;
            
            // Get current position
            const rect = container.getBoundingClientRect();
            const editorRect = editor.getBoundingClientRect();
            
            initialX = rect.left - editorRect.left;
            initialY = rect.top - editorRect.top;
            
            // Set initial position if not set
            if (!container.style.position || container.style.position === 'static') {
                container.style.position = 'relative';
                container.style.left = initialX + 'px';
                container.style.top = initialY + 'px';
            } else {
                initialX = parseInt(container.style.left) || 0;
                initialY = parseInt(container.style.top) || 0;
            }
            
            document.addEventListener('mousemove', drag);
            document.addEventListener('mouseup', stopDrag);
        }
        
        function drag(e) {
            if (!isDragging) return;
            e.preventDefault();
            
            const dx = e.clientX - dragStartX;
            const dy = e.clientY - dragStartY;
            
            container.style.left = (initialX + dx) + 'px';
            container.style.top = (initialY + dy) + 'px';
        }
        
        function stopDrag() {
            isDragging = false;
            document.removeEventListener('mousemove', drag);
            document.removeEventListener('mouseup', stopDrag);
            updateOutput();
        }
        
        function startResize(e) {
            e.preventDefault();
            e.stopPropagation();
            
            isResizing = true;
            selectedImage = container;
            dragStartX = e.clientX;
            dragStartY = e.clientY;
            initialWidth = img.offsetWidth;
            initialHeight = img.offsetHeight;
            
            // Get the aspect ratio from data attribute or calculate it
            const storedAspectRatio = img.getAttribute('data-aspect-ratio');
            aspectRatio = storedAspectRatio ? parseFloat(storedAspectRatio) : initialWidth / initialHeight;
            
            img.classList.add('border-red-500');
            
            document.addEventListener('mousemove', resize);
            document.addEventListener('mouseup', stopResize);
        }
        
        function resize(e) {
            if (!isResizing) return;
            e.preventDefault();
            
            const dx = e.clientX - dragStartX;
            
            // Calculate new width based on mouse movement
            const newWidth = Math.max(50, initialWidth + dx);
            
            // Calculate new height maintaining aspect ratio
            const newHeight = newWidth / aspectRatio;
            
            // Apply the new dimensions
            img.style.width = newWidth + 'px';
            img.style.height = newHeight + 'px';
        }
        
        function stopResize() {
            isResizing = false;
            img.classList.remove('border-red-500');
            document.removeEventListener('mousemove', resize);
            document.removeEventListener('mouseup', stopResize);
            updateOutput();
        }
    }

    // Initialize image controls for existing images
    function initializeImageControls() {
        document.querySelectorAll('.inline-block.relative').forEach(container => {
            const img = container.querySelector('img');
            const resizeHandle = container.querySelector('.absolute');
            
            if (img && resizeHandle) {
                // Remove existing event listeners by cloning
                const newContainer = container.cloneNode(true);
                const newImg = newContainer.querySelector('img');
                const newResizeHandle = newContainer.querySelector('.absolute');
                
                container.parentNode.replaceChild(newContainer, container);
                
                // Setup controls for the new container
                setupImageControls(newContainer, newImg, newResizeHandle);
            }
        });
    }

    // Show HTML code with real-time updates
    showHTMLBtn.addEventListener('click', () => {
        if (showHTMLBtn.classList.contains('active')) {
            showHTMLBtn.classList.remove('active', 'bg-gray-300', 'dark:bg-gray-600');
            htmlCodeSection.classList.add('hidden');
        } else {
            showHTMLBtn.classList.add('active', 'bg-gray-300', 'dark:bg-gray-600');
            htmlCode.textContent = editor.innerHTML;
            htmlCodeSection.classList.remove('hidden');
            // Start real-time updates
            startRealTimeHTMLUpdates();
        }
    });

    // Toggle output preview
    toggleOutputBtn.addEventListener('click', () => {
        if (toggleOutputBtn.classList.contains('active')) {
            toggleOutputBtn.classList.remove('active', 'bg-gray-300', 'dark:bg-gray-600');
            outputSection.classList.add('hidden');
        } else {
            toggleOutputBtn.classList.add('active', 'bg-gray-300', 'dark:bg-gray-600');
            outputSection.classList.remove('hidden');
            updateOutput();
        }
    });

    // Clear editor
    clearBtn.addEventListener('click', () => {
        if (!confirm('Are you sure you want to clear the editor?')) {
            return;
        }

        editor.innerHTML = '';
        updateOutput();
        htmlCodeSection.classList.add('hidden');
        outputSection.classList.add('hidden');
        toggleOutputBtn.classList.remove('active', 'bg-gray-300');
        showHTMLBtn.classList.remove('active', 'bg-gray-300');
    });


    // Start real-time HTML updates
    function startRealTimeHTMLUpdates() {
        // The updateOutput function already handles real-time updates
        // when the HTML section is visible
    }

    // Button event listeners
    boldBtn.addEventListener('click', () => formatText('bold'));
    italicBtn.addEventListener('click', () => formatText('italic'));
    underlineBtn.addEventListener('click', () => formatText('underline'));
    
    textAlignSelect.addEventListener('change', (e) => {
        formatText(e.target.value);
    });
    
    insertUnorderedListBtn.addEventListener('click', () => {
        formatText('insertUnorderedList');
        // Apply list styling after a short delay
        setTimeout(() => {
            applyListStyling(editor);
            updateOutput();
        }, 10);
    });
    
    insertOrderedListBtn.addEventListener('click', () => {
        formatText('insertOrderedList');
        // Apply list styling after a short delay
        setTimeout(() => {
            applyListStyling(editor);
            updateOutput();
        }, 10);
    });
    
    fontSizeSelect.addEventListener('change', (e) => {
        formatText('fontSize', e.target.value);
    });
    
    fontFamilySelect.addEventListener('change', (e) => {
        formatText('fontName', e.target.value);
    });

    // Initialize output and image controls
    updateOutput();

    // Add click event to deselect images when clicking elsewhere
    editor.addEventListener('click', (e) => {
        if (!e.target.closest('.inline-block.relative')) {
            document.querySelectorAll('.inline-block.relative').forEach(container => {
                container.classList.remove('border-2', 'border-blue-500');
            });
        }
    });

    // Apply initial list styling
    applyListStyling(editor);
    applyListStyling(output);

    function initializeEditor() {
        const hiddenInput = document.getElementById('content-input');
        // console.log('Hidden input value:', hiddenInput.value);

        if (hiddenInput && hiddenInput.value) {
            // Use insertHTML to properly render the HTML content
            editor.innerHTML = hiddenInput.value;

            // Apply list styling to the initial content
            applyListStyling(editor);

            // Initialize image controls for any existing images
            initializeImageControls();

            // Update output preview
            output.innerHTML = editor.innerHTML;
            applyListStyling(output);
        }
    }

    initializeEditor();

    // Call initialization when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeEditor);
    } else {
        initializeEditor();
    }
</script>