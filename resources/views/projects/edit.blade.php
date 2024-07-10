<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Bewerk Project
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6">
            <form method="POST" action="{{ route('projects.update', $project->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="projectname" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Project Naam</label>
                    <x-text-input type="text" name="projectname" class="mt-1 block w-80 sm:text-sm" value="{{ $project->projectname }}" required />
                </div>

                <div>
                    <x-input-label for="picture" :value="__('Foto')" />
                    <input type="file" name="picture" id="picture" class="mt-1 block w-full" accept="image/*">
                    <x-input-error class="mt-2" :messages="$errors->get('picture')" />
                </div>
        
                <div id="picturePreview" class="my-2 w-fit">
                    @if ($project->picture)
                        <img id="previewImage" src="{{ asset('images/'.$project->picture) }}" alt="Picture" class="h-60 w-auto">
                    @else
                        <img id="previewImage" src="#" alt="Preview" class="w-auto h-60 hidden">
                    @endif
                </div>

                <div class="mb-4">
                    <label for="phaseName" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Fase</label>
                    <x-text-input type="text" name="phaseName" class="mt-1 block w-80 sm:text-sm" value="{{ $project->phaseName }}" required />
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                    <select name="status" class="mt-1 block w-80 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:text-sm" required>
                        <option value="Ingepland" {{ $project->status == 'Ingepland' ? 'selected' : '' }}>Ingepland</option>
                        <option value="Lopend" {{ $project->status == 'Lopend' ? 'selected' : '' }}>Lopend</option>
                        <option value="Afgerond" {{ $project->status == 'Afgerond' ? 'selected' : '' }}>Afgerond</option>
                        <option value="Gepauzeerd" {{ $project->status == 'Gepauzeerd' ? 'selected' : '' }}>Gepauzeerd</option>
                        <option value="Gestopt" {{ $project->status == 'Gestopt' ? 'selected' : '' }}>Gestopt</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="progress" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Vooruitgang (%)</label>
                    <div class="flex mt-1">
                        <input type="number" id="progress" name="progress" class="block w-20 sm:w-32 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm py-2 px-3 mr-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" min="0" max="100" value="{{ $project->progress }}" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="startingDate" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Begindatum</label>
                    <input type="date" name="startingDate" class="mt-1 block w-80 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:text-sm" value="{{ $project->startingDate }}" required>
                </div>
                <!-- Project Leader -->
                <div class="mb-4">
                    <label for="projectLeader" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Project leider</label>
                    <select name="projectLeader" class="mt-1 block w-80 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:text-sm" required>
                        @foreach ($filteredUsersPL as $user)
                            @if (!$user->deactivated)
                                <option value="{{ $user->id }}" {{ $project->projectLeader == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Product Owner -->
                <div class="mb-4">
                    <label for="productOwner" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Product Owner</label>
                    <select name="productOwner" class="mt-1 block w-80 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:text-sm" required>
                        @foreach ($filteredUsersPO as $user)
                            @if (!$user->deactivated)
                                <option value="{{ $user->id }}" {{ $project->productOwner == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Omschrijving</label>
                    <textarea name="description" class="mt-1 block w-80 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:text-sm" required>{{ $project->description }}</textarea>
                </div>
                <!-- Categories -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Categorieën</label>
                    <div class="mt-1 space-x-2 flex flex-wrap">
                        @foreach ($categories as $category)
                            <label class="inline-flex items-center mr-4 mb-2">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="rounded-md border-gray-300 dark:border-gray-700 shadow-sm" {{ $project->categories->contains($category->id) ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-800 dark:text-gray-200">{{ $category->category }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <!-- Tags -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tags</label>
                    <div class="mt-1 space-x-2 flex flex-wrap">
                        @foreach ($tags as $tag)
                            <label class="inline-flex items-center mr-4 mb-2">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="rounded-md border-gray-300 dark:border-gray-700 shadow-sm" {{ $project->tags->contains($tag->id) ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-800 dark:text-gray-200">{{ $tag->tag }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <!-- List of Users and searchbar -->
                <div class="mb-4">
                    <label for="userSearch" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Wie werkt er mee aan dit project?</label>
                    <x-text-input type="text" id="userSearch" class="mt-1 block w-80 sm:text-sm mb-2" placeholder="Zoek gebruikers..." />
                    <div class="overflow-y-auto w-80 max-h-60 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3 dark:bg-gray-900">
                        <ul id="userList">
                            @foreach ($filteredUsersWorkingWith as $user)
                                @if (!$user->deactivated) <!-- Check if user is not deactivated -->
                                    <li>
                                        <input type="checkbox" name="selectedUsers[]" value="{{ $user->id }}" class="rounded-md border-gray-300 dark:border-gray-700 shadow-sm" {{ $project->users->contains($user->id) ? 'checked' : '' }}>
                                        <span class="text-gray-800 dark:text-gray-200">{{ $user->name }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <x-primary-button>Opslaan</x-primary-button>
            </form>

            @role('admin')
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit project wilt verwijderen??');" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <x-secondary-button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">Verwijderen</x-secondary-button>
                </form>
            @endrole
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
            const filteredUsersWorkingWith = users.filter(user => user.textContent.toLowerCase().includes(searchTerm));
            userList.innerHTML = '';
            filteredUsersWorkingWith.forEach(user => {
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
