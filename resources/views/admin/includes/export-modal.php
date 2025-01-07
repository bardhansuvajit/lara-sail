<x-modal name="export-modal" focusable>
    <div class="p-6">
        <h2 class="text-lg font-semibold">Export Data</h2>
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-4">
                <label for="file" class="block text-sm font-medium text-gray-700">File</label>
                <input type="file" name="file" id="file" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mt-4">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Export
                </button>
            </div>
        </form>
    </div>
</x-modal>