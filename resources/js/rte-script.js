const editor = document.getElementById("editor");

const tagToClassesMap = {
    'H1': ['text-2xl', 'font-semibold'],
    'H2': ['text-xl', 'font-semibold'],
    'H3': ['text-lg', 'font-semibold'],
    'H4': ['text-base', 'font-semibold'],
    'H5': ['text-sm', 'font-semibold'],
    'H6': ['text-xs', 'font-semibold'],
    'P': ['text-sm'],
};

const hoverClasses = ['outline', 'outline-2', 'outline-indigo-700', 'dark:outline-gray-500'];

let isSourceMode = false;

const svgClasses = 'w-4 h-4';
const dropdownCaretClasses = 'w-3 h-3';

const svgs = {
    'alignLeft': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M160-120q-17 0-28.5-11.5T120-160q0-17 11.5-28.5T160-200h640q17 0 28.5 11.5T840-160q0 17-11.5 28.5T800-120H160Zm0-160q-17 0-28.5-11.5T120-320q0-17 11.5-28.5T160-360h400q17 0 28.5 11.5T600-320q0 17-11.5 28.5T560-280H160Zm0-160q-17 0-28.5-11.5T120-480q0-17 11.5-28.5T160-520h640q17 0 28.5 11.5T840-480q0 17-11.5 28.5T800-440H160Zm0-160q-17 0-28.5-11.5T120-640q0-17 11.5-28.5T160-680h400q17 0 28.5 11.5T600-640q0 17-11.5 28.5T560-600H160Zm0-160q-17 0-28.5-11.5T120-800q0-17 11.5-28.5T160-840h640q17 0 28.5 11.5T840-800q0 17-11.5 28.5T800-760H160Z"/></svg>`,

    'alignCenter': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M160-120q-17 0-28.5-11.5T120-160q0-17 11.5-28.5T160-200h640q17 0 28.5 11.5T840-160q0 17-11.5 28.5T800-120H160Zm160-160q-17 0-28.5-11.5T280-320q0-17 11.5-28.5T320-360h320q17 0 28.5 11.5T680-320q0 17-11.5 28.5T640-280H320ZM160-440q-17 0-28.5-11.5T120-480q0-17 11.5-28.5T160-520h640q17 0 28.5 11.5T840-480q0 17-11.5 28.5T800-440H160Zm160-160q-17 0-28.5-11.5T280-640q0-17 11.5-28.5T320-680h320q17 0 28.5 11.5T680-640q0 17-11.5 28.5T640-600H320ZM160-760q-17 0-28.5-11.5T120-800q0-17 11.5-28.5T160-840h640q17 0 28.5 11.5T840-800q0 17-11.5 28.5T800-760H160Z"/></svg>`,

    'alignRight': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M160-760q-17 0-28.5-11.5T120-800q0-17 11.5-28.5T160-840h640q17 0 28.5 11.5T840-800q0 17-11.5 28.5T800-760H160Zm240 160q-17 0-28.5-11.5T360-640q0-17 11.5-28.5T400-680h400q17 0 28.5 11.5T840-640q0 17-11.5 28.5T800-600H400ZM160-440q-17 0-28.5-11.5T120-480q0-17 11.5-28.5T160-520h640q17 0 28.5 11.5T840-480q0 17-11.5 28.5T800-440H160Zm240 160q-17 0-28.5-11.5T360-320q0-17 11.5-28.5T400-360h400q17 0 28.5 11.5T840-320q0 17-11.5 28.5T800-280H400ZM160-120q-17 0-28.5-11.5T120-160q0-17 11.5-28.5T160-200h640q17 0 28.5 11.5T840-160q0 17-11.5 28.5T800-120H160Z"/></svg>`,

    'alignJustify': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M160-120q-17 0-28.5-11.5T120-160q0-17 11.5-28.5T160-200h640q17 0 28.5 11.5T840-160q0 17-11.5 28.5T800-120H160Zm0-160q-17 0-28.5-11.5T120-320q0-17 11.5-28.5T160-360h640q17 0 28.5 11.5T840-320q0 17-11.5 28.5T800-280H160Zm0-160q-17 0-28.5-11.5T120-480q0-17 11.5-28.5T160-520h640q17 0 28.5 11.5T840-480q0 17-11.5 28.5T800-440H160Zm0-160q-17 0-28.5-11.5T120-640q0-17 11.5-28.5T160-680h640q17 0 28.5 11.5T840-640q0 17-11.5 28.5T800-600H160Zm0-160q-17 0-28.5-11.5T120-800q0-17 11.5-28.5T160-840h640q17 0 28.5 11.5T840-800q0 17-11.5 28.5T800-760H160Z"/></svg>`,

    'bold': `<svg class="${svgClasses}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5h4.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0-7H6m2 7h6.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0 0H6"/></svg>`,

    'code': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m193-479 155 155q11 11 11 28t-11 28q-11 11-28 11t-28-11L108-452q-6-6-8.5-13T97-480q0-8 2.5-15t8.5-13l184-184q12-12 28.5-12t28.5 12q12 12 12 28.5T349-635L193-479Zm574-2L612-636q-11-11-11-28t11-28q11-11 28-11t28 11l184 184q6 6 8.5 13t2.5 15q0 8-2.5 15t-8.5 13L668-268q-12 12-28 11.5T612-269q-12-12-12-28.5t12-28.5l155-155Z"/></svg>`,

    'dropdownCaret': `<svg class="${dropdownCaretClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-361q-8 0-15-2.5t-13-8.5L268-556q-11-11-11-28t11-28q11-11 28-11t28 11l156 156 156-156q11-11 28-11t28 11q11 11 11 28t-11 28L508-372q-6 6-13 8.5t-15 2.5Z"/></svg>`,

    'formatTextColor': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-200v-80h560v80H200Zm76-160 164-440h80l164 440h-76l-38-112H392l-40 112h-76Zm138-176h132l-64-182h-4l-64 182Z"/></svg>`,

    'formatHighlighter': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M80 0v-160h800V0H80Zm504-480L480-584 320-424l103 104 161-160Zm-47-160 103 103 160-159-104-104-159 160Zm-84-29 216 216-189 190q-24 24-56.5 24T367-263l-27 23H140l126-125q-24-24-25-57.5t23-57.5l189-189Zm0 0 187-187q24-24 56.5-24t56.5 24l104 103q24 24 24 56.5T857-640L669-453 453-669Z"/></svg>`,

    'h1': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-280q-17 0-28.5-11.5T200-320v-320q0-17 11.5-28.5T240-680q17 0 28.5 11.5T280-640v120h160v-120q0-17 11.5-28.5T480-680q17 0 28.5 11.5T520-640v320q0 17-11.5 28.5T480-280q-17 0-28.5-11.5T440-320v-120H280v120q0 17-11.5 28.5T240-280Zm480 0q-17 0-28.5-11.5T680-320v-280h-40q-17 0-28.5-11.5T600-640q0-17 11.5-28.5T640-680h80q17 0 28.5 11.5T760-640v320q0 17-11.5 28.5T720-280Z"/></svg>`,

    'h2': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M160-280q-17 0-28.5-11.5T120-320v-320q0-17 11.5-28.5T160-680q17 0 28.5 11.5T200-640v120h160v-120q0-17 11.5-28.5T400-680q17 0 28.5 11.5T440-640v320q0 17-11.5 28.5T400-280q-17 0-28.5-11.5T360-320v-120H200v120q0 17-11.5 28.5T160-280Zm400 0q-17 0-28.5-11.5T520-320v-120q0-33 23.5-56.5T600-520h160v-80H560q-17 0-28.5-11.5T520-640q0-17 11.5-28.5T560-680h200q33 0 56.5 23.5T840-600v80q0 33-23.5 56.5T760-440H600v80h200q17 0 28.5 11.5T840-320q0 17-11.5 28.5T800-280H560Z"/></svg>`,

    'h3': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M160-280q-17 0-28.5-11.5T120-320v-320q0-17 11.5-28.5T160-680q17 0 28.5 11.5T200-640v120h160v-120q0-17 11.5-28.5T400-680q17 0 28.5 11.5T440-640v320q0 17-11.5 28.5T400-280q-17 0-28.5-11.5T360-320v-120H200v120q0 17-11.5 28.5T160-280Zm400 0q-17 0-28.5-11.5T520-320q0-17 11.5-28.5T560-360h200v-80H640q-17 0-28.5-11.5T600-480q0-17 11.5-28.5T640-520h120v-80H560q-17 0-28.5-11.5T520-640q0-17 11.5-28.5T560-680h200q33 0 56.5 23.5T840-600v240q0 33-23.5 56.5T760-280H560Z"/></svg>`,

    'hr': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-440q-17 0-28.5-11.5T160-480q0-17 11.5-28.5T200-520h560q17 0 28.5 11.5T800-480q0 17-11.5 28.5T760-440H200Z"/></svg>`,

    'image': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0 0v-560 560Zm80-80h400q12 0 18-11t-2-21L586-459q-6-8-16-8t-16 8L450-320l-74-99q-6-8-16-8t-16 8l-80 107q-8 10-2 21t18 11Z"/></svg>`,

    'italic': `<svg class="${svgClasses}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8.874 19 6.143-14M6 19h6.33m-.66-14H18"/></svg>`,

    'keyboardReturn': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-240 120-480l240-240 56 56-144 144h488v-160h80v240H272l144 144-56 56Z"/></svg>`,

    'listBulleted': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M400-200q-17 0-28.5-11.5T360-240q0-17 11.5-28.5T400-280h400q17 0 28.5 11.5T840-240q0 17-11.5 28.5T800-200H400Zm0-240q-17 0-28.5-11.5T360-480q0-17 11.5-28.5T400-520h400q17 0 28.5 11.5T840-480q0 17-11.5 28.5T800-440H400Zm0-240q-17 0-28.5-11.5T360-720q0-17 11.5-28.5T400-760h400q17 0 28.5 11.5T840-720q0 17-11.5 28.5T800-680H400ZM200-160q-33 0-56.5-23.5T120-240q0-33 23.5-56.5T200-320q33 0 56.5 23.5T280-240q0 33-23.5 56.5T200-160Zm0-240q-33 0-56.5-23.5T120-480q0-33 23.5-56.5T200-560q33 0 56.5 23.5T280-480q0 33-23.5 56.5T200-400Zm0-240q-33 0-56.5-23.5T120-720q0-33 23.5-56.5T200-800q33 0 56.5 23.5T280-720q0 33-23.5 56.5T200-640Z"/></svg>`,

    'listNumbered': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M150-80q-13 0-21.5-8.5T120-110q0-13 8.5-21.5T150-140h70v-30h-30q-13 0-21.5-8.5T160-200q0-13 8.5-21.5T190-230h30v-30h-70q-13 0-21.5-8.5T120-290q0-13 8.5-21.5T150-320h90q17 0 28.5 11.5T280-280v40q0 17-11.5 28.5T240-200q17 0 28.5 11.5T280-160v40q0 17-11.5 28.5T240-80h-90Zm0-280q-13 0-21.5-8.5T120-390v-80q0-17 11.5-28.5T160-510h60v-30h-70q-13 0-21.5-8.5T120-570q0-13 8.5-21.5T150-600h90q17 0 28.5 11.5T280-560v70q0 17-11.5 28.5T240-450h-60v30h70q13 0 21.5 8.5T280-390q0 13-8.5 21.5T250-360H150Zm60-280q-13 0-21.5-8.5T180-670v-150h-30q-13 0-21.5-8.5T120-850q0-13 8.5-21.5T150-880h60q13 0 21.5 8.5T240-850v180q0 13-8.5 21.5T210-640Zm190 440q-17 0-28.5-11.5T360-240q0-17 11.5-28.5T400-280h400q17 0 28.5 11.5T840-240q0 17-11.5 28.5T800-200H400Zm0-240q-17 0-28.5-11.5T360-480q0-17 11.5-28.5T400-520h400q17 0 28.5 11.5T840-480q0 17-11.5 28.5T800-440H400Zm0-240q-17 0-28.5-11.5T360-720q0-17 11.5-28.5T400-760h400q17 0 28.5 11.5T840-720q0 17-11.5 28.5T800-680H400Z"/></svg>`,

    'paragraph': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M400-160q-17 0-28.5-11.5T360-200v-200q-83 0-141.5-58.5T160-600q0-83 58.5-141.5T360-800h320q17 0 28.5 11.5T720-760q0 17-11.5 28.5T680-720h-40v520q0 17-11.5 28.5T600-160q-17 0-28.5-11.5T560-200v-520H440v520q0 17-11.5 28.5T400-160Z"/></svg>`,

    'redo': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M648-560H396q-63 0-109.5 40T240-420q0 60 46.5 100T396-280h244q17 0 28.5 11.5T680-240q0 17-11.5 28.5T640-200H396q-97 0-166.5-63T160-420q0-94 69.5-157T396-640h252l-76-76q-11-11-11-28t11-28q11-11 28-11t28 11l144 144q6 6 8.5 13t2.5 15q0 8-2.5 15t-8.5 13L628-428q-11 11-28 11t-28-11q-11-11-11-28t11-28l76-76Z"/></svg>`,

    'strikethrough': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M486-160q-63 0-116.5-33.5T285-283q-9-16-2.5-33.5T306-343q18-10 37.5-3.5T374-322q18 30 48.5 48t65.5 18q44 0 76.5-27t32.5-69q0-20 14-34t34-14q20 0 34.5 14t14.5 34v12q0 79-62.5 129.5T486-160ZM120-480q-17 0-28.5-11.5T80-520q0-17 11.5-28.5T120-560h720q17 0 28.5 11.5T880-520q0 17-11.5 28.5T840-480H120Zm208-165q-17-10-23-29.5t4-36.5q25-47 72-71t101-24q48 0 90.5 20t71.5 58q11 14 7 32t-19 29q-17 12-36.5 9T562-677q-15-17-35-25t-43-8q-27 0-52 11t-38 34q-10 18-29.5 24t-36.5-4Z"/></svg>`,

    'table': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm240-240H200v160h240v-160Zm80 0v160h240v-160H520Zm-80-80v-160H200v160h240Zm80 0h240v-160H520v160ZM200-680h560v-80H200v80Z"/></svg>`,

    'underline': `<svg class="${svgClasses}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M6 19h12M8 5v9a4 4 0 0 0 8 0V5M6 5h4m4 0h4"/></svg>`,

    'undo': `<svg class="${svgClasses}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M320-200q-17 0-28.5-11.5T280-240q0-17 11.5-28.5T320-280h244q63 0 109.5-40T720-420q0-60-46.5-100T564-560H312l76 76q11 11 11 28t-11 28q-11 11-28 11t-28-11L188-572q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l144-144q11-11 28-11t28 11q11 11 11 28t-11 28l-76 76h252q97 0 166.5 63T800-420q0 94-69.5 157T564-200H320Z"/></svg>`,
};

