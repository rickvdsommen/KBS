@extends('layouts.app')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $project->projectname }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $project->projectname }}</div>

                    <div class="card-body">
                        <div class="form-group">
                            <strong>Phase Name:</strong>
                            {{ $project->phaseName }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $project->description }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $project->status }}
                        </div>
                        <div class="form-group">
                            <strong>Starting Date:</strong>
                            {{ $project->startingDate }}
                        </div>
                        <div class="form-group">
                            <strong>Project Leader:</strong>
                            {{ $project->projectLeader }}
                        </div>
                        <div class="form-group">
                            <strong>Categorie:</strong>
                            {{ $project->categorie }}
                        </div>
                        <div class="form-group">
                            <strong>Product Owner:</strong>
                            {{ $project->productOwner }}
                        </div>
                        <a class="btn btn-primary" href="{{ route('projects.index') }}"> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection
