<x-app-layout>

    @section('style')
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   

                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            {{ __('Projects Listing') }}
                                            <button style="float: right; font-weight: 900;" class="btn btn-info btn-sm" type="button"  data-toggle="modal" data-target="#CreateProjectModal">
                                                Create Project
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered datatable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Hours</th>
                                                        <th>Color</th>
                                                        <th width="150" class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Create Project Modal -->
                    <div class="modal" id="CreateProjectModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Project Create</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div hidden class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div hidden class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                                        <strong>Success!</strong>Project was added successfully.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <label for="Name">Name:</label>
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="hours">No. of hours:</label>
                                        <input type="number" class="form-control" name="hours" id="hours">
                                    </div>
                                    <div class="form-group">
                                        <label for="color">Color:</label>
                                        <input type="text" class="form-control" name="color" id="color">
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" id="SubmitCreateProjectForm">Create</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Edit Project Modal -->
                    <div class="modal" id="EditProjectModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Project Edit</h4>
                                    <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div hidden class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div hidden class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                                        <strong>Success!</strong>Project was added successfully.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div id="EditProjectModalBody">
                                        
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" id="SubmitEditProjectForm">Update</button>
                                    <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Delete Project Modal -->
                    <div class="modal" id="DeleteProjectModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Project Delete</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <h4>Are you sure want to delete this project?</h4>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" id="SubmitDeleteProjectForm">Yes</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                </div>
                            </div>
                        </div>
                    



                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                // init datatable.
                var dataTable = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    pageLength: 5,
                    // scrollX: true,
                    "order": [[ 0, "desc" ]],
                    ajax: '{{ route('get-projects') }}',
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'hours', name: 'hours'},
                        {data: 'color', name: 'color'},
                        {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
                    ]
                });
        
                // Create Project Ajax request.
                $('#SubmitCreateProjectForm').click(function(e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('projects.store') }}",
                        method: 'post',
                        data: {
                            name: $('#name').val(),
                            hours: $('#hours').val(),
                            color: $('#color').val(),
                        },
                        success: function(result) {
                            if(result.errors) {
                                $('.alert-danger').html('');
                                $.each(result.errors, function(key, value) {
                                    $('.alert-danger').show();
                                    $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                                });
                            } else {
                                $('.alert-danger').hide();
                                $('.alert-success').show();
                                $('.datatable').DataTable().ajax.reload();
                                $('.alert-success').hide();
                                $('#CreateProjectModal').modal('hide');
                                    // location.reload();
                                
                            }
                        }
                    });
                });
        
                // Get single Project in EditModel
                $('.modelClose').on('click', function(){
                    $('#EditProjectModal').hide();
                });
                var id;
                $('body').on('click', '#getEditProjectData', function(e) {
                    // e.preventDefault();
                    $('.alert-danger').html('');
                    $('.alert-danger').hide();
                    id = $(this).data('id');
                    $.ajax({
                        url: "projects/"+id+"/edit",
                        method: 'GET',
                        // data: {
                        //     id: id,
                        // },
                        success: function(result) {
                            console.log(result);
                            $('#EditProjectModalBody').html(result.html);
                            $('#EditProjectModal').show();
                        }
                    });
                });
        
                // Update Project Ajax request.
                $('#SubmitEditProjectForm').click(function(e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "projects/"+id,
                        method: 'PUT',
                        data: {
                            name: $('#editName').val(),
                            hours: $('#editHours').val(),
                            color: $('#editColor').val(),
                        },
                        success: function(result) {
                            if(result.errors) {
                                $('.alert-danger').html('');
                                $.each(result.errors, function(key, value) {
                                    $('.alert-danger').show();
                                    $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                                });
                            } else {
                                $('.alert-danger').hide();
                                $('.alert-success').show();
                                $('.datatable').DataTable().ajax.reload();
                                setInterval(function(){ 
                                    $('.alert-success').hide();
                                    $('#EditProjectModal').hide();
                                }, 2000);
                            }
                        }
                    });
                });
        
                // Delete Project Ajax request.
                var deleteID;
                $('body').on('click', '#getDeleteId', function(){
                    deleteID = $(this).data('id');
                })
                $('#SubmitDeleteProjectForm').click(function(e) {
                    e.preventDefault();
                    var id = deleteID;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "projects/"+id,
                        method: 'DELETE',
                        success: function(result) {
                            $('#DeleteProjectModal').hide();
                            $('.datatable').DataTable().ajax.reload();
                            // location.reload();
                           
                        }
                    });
                });
            });
        </script>
        
    
    @endsection

</x-app-layout>
