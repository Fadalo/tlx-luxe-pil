<?php
 use App\Helpers\H1BHelper;
 $help = new H1BHelper;
?>
<style>
table>td {
    font-size: 11px;
     !important
}

</style>
<?php
//echo '<pre>';
//print_r($config);
//exit();
?>
@if (!empty($data))
<div class="row mb-2">
<div class="col-md-6 " id="custom-buttons-container"></div> <!-- Button container -->
    <div class="col-md-6 text-end">
        <a id="btnSearch" class="ri-search-line absolute-element position-absolute" style="display:block;top: 10px; right: 20px;"></a>
        
        <a id="btnClose" class="ri-close-line absolute-element position-absolute" style="display:none;top: 10px; right: 20px;"></a>
        <input type="text" id="customSearch" class="form-control" aria-controls="datatable-{{$config['module']}}" placeholder="Search {{$config['module']}}">
    </div>
    
</div>
<!-- id="state-saving-datatable" -->
<table id="datatable-{{ $config['module'] }}" class="table table-striped dt-responsive  table-dark  nowrap "
    style="width:100% !important">
    <thead>
        <tr>
            @foreach (array_keys($config['meta']) as $key)
            @if ($loop->first)
            <th width="5%"></th>
            @endif
            <th>{{ $help->CamelCase($key) }}</th> <!-- Display the keys as table headers -->

            @endforeach

        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div class="row mb-2">
    <div id="customInfo" class="col-md-6">
        
    </div>
    <div class="col-md-6 text-end" id="customPaging"></div> <!-- Button container -->
</div>
@endif

@push('script_ext')

<script>
$(document).ready(function() {
    const a = $("#datatable-{{ $config['module'] }}").DataTable({
        stateSave: !0,
        lengthChange: false,
        processing: false,
        pagingType: 'simple_numbers',
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'></i>",
                next: "<i class='mdi mdi-chevron-right'></i>"
            }
        },
        order: {!!$config['sort']!!},
        ajax: {
            url: '{{ $config['module'] }}/list-{{ $config['module'] }}', // Replace with your endpoint
            type: 'GET', // Adjust if your API returns nested data
            error: function(xhr) {
                console.error('Error:', xhr.responseText); // Log errors
            }

        },
        columns: {!!$config['columns'] !!},
        columnDefs: [{
                orderable: false,
                targets: 0
            } // Disable sorting on the action column (first column)
        ],
        buttons: [
            /*  {
                 extend: 'copy',
                 text: '<i class="fas fa-copy"></i> COPY',
                 className: 'btn btn-sm btn-success rounded-0 p-3 text-white',
                 style: { color:'white'}
             },*/
           
            {
                extend: 'colvis',
                text: '<i class="fas fa-columns  ms-1"></i> HIDE ',
                className: 'btn btn-sm btn-info rounded-0 ms-1 text-white',
                style: {
                    color: 'white'
                }
            },
            {
                extend: 'print',
                text: '<i class="ri-printer-line ms-1"></i> PRINT',
                className: 'btn btn-sm btn-info rounded-0 ms-1 text-white',
                style: {
                    color: 'white'
                }
            },
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel ms-1"></i> EXCEL',
                className: 'btn btn-sm btn-info rounded-0 ms-1 text-white',
                style: {
                    color: 'white'
                }
            }
            /* {
                 extend: 'pdf',
                 text: '<i class="fas fa-file-pdf"></i>',
                 className: 'btn btn-sm btn-danger text-white'
             },*/

        ],
        initComplete:function(){
            a.buttons().container().appendTo('#custom-buttons-container');
            $('#customSearch').on('keyup', function () {
                a.search(this.value).draw();
                if(this.value==''){
                    $('#btnSearch').show();
                    $('#btnClose').hide();
                }
                else{
                    $('#btnSearch').hide();
                    $('#btnClose').show();
                }
                
            });
            $('#btnClose').on('click', function () {
                $('#customSearch').val('');
                a.search('').draw();
                $('#btnSearch').show();
                $('#btnClose').hide();
            });
            
            $('#datatable-{{$config['module']}}_wrapper > div:nth-child(1)').hide();
          
        },
        drawCallback: function() {
            
         
            // CustomInfo - Start 
           // var tableInfo = this.api().page.info(); // Get pagination info
            //var infoText = `Showing ${tableInfo.start + 1} to ${tableInfo.end} of ${tableInfo.recordsTotal} entries`;
            //$('#customInfo').html(infoText);

            // CustomPAGING - Start
            /*        
            $('#customPaging').empty();
            $('#customPaging').append(
                    `<button class="btn btn-sm btn-info mx-1 custom-page-btn" data-page="0">
                        Previos
                    </button>`
                );
            for (var i = 0; i < tableInfo.pages; i++) {
                $('#customPaging').append(
                    `<button class="btn btn-sm btn-info mx-1 custom-page-btn" data-page="${i}">
                        ${i + 1}
                    </button>`
                );
            }
            $('#customPaging').append(
                    `<button class="btn btn-sm btn-info mx-1 custom-page-btn" data-page="${i-1}">
                        Last
                    </button>`
                );
           


            $('#customPaging').on('click', 'button', function () {
                var page = $(this).data('page');
                a.page(page).draw('page'); // Navigate to the selected page
                console.log($(this));
              //  $('#customPaging button').eq(1).addClass('active');
            });
            */

            // Event btnDelete


            $('#datatable-{{$config['module']}} tbody a[name="btnDelete"]').on('click', function(event) {
                event.preventDefault(); // Prevent default anchor behavior

                const Id = $(this).data('id'); // Get member ID from data attribute



                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Action confirmed
                        const deleteUrl = `{{ route('admin.'.$config['module'].'.delete', ':Id') }}`
                        .replace(':Id', Id);
                    $.ajax({
                        url: deleteUrl, // Update with your delete endpoint
                        type: 'POST', // Change to POST if your API requires it
                        data: {

                            _token: $('meta[name="csrf-token"]').attr(
                                'content') // Assuming you have a CSRF token in a meta tag
                        },
                        success: function(response) {
                            // Reload the DataTable to reflect the changes
                            
                            a.ajax.reload(null,
                            false); // Reload data without resetting the pagination
                            //alert('Member deleted successfully.'); // Success message
                            swal("Hello, World!",
                                "{{$config['module']}} deleted successfully.", "success");

                        },
                        error: function(xhr, status, error) {
                            alert('Error deleting {{$config['module']}}: ' +
                            error); // Error message
                        }
                    });
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                    } else if (result.isDismissed) {
                        // Action canceled
                        Swal.fire(
                            'Cancelled',
                            'Your file is safe :)',
                            'error'
                        );
                    }
                });

                // Confirm deletion
                //if (confirm('Are you sure you want to delete this member? ' + memberId)) {
                    //alert(memberId);
                    
                //}
            });
        }



    });
    // Optional: Enable DataTables buttons if necessary
    console.log(a.buttons());
    v = '<div>Hello</div>';
    a.buttons().container().appendTo('#datatable-{{$config['module']}}_wrapper .row .col-md-6:eq(0)');

    setInterval(function() {
        a.ajax.reload(null, false); // false -> Don't reset paging
    }, 5000);



});
</script>


@endpush