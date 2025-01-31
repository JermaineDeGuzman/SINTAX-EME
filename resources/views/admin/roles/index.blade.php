@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.roles.title')</h3>

    <!-- Button Container -->
    <div class="button-container">
        @can('role_create')
            <a href="{{ route('admin.roles.create') }}" class="btn btn-success">+ Add New</a>
        @endcan
        <button id="select-all" class="btn btn-outline-secondary">Select All</button>
        <button id="delete-selected" class="btn btn-outline-danger">X Delete Selected</button>
    </div>

    <div class="d-flex flex-wrap justify-content-start gap-3">
        @if (count($roles) > 0)
            @foreach ($roles as $role)
                <div class="role-card shadow-sm rounded">
                    <div class="role-card-left">
                        <input type="checkbox" class="role-checkbox">
                        <div class="icon-container">
                            <i class="fas fa-user-circle fa-3x"></i>
                        </div>
                    </div>
                    <div class="role-card-right">
                        <h5 class="role-title">{{ $role->title }}</h5>
                        <div class="d-flex gap-2">
                            @can('role_view')
                                <a href="{{ route('admin.roles.show',[$role->id]) }}" class="btn btn-sm btn-primary">View</a>
                            @endcan
                            @can('role_edit')
                                <a href="{{ route('admin.roles.edit',[$role->id]) }}" class="btn btn-sm btn-secondary">Edit</a>
                            @endcan
                            @can('role_delete')
                                {!! Form::open(['method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');", 'route' => ['admin.roles.destroy', $role->id], 'style' => 'display:inline;']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                                {!! Form::close() !!}
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>@lang('quickadmin.qa_no_entries_in_table')</p>
        @endif
    </div>

    <style>
        /* Button container styling */
        .button-container {
         /* Maroon background */
            padding: 15px;
            border-radius: 10px;
            display: flex;
            gap: 10px;
            align-items: center;
            margin-left: -15px;
            margin-bottom: 20px;
        }

        .button-container .btn {
            color: white;
            font-weight: bold;
            border: none;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-outline-secondary {
            background-color: #6c757d;
        }

        .btn-outline-danger {
            background-color: #dc3545;
        }

        .d-flex {
            display: flex;
            flex-wrap: wrap;
            justify-content: start;
            gap: 20px;
        }

        .role-card {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #ddd;
            width: 350px;
            height: 100px;
            padding: 10px;
            box-shadow: 5px 5px 5px grey;
        }

        .role-card-left {
            background: #5b1f2a;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 150%;
            margin-left: -10%;
            position: relative;
        }

        .role-checkbox {
            position: absolute;
            top: 5px;
            left: 5px;
        }

        .role-card-right {
            padding: 10px;
            flex-grow: 1;
        }

        .role-title {
            margin-bottom: 10px;
            font-weight: bold;
        }

        .icon-container i {
            color: white;
        }
    </style>

    <script>
        document.getElementById("select-all").addEventListener("click", function() {
            document.querySelectorAll(".role-checkbox").forEach(checkbox => checkbox.checked = true);
        });

        document.getElementById("delete-selected").addEventListener("click", function() {
            if (confirm("Are you sure you want to delete selected roles?")) {
                document.querySelectorAll(".role-checkbox:checked").forEach(checkbox => {
                    checkbox.closest(".role-card").remove();
                });
            }
        });
    </script>
@stop
