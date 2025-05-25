<x-front.modal name="full=page-loader" maxWidth="xs" vertical="middle" backdrop>
    <div class="p-6">

        <div class="flex flex-col items-center justify-center space-y-6 min-h-[100px]">
            <div class="flex space-x-2">
                <div class="w-4 h-4 rounded-full bg-blue-500 animate-bounce [animation-delay:-0.3s]"></div>
                <div class="w-4 h-4 rounded-full bg-blue-500 animate-bounce [animation-delay:-0.15s]"></div>
                <div class="w-4 h-4 rounded-full bg-blue-500 animate-bounce"></div>
            </div>
            <div class="text-center">
                <h5 class="text-base font-semibold text-gray-800 dark:text-gray-200 mb-2">Processing your request..</h5>
                <p class="text-xs text-gray-500 dark:text-gray-400">This may take a few moments</p>
            </div>
        </div>

    </div>
</x-front.modal>