<style>
    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        margin-bottom: 10px;
    }

    .btn-primary {
        margin-top: 20px;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create Project
        </h2>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Project</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('projects.store') }}">
                            @csrf
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="projectname">Project Name</label>
                                <input type="text" name="projectname" class="form-control" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="phaseName">Phase Name</label>
                                <input type="text" name="phaseName" class="form-control" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="status">Status</label>
                                <input type="text" name="status" class="form-control" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="startingDate">Starting Date</label>
                                <input type="date" name="startingDate" class="form-control" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="projectLeader">Project Leader</label>
                                <input type="text" name="projectLeader" class="form-control" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="categorie">Categorie</label>
                                <input type="text" name="categorie" class="form-control" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="productOwner">Product Owner</label>
                                <input type="text" name="productOwner" class="form-control" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