document.addEventListener('DOMContentLoaded', function () {
    // console.log('here from rte toolbar');

    function richTextEditor() {
        // const textarea = document.getElementById("editor");

        if (editor) {
            const wrapper = document.createElement('div');
            wrapper.className = 'w-full border border-gray-200 rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600 focus-within:ring-1 focus-within:ring-primary-500 focus-within:dark:ring-primary-600 focus-within:border-primary-500 focus-within:dark:border-primary-600 rounded-md shadow-sm';

            // Toolbar div
            const toolbar = document.createElement('div');
            toolbar.id = 'toolbar';
            toolbar.className = 'rounded bg-gray-50 dark:bg-gray-700 px-1 flex items-center space-x-1 rtl:space-x-reverse flex-wrap min-h-[30px]';
            wrapper.appendChild(toolbar);

            // Contenteditable div
            const editorDiv = document.createElement('div');
            editorDiv.id = 'editor';
            editorDiv.setAttribute('contenteditable', 'true');
            editorDiv.setAttribute('onkeyup', 'updateToolbar()');
            editorDiv.setAttribute('onmouseup', 'updateToolbar()');
            editorDiv.className = 'p-3 rounded min-h-20 block w-full text-sm text-gray-800 bg-white border-0 dark:bg-gray-900 dark:text-white dark:placeholder-gray-400 shadow-sm border-gray-300 dark:border-gray-700 focus:outline-0 overflow-hidden';
            editorDiv.innerHTML = '<p>&nbsp;</p>'; // Add an empty paragraph
            wrapper.appendChild(editorDiv);

            // Hidden input
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = editor.getAttribute('name');
            hiddenInput.id = 'hiddenDescription';

            editor.parentNode.insertBefore(wrapper, editor);
            editor.parentNode.insertBefore(hiddenInput, editor);
            // check for old/ existing value
            if (document.querySelector('input[name="existingDescription"]')) {
                const existingValue = document.querySelector('input[name="existingDescription"]').value;
                if (existingValue.length > 0) {
                    editorDiv.innerHTML = existingValue;
                    hiddenInput.value = existingValue;
                }
            }
            // removing ORIGINAL editor
            editor.remove()
            // editor.style.display = 'none'; // Hide the original textarea

            // Sync contenteditable div with hidden input
            // editorDiv.addEventListener('input', () => {
            //     hiddenInput.value = editorDiv.innerHTML;
            // });
        }
    }

    richTextEditor();

    // whatever written in editor, auto saved into hidden input
    document.getElementById('editor').addEventListener('input', function() {
        document.getElementById('hiddenDescription').value = document.getElementById('editor').innerHTML;
    });

    const toolbar = document.getElementById("toolbar");

    const tailwindColorClasses = [
        'red-200', 'red-300', 'red-400', 'red-700', 'red-800', 'red-900',
        'yellow-200', 'yellow-300', 'yellow-400', 'yellow-600', 'yellow-800', 'yellow-900',
        'lime-200', 'lime-300', 'lime-500', 'lime-700', 'lime-800', 'lime-900',
        'teal-200', 'teal-300', 'teal-500', 'teal-700', 'teal-800', 'teal-900',
        'blue-200', 'blue-300', 'blue-500', 'blue-700', 'blue-800', 'blue-900',
        'violet-200', 'violet-300', 'violet-500', 'violet-700', 'violet-800', 'violet-900',
        'fuchsia-200', 'fuchsia-300', 'fuchsia-500', 'fuchsia-700', 'fuchsia-800', 'fuchsia-900',
        'pink-200', 'pink-300', 'pink-500', 'pink-700', 'pink-800', 'pink-900',
        'stone-300', 'stone-400', 'stone-500', 'stone-700', 'stone-800', 'stone-900',
        'white', 'gray-400', 'gray-500', 'gray-700', 'gray-800', 'gray-900',
    ];

    const toolbarButtons = [
        {
            'name': 'Title',
            'text': 'Title',
            'type': 'dropdown',
            'data': [
                { 'name': 'Paragraph', 'text': 'Paragraph', 'type': 'button', 'id': 'pBtn', 'onclick': 'setHeading("p")', 'icon': svgs.paragraph },
                { 'name': 'Heading 1', 'text': '24px', 'type': 'button', 'id': 'h1Btn', 'onclick': 'setHeading("h1")', 'icon': svgs.h1, 'extraClasses': ['!text-2xl', '!font-semibold'] },
                { 'name': 'Heading 2', 'text': '20px', 'type': 'button', 'id': 'h2Btn', 'onclick': 'setHeading("h2")', 'icon': svgs.h2, 'extraClasses': ['!text-xl', '!font-semibold'] },
                { 'name': 'Heading 3', 'text': '18px', 'type': 'button', 'id': 'h3Btn', 'onclick': 'setHeading("h3")', 'icon': svgs.h3, 'extraClasses': ['!text-lg', '!font-semibold'] }
            ]
        },
        'seperator',
        {
            'name': 'Font',
            'text': 'Font',
            'type': 'dropdown',
            'data': [
                { 'name': 'Arial', 'text': 'Arial', 'type': 'button', 'id': 'arialFontBtn', 'onclick': 'changeFont("Arial")', 'extraClasses': ['font-[arial]'] },
                { 'name': 'Times New Roman', 'text': 'Times New Roman', 'type': 'button', 'id': 'timesNewRomanFontBtn', 'onclick': 'changeFont("Times New Roman")', 'extraClasses': ['font-[times-new-roman]'] },
                { 'name': 'Comic Sans MS', 'text': 'Comic Sans MS', 'type': 'button', 'id': 'comicSansMsFontBtn', 'onclick': 'changeFont("Comic Sans MS")', 'extraClasses': ['font-[comic-sans-ms]'] },
                { 'name': 'Impact', 'text': 'Impact', 'type': 'button', 'id': 'ImpactFontBtn', 'onclick': 'changeFont("Impact")', 'extraClasses': ['font-[impact]'] }
            ]
        },
        'seperator',
        { 'name': 'Bold', 'type': 'button', 'id': 'boldBtn', 'onclick': 'execCmd("bold")', 'icon': svgs.bold },
        { 'name': 'Italic', 'type': 'button', 'id': 'italicBtn', 'onclick': 'execCmd("italic")', 'icon': svgs.italic },
        { 'name': 'Underline', 'type': 'button', 'id': 'underlineBtn', 'onclick': 'execCmd("underline")', 'icon': svgs.underline },
        { 'name': 'Strikethrough', 'type': 'button', 'id': 'strikeBtn', 'onclick': 'execCmd("strikeThrough")', 'icon': svgs.strikethrough },
        {
            'name': 'Text color',
            'id': 'textColorBtn',
            'icon': svgs.formatTextColor,
            'type': 'textColor'
        },
        {
            'name': 'Background color',
            'id': 'bgColorBtn',
            'icon': svgs.formatHighlighter,
            'type': 'backgroundColor'
        },
        'seperator',
        { 'name': 'Align Left', 'type': 'button', 'id': 'leftAlignBtn', 'onclick': 'execCmd("justifyLeft")', 'icon': svgs.alignLeft },
        { 'name': 'Align Center', 'type': 'button', 'id': 'centerAlignBtn', 'onclick': 'execCmd("justifyCenter")', 'icon': svgs.alignCenter },
        { 'name': 'Align Right', 'type': 'button', 'id': 'rightAlignBtn', 'onclick': 'execCmd("justifyRight")', 'icon': svgs.alignRight },
        { 'name': 'Align Justify', 'type': 'button', 'id': 'justifyAlignBtn', 'onclick': 'execCmd("justifyFull")', 'icon': svgs.alignJustify },
        'seperator',
        { 'name': 'Unordered List', 'type': 'button', 'id': 'listBulletedBtn', 'onclick': 'insertUnorderedList()', 'icon': svgs.listBulleted },
        { 'name': 'Ordered List', 'type': 'button', 'id': 'listNumberedBtn', 'onclick': 'insertOrderedList()', 'icon': svgs.listNumbered },
        'seperator',
        { 'name': 'Horizontal Ruler', 'type': 'button', 'id': 'hrBtn', 'onclick': 'insertHR()', 'icon': svgs.hr },
        'seperator',
        {
            'name': 'Image upload',
            'id': 'imageUploadBtn',
            'icon': svgs.image,
            'type': 'imageUpload'
        },
        'seperator',
        {
            'name': 'Insert Table',
            'id': 'insertTableBtn',
            'icon': svgs.table,
            'type': 'insertTable'
        },
        'seperator',
        { 'name': 'Undo', 'type': 'button', 'id': 'undoBtn', 'onclick': 'execCmd("undo")', 'icon': svgs.undo },
        { 'name': 'Redo', 'type': 'button', 'id': 'redoBtn', 'onclick': 'execCmd("redo")', 'icon': svgs.redo },
        'seperator',
        { 'name': 'Source', 'type': 'button', 'id': 'toggleSourceBtn', 'onclick': 'toggleSource()', 'icon': svgs.code },
    ];

    function renderToolbar() {
        toolbarButtons.forEach(item => {
            if (item == 'seperator') {
                const sep = document.createElement('div');
                sep.classList.add('mx-2', 'h-[20px]', 'bg-gray-300', 'dark:bg-gray-500', 'w-[1px]');
                toolbar.appendChild(sep);
            } else if (item.type === 'button') {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.classList.add('text-sm', 'p-1.5', 'text-gray-500', 'rounded-sm', 'cursor-pointer', 'hover:text-gray-900', 'hover:bg-gray-100', 'dark:text-gray-400', 'dark:hover:text-white', 'dark:hover:bg-gray-600');
                btn.innerHTML = item.icon + `<span class="sr-only">${item.name}</span>`;
                btn.id = item.id;
                btn.onclick = () => eval(item.onclick);
                toolbar.appendChild(btn);
            } else if (item.type === 'dropdown') {
                const dropdown = document.createElement('div');
                dropdown.classList.add('relative');
                dropdown.setAttribute('x-data', '{open : false}');

                dropdown.innerHTML = `
                <button type="button" class="text-sm p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 flex space-x-1 items-center" @click="open = !open">
                    <span class="font-medium">${item.text}</span>
                    ${svgs.dropdownCaret}
                </button>
                <div class="absolute left-0 mt-2 w-48 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 shadow-md z-1" x-show="open" x-transition @click.outside="open = false">
                    <ul>
                        ${item.data.map(subItem => `
                            <li>
                                <button id="${subItem.id}" type="button" class="w-full flex space-x-1 items-center p-1.5 text-gray-500 cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600" onclick="${subItem.onclick.replace(/"/g, '&quot;')}" @click="open = false">
                                    <div class="text-sm flex space-x-3 items-center ${subItem.extraClasses ? subItem.extraClasses.join(' ') : ''}">
                                        ${subItem.icon ? subItem.icon : ''}
                                        <p>${subItem.text}</p>
                                    </div>
                                    <span class="sr-only">${subItem.text}</span>
                                </button>
                            </li>
                        `).join('')}
                    </ul>
                </div>
                `;

                toolbar.appendChild(dropdown);
            } else if (item.type === 'textColor' || item.type === 'backgroundColor') {
                const textColor = document.createElement('div');
                textColor.classList.add('relative');
                textColor.id = item.id;
                textColor.setAttribute('x-data', '{open : false}');

                let addColorFuncParam, removeColorLabel;
                if (item.type === 'textColor') {
                    addColorFuncParam = 'text';
                    removeColorLabel = 'Remove Font color';
                } else {
                    addColorFuncParam = 'bg';
                    removeColorLabel = 'Remove Background color';
                }

                textColor.innerHTML = `
                <button type="button" class="text-sm p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 flex space-x-1 items-center" @click="open = !open">
                    <span class="">${item.icon}</span>
                    ${svgs.dropdownCaret}
                </button>
                <div class="absolute left-0 mt-2 w-48 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 shadow-md z-1" x-show="open" x-transition @click.outside="open = false">
                    <div class="grid grid-cols-6 gap-1 p-2 justify-items-center">
                        ${tailwindColorClasses.map(subItem => `
                            <button type="button" class="${svgClasses} border border-gray-700/50 dark:border-gray-50/50 bg-${subItem} cursor-pointer hover:border-2 hover:border-gray-900" onclick="addColor('${addColorFuncParam}-${subItem}')"></button>
                        `).join('')}
                    </div>
                    <button type="button" class="w-full text-xs p-2 dark:text-gray-100 bg-gray-100 dark:bg-gray-700 cursor-pointer text-center hover:bg-gray-200 dark:hover:bg-gray-700 focus:bg-gray-300 dark:focus:bg-gray-800" onclick="removeFontColor()">${removeColorLabel}</button>
                </div>
                `;

                toolbar.appendChild(textColor);
            } else if (item.type === 'imageUpload') {
                const btn = document.createElement('button');
                const input = document.createElement('input');

                // btn
                btn.type = 'button';
                btn.classList.add('text-sm', 'p-1.5', 'text-gray-500', 'rounded-sm', 'cursor-pointer', 'hover:text-gray-900', 'hover:bg-gray-100', 'dark:text-gray-400', 'dark:hover:text-white', 'dark:hover:bg-gray-600');
                btn.innerHTML = item.icon + `<span class="sr-only">${item.name}</span>`;
                btn.id = item.id;
                btn.onclick = () => eval(document.getElementById('imageInput').click());

                // input
                input.type = 'file';
                input.classList.add('hidden');
                input.id = 'imageInput';
                input.setAttribute('accept', 'image/*');
                input.setAttribute('onchange', 'insertImage(event)');
                input.onclick = (e) => e.target.value = null;

                toolbar.appendChild(btn);
                toolbar.appendChild(input);
            } else if (item.type === 'insertTable') {
                const dropdown = document.createElement('div');
                dropdown.classList.add('relative');
                dropdown.setAttribute('x-data', '{ open: false, rows: 0, cols: 0 }');

                dropdown.innerHTML = `
                <button type="button" class="text-sm p-1.5 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 flex space-x-1 items-center" @click="open = !open">
                    <span class="">${item.icon}</span>
                    ${svgs.dropdownCaret}
                </button>
                <div class="absolute left-0 mt-2 w-48 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 shadow-md z-2" x-show="open" x-transition @click.outside="open = false">
                    <div class="grid grid-cols-10 gap-1 p-2 justify-items-center">
                        <template x-for="r in 10">
                            <template x-for="c in 10">
                                <div @mouseenter="rows = r; cols = c"
                                    @click="insertTable(rows, cols); open = false"
                                    class="w-4 h-4 border border-gray-300 dark:border-gray-500 flex items-center justify-center text-xs"
                                    :class="{ 'bg-blue-500 text-white': r <= rows && c <= cols, 'bg-gray-200 dark:bg-gray-600': r > rows || c > cols }">
                                </div>
                            </template>
                        </template>
                    </div>
                    <p class="text-center text-xs text-gray-600 dark:text-gray-300 mb-2">Rows: <span x-text="rows"></span> | Columns: <span x-text="cols"></span></p>
                </div>
                `;

                toolbar.appendChild(dropdown);
            }
        })
    }

    renderToolbar();

});




