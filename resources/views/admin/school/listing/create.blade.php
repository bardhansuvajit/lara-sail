<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Create School') }}"
    :breadcrumb="[
        ['label' => 'School', 'url' => route('admin.school.listing.index')],
        ['label' => 'Create']
    ]"
>

    <div class="w-full mt-2">
        <form action="{{ route('admin.school.listing.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            
            <!-- Logo Section -->
            <div class="grid gap-4 mb-6 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="image" :value="__('School Logo')" />
                    <x-admin.file-input id="image" name="image" />
                    <x-admin.input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
            </div>

            <!-- Basic Information -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-primary-200 mb-4">Basic Information</h3>
                <div class="grid gap-4 sm:grid-cols-1">
                    <div>
                        <x-admin.input-label for="name" :value="__('School Name *')" />
                        <x-admin.text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" placeholder="Enter school name" autofocus required />
                        <x-admin.input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>

                <div class="grid gap-4 mt-4 sm:grid-cols-3">
                    <div>
                        <x-admin.input-label for="code" :value="__('School Code')" />
                        <x-admin.text-input id="code" class="block w-full" type="text" name="code" :value="old('code')" placeholder="Enter school code" />
                        <x-admin.input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <div>
                    <x-admin.input-label for="description" :value="__('Description')" />
                    <x-admin.textarea id="description" class="block w-full" name="description" placeholder="Enter school description" maxlength="1000" :value="old('description')"></x-admin.textarea>
                    <p class="mt-1 text-sm text-gray-500">Max 1000 characters</p>
                    <x-admin.input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>

            <!-- Location Information -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-primary-200 mb-4">Location Information</h3>
                <div class="grid gap-4 sm:grid-cols-3 mb-3">
                    <div>
                        <x-admin.input-label for="country_code" :value="__('Country *')" />
                        <x-admin.input-select id="country_code" name="country_code" title="Select Country" class="w-full">
                            @slot('options')
                                @foreach ($activeCountries as $country)
                                    <x-admin.input-select-option
                                        value="{{$country->code}}" 
                                        :selected="old('country_code', 'IN') == $country->code"
                                        >
                                        {{$country->name}}
                                    </x-admin.input-select-option>
                                @endforeach
                            @endslot
                        </x-admin.input-select>
                        <x-admin.input-error :messages="$errors->get('country_code')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="state" :value="__('State *')" />
                        <x-admin.text-input id="state" class="block w-full" type="text" name="state" :value="old('state', 'West Bengal')" placeholder="Enter state" required />
                        <x-admin.input-error :messages="$errors->get('state')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="district" :value="__('District *')" />
                        <x-admin.text-input id="district" class="block w-full" type="text" name="district" :value="old('district')" placeholder="Enter district" />
                        <x-admin.input-error :messages="$errors->get('district')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="city" :value="__('City *')" />
                        <x-admin.text-input id="city" class="block w-full" type="text" name="city" :value="old('city')" placeholder="Enter city" />
                        <x-admin.input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="pincode" :value="__('Pincode')" />
                        <x-admin.text-input id="pincode" class="block w-full" type="text" name="pincode" :value="old('pincode')" placeholder="Enter pincode" />
                        <x-admin.input-error :messages="$errors->get('pincode')" class="mt-2" />
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-1">
                    <div>
                        <x-admin.input-label for="address" :value="__('Address')" />
                        <x-admin.textarea id="address" class="block w-full" name="address" placeholder="Enter Street Address" maxlength="1000" :value="old('address')"></x-admin.textarea>
                        <x-admin.input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- School Type & Level -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-primary-200 mb-4">School Details</h3>
                <div class="grid gap-4 sm:grid-cols-3">
                    <div>
                        <x-admin.input-label for="type" :value="__('School Type *')" />
                        <x-admin.input-select id="type" name="type" title="Select type" class="w-full">
                            @slot('options')
                                @foreach ($schoolType as $key => $val)
                                    <x-admin.input-select-option value="{{ $key }}" :selected="old('type', 'private') == $key">{{ $val }}</x-admin.input-select-option>
                                @endforeach
                            @endslot
                        </x-admin.input-select>
                        <x-admin.input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="level" :value="__('Education Level *')" />
                        <x-admin.input-select id="level" name="level" title="Select Education Level" class="w-full">
                            @slot('options')
                                @foreach ($educationLevel as $key => $val)
                                    <x-admin.input-select-option value="{{ $key }}" :selected="old('level', 'higher_secondary') == $key">{{ $val }}</x-admin.input-select-option>
                                @endforeach
                            @endslot
                        </x-admin.input-select>
                        <x-admin.input-error :messages="$errors->get('level')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="board_affiliation" :value="__('Board Affiliation *')" />
                        <x-admin.input-select id="board_affiliation" name="board_affiliation" title="Select Education board_affiliation" class="w-full">
                            @slot('options')
                                @foreach ($activeBoards as $key => $val)
                                    <x-admin.input-select-option value="{{ $val->slug }}" :selected="old('board_affiliation', 'wbbse') == $val->slug">{{ $val->code }}</x-admin.input-select-option>
                                @endforeach
                            @endslot
                        </x-admin.input-select>
                        <x-admin.input-error :messages="$errors->get('board_affiliation')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Academic Information -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-primary-200 mb-4">Academic Information</h3>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <x-admin.input-label for="established_year" :value="__('Established Year')" />
                        <x-admin.text-input id="established_year" class="block w-full" type="number" name="established_year" :value="old('established_year')" placeholder="e.g., 1950" min="1000" max="9999" />
                        <x-admin.input-error :messages="$errors->get('established_year')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="principal_name" :value="__('Principal Name')" />
                        <x-admin.text-input id="principal_name" class="block w-full" type="text" name="principal_name" :value="old('principal_name')" placeholder="Enter principal name" />
                        <x-admin.input-error :messages="$errors->get('principal_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="student_count" :value="__('Student Count')" />
                        <x-admin.text-input id="student_count" class="block w-full" type="number" name="student_count" :value="old('student_count')" placeholder="Total students" min="0" />
                        <x-admin.input-error :messages="$errors->get('student_count')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="teacher_count" :value="__('Teacher Count')" />
                        <x-admin.text-input id="teacher_count" class="block w-full" type="number" name="teacher_count" :value="old('teacher_count')" placeholder="Total teachers" min="0" />
                        <x-admin.input-error :messages="$errors->get('teacher_count')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-primary-200 mb-4">Contact Information</h3>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <x-admin.input-label for="official_email" :value="__('Official Email')" />
                        <x-admin.text-input id="official_email" class="block w-full" type="email" name="official_email" :value="old('official_email')" placeholder="school@email.com" />
                        <x-admin.input-error :messages="$errors->get('official_email')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="phone_number" :value="__('Phone Number')" />
                        <x-admin.text-input id="phone_number" class="block w-full" type="text" name="phone_number" :value="old('phone_number')" placeholder="+91-XXX-XXXXXXX" />
                        <x-admin.input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="alternate_phone" :value="__('Alternate Phone')" />
                        <x-admin.text-input id="alternate_phone" class="block w-full" type="text" name="alternate_phone" :value="old('alternate_phone')" placeholder="Alternate contact number" />
                        <x-admin.input-error :messages="$errors->get('alternate_phone')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="fax" :value="__('Fax')" />
                        <x-admin.text-input id="fax" class="block w-full" type="text" name="fax" :value="old('fax')" placeholder="Fax number" />
                        <x-admin.input-error :messages="$errors->get('fax')" class="mt-2" />
                    </div>

                    <div class="sm:col-span-2">
                        <x-admin.input-label for="website" :value="__('Website')" />
                        <x-admin.text-input id="website" class="block w-full" type="url" name="website" :value="old('website')" placeholder="https://school-website.com" />
                        <x-admin.input-error :messages="$errors->get('website')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Contact Person Details -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-primary-200 mb-4">Contact Person Details</h3>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <x-admin.input-label for="contact_person_name" :value="__('Contact Person Name')" />
                        <x-admin.text-input id="contact_person_name" class="block w-full" type="text" name="contact_person_name" :value="old('contact_person_name')" placeholder="Contact person name" />
                        <x-admin.input-error :messages="$errors->get('contact_person_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="contact_person_designation" :value="__('Designation')" />
                        <x-admin.text-input id="contact_person_designation" class="block w-full" type="text" name="contact_person_designation" :value="old('contact_person_designation')" placeholder="e.g., Principal, Admin" />
                        <x-admin.input-error :messages="$errors->get('contact_person_designation')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="contact_person_mobile" :value="__('Mobile Number')" />
                        <x-admin.text-input id="contact_person_mobile" class="block w-full" type="text" name="contact_person_mobile" :value="old('contact_person_mobile')" placeholder="Contact person mobile" />
                        <x-admin.input-error :messages="$errors->get('contact_person_mobile')" class="mt-2" />
                    </div>

                    <div>
                        <x-admin.input-label for="contact_person_email" :value="__('Email')" />
                        <x-admin.text-input id="contact_person_email" class="block w-full" type="email" name="contact_person_email" :value="old('contact_person_email')" placeholder="contact@email.com" />
                        <x-admin.input-error :messages="$errors->get('contact_person_email')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- SEO Information -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-primary-200 mb-4">SEO Information</h3>
                <div class="grid gap-4 sm:grid-cols-1">
                    <div>
                        <x-admin.input-label for="meta_title" :value="__('Meta Title')" />
                        <x-admin.text-input id="meta_title" class="block w-full" type="text" name="meta_title" :value="old('meta_title')" placeholder="Enter meta title for SEO" maxlength="60" />
                        <p class="mt-1 text-sm text-gray-500">Recommended: 50-60 characters</p>
                        <x-admin.input-error :messages="$errors->get('meta_title')" class="mt-2" />
                    </div>
                    
                    <div>
                        <x-admin.input-label for="meta_description" :value="__('Meta Description')" />
                        <x-admin.textarea id="meta_description" class="block w-full" name="meta_description" placeholder="Enter meta description for SEO" maxlength="160" :value="old('meta_description')"></x-admin.textarea>
                        <p class="mt-1 text-sm text-gray-500">Recommended: 150-160 characters</p>
                        <x-admin.input-error :messages="$errors->get('meta_description')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Additional Settings -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-primary-200 mb-4">Additional Settings</h3>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <x-admin.input-label for="tags" :value="__('Tags')" />
                        <x-admin.text-input id="tags" class="block w-full" type="text" name="tags" :value="old('tags')" placeholder="Enter tags as comma separated values" />
                        <p class="mt-1 text-sm text-gray-500">Separate tags with commas (e.g., science, maths, arts, sports)</p>
                        <x-admin.input-error :messages="$errors->get('tags')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center space-x-4 my-6">
                <x-admin.button
                    type="submit"
                    element="button">
                    @slot('icon')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M840-680v480q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160Zm-80 34L646-760H200v560h560v-446ZM480-240q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35ZM240-560h360v-160H240v160Zm-40-86v446-560 114Z"/></svg>
                    @endslot
                    {{ __('Save Data') }}
                </x-admin.button>
            </div>
        </form>
    </div>
</x-admin-app-layout>