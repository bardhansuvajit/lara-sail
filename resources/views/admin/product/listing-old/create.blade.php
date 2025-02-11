<x-admin-app-layout
    screen="lg"
    title="{{ __('Create product') }}"
    :breadcrumb="[
        ['label' => 'Products', 'url' => route('admin.product.listing.index')],
        ['label' => 'Create']
    ]"
>

    {{-- <div class="tab-wrapper" x-data="{ activeTab:  0 }">
        <div class="flex space-x-2">
            <label 
                @click="activeTab = 0" 
                class="h-[2.3rem] flex items-center justify-center font-medium rounded-lg text-sm p-2 
                text-primary-500 bg-primary-100 border border-primary-200 dark:border-gray-600 
                hover:bg-primary-200 
                focus:outline-none focus:ring-4 focus:ring-primary-300 
                dark:text-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-4 dark:focus:ring-gray-600" 
                :class="{ 'text-white bg-primary-600 border-primary-700 hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800': activeTab === 0 }">Tab 1</label>

            <label 
                @click="activeTab = 1" 
                class="h-[2.3rem] flex items-center justify-center font-medium rounded-lg text-sm p-2 
                text-primary-500 bg-primary-100 border border-primary-200 dark:border-gray-600 
                hover:bg-primary-200 
                focus:outline-none focus:ring-4 focus:ring-primary-300 
                dark:text-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-4 dark:focus:ring-gray-600" :class="{ 'text-white bg-primary-600 border-primary-700 hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800': activeTab === 1 }">Tab 2</label>

            <label 
                @click="activeTab = 2" 
                class="h-[2.3rem] flex items-center justify-center font-medium rounded-lg text-sm p-2 
                text-primary-500 bg-primary-100 border border-primary-200 dark:border-gray-600 
                hover:bg-primary-200 
                focus:outline-none focus:ring-4 focus:ring-primary-300 
                dark:text-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-4 dark:focus:ring-gray-600" :class="{ 'text-white bg-primary-600 border-primary-700 hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800': activeTab === 2 }">Tab 3</label>
        </div>

        <div class="tab-panel" :class="{ 'active': activeTab === 0 }" x-show="activeTab === 0">
            <p>This is the example content of the first tab.</p>
        </div>
        <div class="tab-panel" :class="{ 'active': activeTab === 1 }" x-show="activeTab === 1">
            <p>The second tab’s example content.</p>
        </div>
        <div class="tab-panel" :class="{ 'active': activeTab === 2 }" x-show="activeTab === 2">
            <p>The content of the third and final tab in this set.</p>
        </div>
    </div> --}}

    <div class="flex space-x-2 mb-3">
        <x-admin.button element="a">{{ __('Category') }}</x-admin.button>
        <x-admin.button element="a" tag="secondary">{{ __('Title') }}</x-admin.button>
    </div>

    <div class="w-full">
        <form action="#">
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" placeholder="Product Title" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    {{-- <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label> --}}
                    {{-- <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required=""> --}}
                </div>
                <div><label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label><select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"><option selected="">Select category</option><option value="TV">TV/Monitors</option><option value="PC">PC</option><option value="GA">Gaming/Console</option><option value="PH">Phones</option></select></div>
                <div>
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                    <input type="text" name="brand" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Product brand" required="">
                </div>
                <div>
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                    <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                </div>
                <div class="grid gap-4 sm:col-span-2 md:gap-6 sm:grid-cols-4">
                    <div>
                        <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item weight (kg)</label>
                        <input type="number" name="weight" id="weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="12" required="">
                    </div>
                    <div>
                        <label for="length" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lenght (cm)</label>
                        <input type="number" name="length" id="length" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="105" required="">
                    </div>
                    <div>
                        <label for="breadth" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Breadth (cm)</label>
                        <input type="number" name="breadth" id="breadth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="15" required="">
                    </div>
                    <div>
                        <label for="width" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Width (cm)</label>
                        <input type="number" name="width" id="width" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="23" required="">
                    </div>
                </div>
                <div class="sm:col-span-2"><label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label><textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write product description here"></textarea></div>
            </div>
            <div class="mb-4 space-y-4 sm:flex sm:space-y-0">
                <div class="flex items-center mr-4">
                    <input id="inline-checkbox" type="checkbox" value="" name="sellingType" class="w-4 h-4 bg-gray-100 rounded border-gray-300 text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="inline-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">In-store only</label>
                </div>
                <div class="flex items-center mr-4">
                    <input id="inline-2-checkbox" type="checkbox" value="" name="sellingType" class="w-4 h-4 bg-gray-100 rounded border-gray-300 text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="inline-2-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Online selling only</label>
                </div>
                <div class="flex items-center mr-4">
                    <input checked="" id="inline-checked-checkbox" type="checkbox" value="" name="sellingType" class="w-4 h-4 bg-gray-100 rounded border-gray-300 text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="inline-checked-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Both in-store and online</label>
                </div>
            </div>
            <div class="mb-4">
                <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Images</span>
                <div class="flex justify-center items-center w-full">
                    <label for="dropzone-file" class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col justify-center items-center pt-5 pb-6">
                            <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                <span class="font-semibold">Click to upload</span>
                                or drag and drop
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden">
                    </label>
                </div>
            </div>
            <div class="items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                <button type="submit" class="w-full sm:w-auto justify-center text-white inline-flex bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Add product</button>
                <button class="w-full sm:w-auto text-white justify-center inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                    Schedule
                </button>
                <button data-modal-toggle="createProductModal" type="button" class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Discard
                </button>
            </div>
        </form>
    </div>

    {{-- <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"></div>
    <div class="grid grid-cols-2 gap-4">
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
        <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
    </div> --}}
</x-admin-app-layout>