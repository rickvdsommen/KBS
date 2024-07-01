<!-- resources/views/devices/index.blade.php -->

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Aanwezigheid 
        </h2>
    </x-slot>

    <div class="pb-10 pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-800 shadow-md rounded-lg">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
                                <th class="py-2 px-4 text-left">Device ID</th>
                                <th class="py-2 px-4 text-left">Status</th>
                                <th class="py-2 px-4 text-left">Locatie</th>
                                <th class="py-2 px-4 text-left">Gebruiker</th>
                                <th class="py-2 px-4 text-left">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devices as $device)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="py-2 px-4">{{ $device->id }}</td>
                                    <td class="py-2 px-4">{{ $device->status }}</td>
                                    <td class="py-2 px-4">
                                        <form action="{{ route('devices.update', $device->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="text" name="location" value="{{ $device->location }}" class="form-input bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200" readonly>
                                            <button type="button" class="btn btn-secondary edit-btn">Edit</button>
                                            <button type="submit" class="btn btn-primary save-btn hidden">Save</button>
                                        </form>
                                    </td>
                                    <td class="py-2 px-4">{{ $device->user ? $device->user->name : 'Unassigned' }}</td>
                                    <td class="py-2 px-4">
                                        @if($device->user)
                                            <form action="{{ route('devices.unlink') }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="device_id" value="{{ $device->id }}">
                                                <button type="submit" class="btn btn-danger">Unlink</button>
                                            </form>
                                        @else
                                            <form action="{{ route('devices.link') }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="device_id" value="{{ $device->id }}">
                                                <select name="user_id" class="form-select" required>
                                                    <option value="">Select User</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-primary">Link</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const form = button.closest('form');
                    const input = form.querySelector('input[name="location"]');
                    const saveButton = form.querySelector('.save-btn');
                    input.removeAttribute('readonly');
                    input.classList.remove('bg-gray-200');
                    input.classList.add('bg-white');
                    button.classList.add('hidden');
                    saveButton.classList.remove('hidden');
                });
            });
        });
    </script>

    <style>
        .form-input {
            padding: 0.5rem;
            border-radius: 0.375rem;
            border: 1px solid #d1d5db;
        }
        .form-select {
            padding: 0.5rem;
            border-radius: 0.375rem;
            border: 1px solid #d1d5db;
        }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
        }
        .btn-secondary {
            background-color: #4b5563;
            color: white;
        }
        .btn-primary {
            background-color: #2563eb;
            color: white;
        }
        .btn-danger {
            background-color: #dc2626;
            color: white;
        }
        .overflow-x-auto {
            overflow-x: auto;
            max-width: 100%;
        }
    </style>

</x-app-layout>
