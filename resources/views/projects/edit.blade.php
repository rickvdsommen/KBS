
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Project
        </h2>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Project</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('projects.update', $project->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="projectname">Project Name</label>
                                <input type="text" name="projectname" class="form-control" value="{{ $project->projectname }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phaseName">Phase Name</label>
                                <input type="text" name="phaseName" class="form-control" value="{{ $project->phaseName }}" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" name="status" class="form-control" value="{{ $project->status }}" required>
                            </div>
                            <div class="form-group">
                                <label for="startingDate">Starting Date</label>
                                <input type="date" name="startingDate" class="form-control" value="{{ $project->startingDate }}" required>
                            </div>
                            <div class="form-group">
                                <label for="projectLeader">Project Leader</label>
                                <input type="text" name="projectLeader" class="form-control" value="{{ $project->projectLeader }}" required>
                            </div>
                            <div class="form-group">
                                <label for="categorie">Categorie</label>
                                <input type="text" name="categorie" class="form-control" value="{{ $project->categorie }}" required>
                            </div>
                            <div class="form-group">
                                <label for="productOwner">Product Owner</label>
                                <input type="text" name="productOwner" class="form-control" value="{{ $project->productOwner }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" required>{{ $project->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

