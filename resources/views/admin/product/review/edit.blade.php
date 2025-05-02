<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Edit Product Review') }}"
    :breadcrumb="[
        ['label' => 'Product review', 'url' => route('admin.product.review.index')],
        ['label' => 'Edit']
    ]"
>

    <div class="w-full mt-2">
        <form action="{{ route('admin.product.review.update') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                @livewire('input-product-search', [
                    'product_id' => old('product_id', $data->product_id),
                    'product_title' => old('product_title', $data->product ? $data->product->title : ''),
                ])

                @livewire('input-user-search', [
                    'user_id' => old('user_id', $data->user_id),
                    'user_name' => old('user_name', $data->user ? $data->user->first_name.' '.$data->user->last_name : ''),
                ])
            </div>

            <div class="grid gap-4 mb-3 grid-cols-1 lg:grid-cols-2">
                <div>
                    <x-admin.input-label for="rating" :value="__('Rating *')" />
                    <ul class="flex space-x-2">
                        @for ($i = 1; $i < 6; $i++)
                            <li>
                                <x-admin.radio-input-button 
                                    id="level_{{$i}}" 
                                    name="rating" 
                                    value="{{ $i }}" 
                                    title="{{ $i }}" 
                                    class="w-auto px-2" 
                                    required 
                                    :checked="old('rating') ? old('rating') == $i : $data->rating == $i" />
                            </li>
                        @endfor
                    </ul>
                    <x-admin.input-error :messages="$errors->get('rating')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-3 grid-cols-1 items-center">
                <div>
                    <x-admin.input-label for="title" :value="__('Title')" />
                    <x-admin.text-input id="title" class="block" type="text" name="title" :value="old('title') ? old('title') : $data->title" placeholder="Enter Title" />
                    <x-admin.input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-3 grid-cols-1 items-center">
                <div>
                    <x-admin.input-label for="review" :value="__('Review *')" />
                    <x-admin.textarea id="review" class="block" type="text" name="review" :value="old('review') ? old('review') : $data->review" placeholder="Enter Review" />
                    <x-admin.input-error :messages="$errors->get('review')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-2 mb-3 grid-cols-1">
                <div class="image-uploader-container space-y-4">
                    <div>
                        <x-admin.input-label for="images" :value="__('Image')" />
                        <x-admin.file-input-drag-drop id="images" class="h-12 images" name="images[]" accept="image/*" multiple />
                    </div>

                    @if ($errors->get('images.*'))
                        <div x-data="{open: false}">
                            <p class="text-xs text-red-600 dark:text-orange-700 space-y-1">
                                Some error occured. 
                                <a href="javascript: void(0)" @click="open = !open">
                                    <strong><em>See details</em></strong>
                                </a>
                            </p>

                            <div x-show="open" class="mt-2">
                                @foreach ($errors->get('images.*') as $field => $messages)
                                    @foreach ($messages as $message)
                                        <x-admin.input-error :messages="$message" class="" />
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="imagePreview"></div>

                    <div class="existing-images">
                        @if ($data->images && count($data->images) > 0)
                            @livewire('existing-product-review-images', [
                                'images' => $data->images,
                            ])
                        @endif
                    </div>
                </div>
            </div>

            <div class="items-center space-x-4 flex my-6">
                <x-admin.button
                    type="submit"
                    element="button">
                    @slot('icon')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M840-680v480q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160Zm-80 34L646-760H200v560h560v-446ZM480-240q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35ZM240-560h360v-160H240v160Zm-40-86v446-560 114Z"/></svg>
                    @endslot
                    {{ __('Save data') }}
                </x-admin.button>
                <input type="hidden" name="id" value="{{ $data->id }}" />
            </div>
        </form>
    </div>
</x-admin-app-layout>