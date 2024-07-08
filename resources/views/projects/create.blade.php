<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Project aanmaken
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6">
            <form method="POST" action="{{ route('projects.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="projectname" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Project Naam</label>
                    <x-text-input type="text" id="projectname" name="projectname" class="mt-1 block w-80 sm:text-sm" required/>
                </div>
                <div class="mb-4">
                    <label for="phaseName" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Fase</label>
                    <x-text-input type="text" id="phaseName" name="phaseName" class="mt-1 block w-80 sm:text-sm" required/>
                </div>
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
                <div class="mb-4">
                    <label for="startingDate" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Begindatum</label>
                    <input type="date" id="startingDate" name="startingDate" class="mt-1 block w-80 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:text-sm" required/>
                </div>
                <!-- Project Leader -->
                <div class="mb-4">
                    <label for="projectLeaderSearch" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Project leider</label>
                    <x-text-input type="text" id="userSearchPL" class="mt-1 block w-80 sm:text-sm mb-2" placeholder="Zoek projectleiders..."/>
                    <div class="overflow-y-auto w-80 max-h-60 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3 dark:bg-gray-900">
                        <ul id="userListPL">
                            @foreach($users as $user)
                            <li>
                                <input type="radio" name="projectLeader" value="{{ $user->id }}" class="rounded-full border-gray-300 dark:border-gray-700 shadow-sm">
                                <span class="text-gray-800 dark:text-gray-200">{{ $user->name }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- Product Owner -->
                <div class="mb-4">
                    <label for="productOwnerSearch" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Product Owner</label>
                    <x-text-input type="text" id="userSearchPO" class="mt-1 block w-80 sm:text-sm mb-2" placeholder="Zoek product owners..."/>
                    <div class="overflow-y-auto w-80 max-h-60 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3 dark:bg-gray-900">
                        <ul id="userListPO">
                            @foreach($users as $user)
                            <li>
                                <input type="radio" name="productOwner" value="{{ $user->id }}" class="rounded-full border-gray-300 dark:border-gray-700 shadow-sm">
                                <span class="text-gray-800 dark:text-gray-200">{{ $user->name }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Omschrijving</label>
                    <textarea id="description" name="description" class="mt-1 block w-80 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:text-sm" required></textarea>
                </div>
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
                <div class="mb-4">
                    <label for="progress" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Vooruitgang (%)</label>
                    <input type="number" id="progress" name="progress" class="mt-1 block w-80 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm sm:text-sm" min="0" max="100" value="0" required/>
                </div>
                <!-- List of Users and searchbar -->
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
        const searchInputPL = document.getElementById('userSearchPL');
        const searchInputPO = document.getElementById('userSearchPO');

        const userList = document.getElementById('userList');
        const userListPL = document.getElementById('userListPL');
        const userListPO = document.getElementById('userListPO');

        const users = Array.from(userList.getElementsByTagName('li'));
        const usersPL = Array.from(userListPL.getElementsByTagName('li'));
        const usersPO = Array.from(userListPO.getElementsByTagName('li'));

        searchInputUsers.addEventListener('input', function(event) {
            const searchTerm = event.target.value.toLowerCase();
            const filteredUsers = users.filter(user => user.textContent.toLowerCase().includes(searchTerm));
            userList.innerHTML = '';
            filteredUsers.forEach(user => {
                userList.appendChild(user);
            });
        });

        searchInputPL.addEventListener('input', function(event) {
            const searchTerm = event.target.value.toLowerCase();
            const filteredUsersPL = usersPL.filter(user => user.textContent.toLowerCase().includes(searchTerm));
            userListPL.innerHTML = '';
            filteredUsersPL.forEach(user => {
                userListPL.appendChild(user);
            });
        });

        searchInputPO.addEventListener('input', function(event) {
            const searchTerm = event.target.value.toLowerCase();
            const filteredUsersPO = usersPO.filter(user => user.textContent.toLowerCase().includes(searchTerm));
            userListPO.innerHTML = '';
            filteredUsersPO.forEach(user => {
                userListPO.appendChild(user);
            });
        });
    });
</script>