/**
 * AFTER TOOLBAR IS RENDERED
 */

// function updateToolbar() {
window.updateToolbar = function () {
    document.querySelectorAll('#toolbar button').forEach(button => button.classList.remove('bg-gray-200', 'text-gray-700', 'dark:bg-gray-800', 'dark:text-white'));
    const selection = window.getSelection().anchorNode;
    if (selection) {
        let element = selection.nodeType === 3 ? selection.parentNode : selection;
        // console.log('element:', element.tagName);

        while (element && element !== document.getElementById('editor')) {
            const tag = element.tagName;

            // Heading & Paragraph Button States
            if (tag === 'P') document.getElementById('pBtn')?.classList.add('bg-gray-200', 'text-gray-700', 'dark:bg-gray-800', 'dark:text-white');
            else if (tag === 'H1') document.getElementById('h1Btn')?.classList.add('bg-gray-200', 'text-gray-700', 'dark:bg-gray-800', 'dark:text-white');
            else if (tag === 'H2') document.getElementById('h2Btn')?.classList.add('bg-gray-200', 'text-gray-700', 'dark:bg-gray-800', 'dark:text-white');
            else if (tag === 'H3') document.getElementById('h3Btn')?.classList.add('bg-gray-200', 'text-gray-700', 'dark:bg-gray-800', 'dark:text-white');
            else if (tag === 'H4') document.getElementById('h4Btn')?.classList.add('bg-gray-200', 'text-gray-700', 'dark:bg-gray-800', 'dark:text-white');
            else if (tag === 'H5') document.getElementById('h5Btn')?.classList.add('bg-gray-200', 'text-gray-700', 'dark:bg-gray-800', 'dark:text-white');
            else if (tag === 'H6') document.getElementById('h6Btn')?.classList.add('bg-gray-200', 'text-gray-700', 'dark:bg-gray-800', 'dark:text-white');

            // Text Formatting Button States
            else if (tag === 'B' || tag === 'STRONG') document.getElementById('boldBtn')?.classList.add('bg-gray-200', 'text-gray-700', 'dark:bg-gray-800', 'dark:text-white');
            else if (tag === 'I' || tag === 'EM') document.getElementById('italicBtn')?.classList.add('bg-gray-200', 'text-gray-700', 'dark:bg-gray-800', 'dark:text-white');
            else if (tag === 'U') document.getElementById('underlineBtn')?.classList.add('bg-gray-200', 'text-gray-700', 'dark:bg-gray-800', 'dark:text-white');
            else if (tag === 'STRIKE') document.getElementById('strikeBtn')?.classList.add('bg-gray-200', 'text-gray-700', 'dark:bg-gray-800', 'dark:text-white');

            // Highlight Button State (checks for span with highlight class)
            else if (tag === 'SPAN' && element.classList.contains('bg-yellow-300')) {
                document.getElementById('highlightBtn')?.classList.add('bg-gray-200', 'text-gray-700', 'dark:bg-gray-800', 'dark:text-white');
            }
            element = element.parentNode;
        }
    }
}

