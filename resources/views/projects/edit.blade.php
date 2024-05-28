<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Bewerk Project
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <form method="POST" action="{{ route('projects.update', $project->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="projectname" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Project Naam</label>
                    <input type="text" name="projectname" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $project->projectname }}" required>
                </div>
                <div class="mb-4">
                    <label for="phaseName" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Fase</label>
                    <input type="text" name="phaseName" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $project->phaseName }}" required>
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                    <select name="status" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        <option value="Planning" {{ $project->status == 'Planning' ? 'selected' : '' }}>Planning</option>
                        <option value="In Progress" {{ $project->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ $project->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="On Hold" {{ $project->status == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                    </select>
               </div>
                <div class="mb-4">
                    <label for="startingDate" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Begindatum</label>
                    <input type="date" name="startingDate" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $project->startingDate }}" required>
                </div>
                <div class="mb-4">
                    <label for="projectLeader" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Project leider</label>
                    <input type="text" name="projectLeader" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $project->projectLeader }}" required>
                </div>
                <div class="mb-4">
                    <label for="productOwner" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Product Owner</label>
                    <input type="text" name="productOwner" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $project->productOwner }}" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Omschrijving</label>
                    <textarea name="description" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ $project->description }}</textarea>
                </div>
                    <!-- Categories -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Categorieën</label>
                        <div class="mt-1 space-x-2 flex flex-wrap">
                            @foreach($categories as $category)
                            <label class="inline-flex items-center mr-4 mb-2">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-checkbox h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 focus:ring-indigo-500" {{ $project->categories->contains($category->id) ? 'checked' : '' }}>
                                <span class="ml-2">{{ $category->category }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tags</label>
                        <div class="mt-1 space-x-2 flex flex-wrap">
                            @foreach($tags as $tag)
                            <label class="inline-flex items-center mr-4 mb-2">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="form-checkbox h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 focus:ring-indigo-500" {{ $project->tags->contains($tag->id) ? 'checked' : '' }}>
                                <span class="ml-2">{{ $tag->tag }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                <!-- List of Users and searchbar -->
                <div class="mb-4">
                    <label for="selectedUsers" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Select Users</label>
                    <input type="text" id="userSearch" class="mt-1 block w-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm mb-2" placeholder="Search users...">
                    <div class="overflow-y-auto w-80 max-h-80 rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3">
                        <ul id="userList">
                            @foreach($users as $user)
                            <li>
                                <input type="checkbox" name="selectedUsers[]" value="{{ $user->id }}" class="form-checkbox h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-700 focus:ring-indigo-500" {{ $project->users->contains($user->id) ? 'checked' : '' }}>
                                <span>{{ $user->name }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                

                <x-primary-button>Opslaan</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('userSearch');
        const userList = document.getElementById('userList');
        const users = Array.from(userList.getElementsByTagName('li'));

        searchInput.addEventListener('input', function(event) {
            const searchTerm = event.target.value.toLowerCase();
            const filteredUsers = users.filter(user => user.textContent.toLowerCase().includes(searchTerm));
            userList.innerHTML = '';
            filteredUsers.forEach(user => {
                userList.appendChild(user);
            });
        });
    });
</script>
@endpush
