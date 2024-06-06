<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agenda') }}
        </h2>

    </x-slot>

    <div class="pb-12 pt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-700 shadow sm:rounded-lg">
                <div class="min-h-screen" id="calendar"></div>



                
                <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="eventModalLabel">Edit Event</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editEventForm">
                                    <div class="form-group">
                                        <label for="eventTitle">Title</label>
                                        <input type="text" class="form-control" id="eventTitle" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="eventDescription">Description</label>
                                        <textarea class="form-control" id="eventDescription" name="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="eventUser">User</label>
                                        <input type="text" class="form-control" id="eventUser" name="user">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveEventBtn">Save changes</button>
                                <button type="button" class="btn btn-danger" id="deleteEventBtn">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>