// function execCmd(command) {
window.execCmd = function (command) {
    document.execCommand(command, false, null);
    updateToolbar();
    // cleanUpEditor();
}

// function insertHR() {
window.insertHR = function () {
    let hr = document.createElement("hr");
    hr.classList.add("border-gray-300", "my-4", "dark:border-gray-600");

    let selection = window.getSelection();
    if (!selection.rangeCount) return;

    let range = selection.getRangeAt(0);
    range.deleteContents();

    let parent = range.commonAncestorContainer;
    if (parent.nodeType === Node.TEXT_NODE) {
        parent = parent.parentNode;
    }

    range.insertNode(hr);

    // Move the cursor after the HR
    range.setStartAfter(hr);
    range.setEndAfter(hr);
    selection.removeAllRanges();
    selection.addRange(range);
}

// function changeFont(font) {
window.changeFont = function (font) {
    let selection = window.getSelection();
    if (!selection.rangeCount) return;

    let range = selection.getRangeAt(0);
    let span = document.createElement("span");

    span.style.fontFamily = font;
    span.appendChild(range.extractContents());
    
    range.insertNode(span);

    // Move cursor after the inserted span
    range.setStartAfter(span);
    range.setEndAfter(span);
    selection.removeAllRanges();
    selection.addRange(range);
}

