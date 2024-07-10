<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Project aanmaken
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6">
            <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Project Name -->
                <div class="mb-4">
                    <label for="projectname" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Project Naam</label>
                    <x-text-input type="text" id="projectname" name="projectname" class="mt-1 block w-80 sm:text-sm" required/>
                </div>

                <div>
                    <x-input-label for="picture" :value="__('Foto')" />
                    <input type="file" name="picture" id="picture" class="mt-1 block w-full" accept="image/*">
                    <x-input-error class="mt-2" :messages="$errors->get('picture')" />
                </div>

                <div id="picturePreview" class="my-2 w-fit">
                        <img id="previewImage" src="#" alt="Preview" class="w-auto h-60 hidden">
                </div>

                <!-- Phase -->
                <div class="mb-4">
                    <label for="phaseName" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Fase</label>
                    <x-text-input type="text" id="phaseName" name="phaseName" class="mt-1 block w-80 sm:text-sm" required/>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                    <select id="status" name="status" class="mt-1 block w-80 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:text-sm" required>
                        <option value="Ingepland">Ingepland</option>
                        <option value="Lopend">Lopend</option>
                        <option value="Afgerond">Afgerond</option>
                        <option value="Gestopt">Gestopt</option>
                        <option value="Gepauzeerd">Gepauzeerd</option>
                    </select>
                </div>

                <!-- Starting Date -->
                <div class="mb-4">
                    <label for="startingDate" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Begindatum</label>
                    <input type="date" id="startingDate" name="startingDate" class="mt-1 block w-80 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:text-sm" required/>
                </div>

                <!-- Project Leader -->
                <div class="mb-4">
                    <label for="projectLeader" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Project leider</label>
                    <select id="projectLeader" name="projectLeader" class="mt-1 block w-80 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:text-sm" required>
                        <option value="">Selecteer een projectleider</option>
                        @foreach($filteredUsersPL as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Product Owner -->
                <div class="mb-4">
                    <label for="productOwner" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Product Owner</label>
                    <select id="productOwner" name="productOwner" class="mt-1 block w-80 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:text-sm" required>
                        <option value="">Selecteer een product owner</option>
                        @foreach($filteredUsersPO as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Omschrijving</label>
                    <textarea id="description" name="description" class="mt-1 block w-80 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:text-sm" required></textarea>
                </div>

                <!-- Tags -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tags</label>
                    <div class="mt-1 space-x-2 flex flex-wrap">
                        @foreach($tags as $tag)
                            <label class="inline-flex items-center mr-4 mb-2">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="rounded-md border-gray-300 dark:border-gray-700 shadow-sm">
                                <span class="ml-2 text-gray-800 dark:text-gray-200">{{ $tag->tag }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                
                <!-- Categories -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Categorieën</label>
                    <div class="mt-1 space-x-2 flex flex-wrap">
                        @foreach($categories as $category)
                            <label class="inline-flex items-center mr-4 mb-2">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="rounded-md border-gray-300 dark:border-gray-700 shadow-sm">
                                <span class="ml-2 text-gray-800 dark:text-gray-200">{{ $category->category }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Progress -->
                <div class="mb-4">
                    <label for="progress" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Vooruitgang (%)</label>
                    <input type="number" id="progress" name="progress" class="mt-1 block w-80 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:text-sm" min="0" max="100" value="0" required/>
                </div>

                <!-- Selected Users and Searchbar -->
                <div class="mb-4">
                    <label for="selectedUsers" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Wie werkt er mee aan dit project?</label>
                    <x-text-input type="text" id="userSearch" class="mt-1 block w-80 sm:text-sm mb-2" placeholder="Zoek gebruikers..."/>
                    <div class="overflow-y-auto w-80 max-h-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3 dark:bg-gray-900">
                        <ul id="userList">
                            @foreach($users as $user)
                                <li>
                                    <input type="checkbox" name="selectedUsers[]" value="{{ $user->id }}" class="rounded-md border-gray-300 dark:border-gray-700 shadow-sm">
                                    <span class="text-gray-800 dark:text-gray-200">{{ $user->name }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <x-primary-button type="submit">Opslaan</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInputUsers = document.getElementById('userSearch');

        const userList = document.getElementById('userList');

        const users = Array.from(userList.getElementsByTagName('li'));

        searchInputUsers.addEventListener('input', function(event) {
            const searchTerm = event.target.value.toLowerCase();
            const filteredUsers = users.filter(user => user.textContent.toLowerCase().includes(searchTerm));
            userList.innerHTML = '';
            filteredUsers.forEach(user => {
                userList.appendChild(user);
            });
        });

        const pictureInput = document.getElementById('picture');
        const previewImage = document.getElementById('previewImage');
        
        // Event listener for profile picture change
        pictureInput.addEventListener('change', function (event) {
            const input = event.target;
            const file = input.files[0];
            const reader = new FileReader();
            
            reader.onload = function () {
                previewImage.src = reader.result;
                previewImage.classList.remove('hidden');
            };
            
            if (file) {
                reader.readAsDataURL(file);
            } else {
                // If no file selected, hide the preview
                previewImage.src = '#';
                previewImage.classList.add('hidden');
            }
        });
    });
</script>