// function insertUnorderedList() {
window.insertUnorderedList = function () {
    document.execCommand('insertUnorderedList', false, null);
    styleLists();
}

// function insertOrderedList() {
window.insertOrderedList = function () {
    document.execCommand('insertOrderedList', false, null);
    styleLists();
}

// function styleLists() {
window.styleLists = function () {
    document.querySelectorAll('#editor ul').forEach(ul => {
        ul.classList.add('list-disc', 'list-inside', 'text-gray-700', 'dark:text-gray-300');
    });
    document.querySelectorAll('#editor ol').forEach(ol => {
        ol.classList.add('list-decimal', 'list-inside', 'text-gray-700', 'dark:text-gray-300');
    });
}

// function setHeading(tag) {
window.setHeading = function (tag) {
    const selection = window.getSelection();
    if (selection.rangeCount > 0) {
        const range = selection.getRangeAt(0);
        const selectedText = range.toString();

        if (selectedText) {
            // Create a new element with the specified tag
            const newElement = document.createElement(tag);
            newElement.textContent = selectedText;
            // Delete the selected text and insert the new element
            range.deleteContents();
            range.insertNode(newElement);

            applyTailwindClasses(newElement);
            updateToolbar();
        }
    }
}

// function applyTailwindClasses(element) {
window.applyTailwindClasses = function (element) {
    // console.log('apply TL class element>>', element);

    element.classList.remove('text-sm', 'text-md', 'text-lg', 'text-xl', 'mb-2', 'text-gray-900', 'dark:text-white');
    element.classList.add('mb-2', 'text-gray-900', 'dark:text-white');

    const classes = tagToClassesMap[element.tagName];
    if (classes) {
        element.classList.add(...classes);
    }
}

// function addColor(color) {
window.addColor = function (color) {
    const selection = window.getSelection();
    if (selection.rangeCount > 0) {
        const range = selection.getRangeAt(0);
        const selectedText = range.toString();
        
        if (selectedText) {
            // Create a new element with span tag
            const newElement = document.createElement('span');
            newElement.textContent = selectedText;
            // apply color
            newElement.classList.add(color);
            // Delete selected text and insert new element
            range.deleteContents();
            range.insertNode(newElement);

            // console.log(newElement);
        }
    }
}

// function removeFontColor() {
window.removeFontColor = function () {
    const selection = window.getSelection();
    if (selection.rangeCount > 0) {
        const range = selection.getRangeAt(0);
        const selectedText = range.toString();

        if (selectedText) {
            // Find the closest <span> element that contains the selected text
            let span = range.commonAncestorContainer;
            while (span && span.tagName !== 'SPAN') {
                span = span.parentElement;
            }

            // selectedText, span, span.tagName;
            span.replaceWith(document.createTextNode(span.textContent));

            // if (span.tagName === 'SPAN' && (span.style.color || span.classList.contains('text-'))) {
            //     const textNode = document.createTextNode(span.textContent);
            //     span.replaceWith(textNode);
            // }
        }
    }
}







/**
 * IMAGE HANDLING
 * @param {*} event 
 * @returns 
 */
// function insertImage(event) {
window.insertImage = function (event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
        // Create image element
        const img = document.createElement('img');
        img.src = e.target.result;
        img.setAttribute('alt', 'Inserted Image');
        img.classList.add('block', 'text-center', 'resizable', 'cursor-default', 'max-w-full', 'h-auto');
        img.style.height = '100px';

        // Wrap the image in a figure container
        const figure = document.createElement('figure');
        figure.classList.add('relative', 'inline-block', 'text-center', 'clearfix', 'my-4');
        figure.appendChild(img);
        figure.setAttribute('contenteditable', 'false');

        // Add resize handles for all four corners
        addResizeHandles(figure, img);

        // Create block buttons for adding paragraphs
        const addParagraphTop = createBlockButton(svgs.keyboardReturn, () => addParagraph(figure, 'before'));
        const addParagraphBottom = createBlockButton(svgs.keyboardReturn, () => addParagraph(figure, 'after'));

        // Position the buttons
        addParagraphTop.classList.add('top-0', 'left-1/2', 'transform', '-translate-x-1/2', '-translate-y-full');
        addParagraphBottom.classList.add('bottom-0', 'left-1/2', 'transform', '-translate-x-1/2', 'translate-y-full');

        // Append buttons to the figure
        figure.appendChild(addParagraphTop);
        figure.appendChild(addParagraphBottom);

        // Append the figure container to the editor
        const selection = window.getSelection();
        if (selection.rangeCount > 0) {
            const range = selection.getRangeAt(0);
            range.insertNode(figure);
        } else {
            const editor = document.getElementById('editor');
            editor.appendChild(figure);
        }

        // Add hover effect to the figure
        figure.addEventListener('mouseenter', () => {
            img.classList.add(...hoverClasses);
            addParagraphTop.classList.remove('hidden');
            addParagraphBottom.classList.remove('hidden');
        });

        figure.addEventListener('mouseleave', () => {
            img.classList.remove(...hoverClasses);
            addParagraphTop.classList.add('hidden');
            addParagraphBottom.classList.add('hidden');
        });
    };
    reader.readAsDataURL(file);
}

// function createBlockButton(icon, onClick) {
window.createBlockButton = function (icon, onClick) {
    const button = document.createElement('button');
    button.innerHTML = icon;
    button.classList.add(
        'absolute', 'bg-blue-500', 'text-white', 'p-1',
        'shadow-md', 'hover:bg-blue-600', 'transition', 'duration-200', 'z-50', 'hidden'
    );
    button.addEventListener('click', onClick);
    return button;
}

// function addParagraph(figure, position) {
window.addParagraph = function (figure, position) {
    const paragraph = document.createElement('br');
    // applyTailwindClasses(paragraph);
    // paragraph.classList.add('my-2', 'text-gray-700'); // Add margin and text color
    paragraph.textContent = ''; // Default text

    if (position === 'before') {
        figure.parentNode.insertBefore(paragraph, figure);
    } else if (position === 'after') {
        figure.parentNode.insertBefore(paragraph, figure.nextSibling);
    }
}

// function addResizeHandles(figure, img) {
window.addResizeHandles = function (figure, img) {
    const corners = [
        { position: 'top-left', cursor: 'nwse-resize' },
        { position: 'top-right', cursor: 'nesw-resize' },
        { position: 'bottom-left', cursor: 'nesw-resize' },
        { position: 'bottom-right', cursor: 'nwse-resize' },
    ];

    corners.forEach(({ position, cursor }) => {
        const handle = document.createElement('div');
        handle.classList.add('absolute', 'w-3', 'h-3', 'bg-blue-500', 'cursor-se-resize');
        handle.style[position.split('-')[0]] = '0';
        handle.style[position.split('-')[1]] = '0';
        handle.style.cursor = cursor;
        handle.setAttribute('contenteditable', 'false');
        handle.style.userSelect = 'none';
        handle.style.pointerEvents = 'auto';

        handle.addEventListener('mousedown', (e) => startResize(e, figure, img, position));
        figure.appendChild(handle);
    });
}

function startResize(e, figure, img, corner) {
window.addParagraph = function (e, figure, img, corner) {
    e.preventDefault();
    const rect = figure.getBoundingClientRect();
    const editor = document.getElementById('editor');
    const editorRect = editor.getBoundingClientRect();
    const startX = e.clientX;
    const startY = e.clientY;
    const startWidth = rect.width;
    const startHeight = rect.height;
    const aspectRatio = img.naturalWidth / img.naturalHeight;

    // Create a resize percentage display element
    const resizePercentage = document.createElement('div');
    resizePercentage.classList.add('absolute', 'bg-black', 'text-white', 'text-xs', 'p-1', 'rounded', 'z-50');
    figure.appendChild(resizePercentage);

    // function resize(e) {
    window.resize = function (e) {
        requestAnimationFrame(() => {
            const deltaX = e.clientX - startX;
            const deltaY = e.clientY - startY;

            let newWidth = startWidth + (corner.includes('left') ? -deltaX : deltaX);
            let newHeight = newWidth / aspectRatio;

            // Ensure the newWidth is no less than 1% of the original image width
            const minWidth = img.naturalWidth * 0.01; // 1% of the original image width
            newWidth = Math.max(newWidth, minWidth);
            newHeight = Math.max(newHeight, newWidth / aspectRatio);

            // Prevent resizing beyond the editor bounds
            newWidth = Math.min(newWidth, editorRect.width - (rect.left - editorRect.left));

            // Apply new dimensions
            img.style.width = `${newWidth}px`;
            img.style.height = `${newHeight}px`;

            // Adjust editor height if the image exceeds the bottom boundary
            if (rect.bottom + newHeight - startHeight > editorRect.bottom) {
                const additionalHeight = rect.bottom + newHeight - startHeight - editorRect.bottom;
                editor.style.height = `${editorRect.height + additionalHeight}px`;
            }

            // Calculate and display resize percentage
            const resizePercent = Math.round((newWidth / editorRect.width) * 100);
            resizePercentage.textContent = `${resizePercent}%`;
            resizePercentage.style.top = `${-20}px`;
            resizePercentage.style.left = '50%';
            resizePercentage.style.transform = 'translateX(-50%)';
        });
    }

    // function stopResize() {
    window.stopResize = function () {
        document.removeEventListener('mousemove', resize);
        document.removeEventListener('mouseup', stopResize);
        resizePercentage.remove();
    }

    document.addEventListener('mousemove', resize);
    document.addEventListener('mouseup', stopResize);
}
}






/**
 * TABLE
 */
// function insertTable(rows, cols) {
window.insertTable = function (rows, cols) {
    let tableHTML = `
    <br>
    <table class="w-full border border-gray-300 dark:border-gray-600 mt-2 mb-2">`;
    for (let i = 0; i < rows; i++) {
        tableHTML += '<tr>';
        for (let j = 0; j < cols; j++) {
            tableHTML += '<td class="border border-gray-300 dark:border-gray-600 px-2 py-1">&nbsp;</td>';
        }
        tableHTML += '</tr>';
    }
    tableHTML += `</table>
    <br>`;

    editor.focus();
    document.execCommand('insertHTML', false, tableHTML);
}

// function createTableButtons(table) {
window.createTableButtons = function (table) {
    const topButton = document.createElement('button');
    const bottomButton = document.createElement('button');

    topButton.innerText = '➕ Add Above';
    bottomButton.innerText = '➕ Add Below';

    topButton.className = 'table-btn absolute -top-6 left-1/2 transform -translate-x-1/2 bg-indigo-600 text-white text-xs px-2 py-1 rounded hidden';
    bottomButton.className = 'table-btn absolute -bottom-6 left-1/2 transform -translate-x-1/2 bg-indigo-600 text-white text-xs px-2 py-1 rounded hidden';

    // Position the buttons inside the table container
    table.style.position = 'relative';
    table.parentElement.insertBefore(topButton, table);
    table.parentElement.insertBefore(bottomButton, table.nextSibling);

    // Add event listeners to buttons
    topButton.addEventListener('click', (e) => {
        e.stopPropagation();
        const p = document.createElement('p');
        p.innerHTML = '&nbsp;';
        table.parentElement.insertBefore(p, table);
    });

    bottomButton.addEventListener('click', (e) => {
        e.stopPropagation();
        const p = document.createElement('p');
        p.innerHTML = '&nbsp;';
        table.parentElement.insertBefore(p, table.nextSibling);
    });

    return { topButton, bottomButton };
}

editor.addEventListener('mouseover', (event) => {
    let table = event.target.closest('table');
    if (table && !table.dataset.hasButtons) {
        table.classList.add(...hoverClasses);

        // Create buttons for this table if they don't exist
        const { topButton, bottomButton } = createTableButtons(table);
        topButton.classList.remove('hidden');
        bottomButton.classList.remove('hidden');

        // Mark table to avoid duplicate buttons
        table.dataset.hasButtons = "true";

        // Remove buttons when leaving the table
        table.addEventListener('mouseleave', () => {
            table.classList.remove(...hoverClasses);
            setTimeout(() => {
                topButton.remove();
                bottomButton.remove();
                delete table.dataset.hasButtons;
            }, 200);
        });
    }
});





/**
 * SOURCE CODE
 */
// function toggleSource() {
window.toggleSource = function () {
    if (!isSourceMode) {
        // --- SWITCH TO SOURCE (HTML) MODE ---
        // Get the current HTML content of the editor
        const currentHTML = editor.innerHTML;
        document.getElementById('toggleSourceBtn').classList.add('bg-gray-200', 'text-gray-800', 'hover:bg-gray-300', 'dark:bg-gray-600', 'dark:text-gray-50', 'dark:hover:bg-gray-800');

        // Create a textarea to display the HTML source
        const textarea = document.createElement('textarea');
        textarea.id = 'editor-source';
        textarea.classList.add('w-full', 'text-xs', 'h-64', 'p-2', 'border', 'border-gray-300', 'dark:border-gray-600', 'rounded', 'resize-none', 'focus:outline-none', 'dark:bg-gray-800', 'dark:text-gray-300', 'focus:border-primary-500', 'dark:focus:border-primary-600', 'focus:outline-0', 'focus:ring-2', 'focus:ring-primary-500', 'dark:focus:ring-primary-600');
        // textarea.style.width = '100%';
        // textarea.style.height = '400px'; // Adjust the height as needed
        textarea.value = currentHTML;

        // Optionally, store the editor's original contenteditable state
        // so you can restore it later
        editor.setAttribute('data-original-contenteditable', editor.getAttribute('contenteditable'));

        // Remove contenteditable to avoid interference with the textarea
        editor.removeAttribute('contenteditable');

        // Replace the editor's content with the textarea
        editor.innerHTML = '';
        editor.appendChild(textarea);

        // Update the editor
        editor.classList.remove('p-3', 'min-h-20');
        editor.classList.add('h-64');

        // Disable all toolbar buttons
        document.querySelectorAll('#toolbar button').forEach(button => button.classList.add('cursor-not-allowed', 'opacity-50', 'pointer-events-none'));
        document.querySelector('#toolbar #toggleSourceBtn').classList.remove('cursor-not-allowed', 'opacity-50', 'pointer-events-none');

        // Update the flag
        isSourceMode = true;
        textarea.focus();
    } else {
        // --- SWITCH BACK TO WYSIWYG MODE ---
        document.getElementById('toggleSourceBtn').classList.remove('bg-gray-200', 'text-gray-800', 'hover:bg-gray-300', 'dark:bg-gray-600', 'dark:text-gray-50', 'dark:hover:bg-gray-800');
        // Find the textarea holding the HTML source
        const textarea = document.getElementById('editor-source');
        if (textarea) {
            // Get the updated HTML source from the textarea
            const updatedHTML = textarea.value;

            // Restore the editor's content with the updated HTML
            editor.innerHTML = updatedHTML;
        }

        // Restore the original contenteditable attribute
        const originalEditable = editor.getAttribute('data-original-contenteditable');
        if (originalEditable) {
            editor.setAttribute('contenteditable', originalEditable);
            editor.removeAttribute('data-original-contenteditable');
        } else {
            // Default to making it editable if no original value was saved
            editor.setAttribute('contenteditable', 'true');
        }

        // Update the editor
        editor.classList.remove('h-64');
        editor.classList.add('p-3', 'min-h-20');

        // Enable all toolbar buttons
        document.querySelectorAll('#toolbar button').forEach(button => button.classList.remove('cursor-not-allowed', 'opacity-50', 'pointer-events-none'));

        // Update the flag
        isSourceMode = false;
    }
}
