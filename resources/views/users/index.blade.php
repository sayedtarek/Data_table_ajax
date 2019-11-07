<!DOCTYPE html>
<html>
<head>
	<title>FN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
</head>
<body>

            <div class="container">

                <div class="panel-heading">
					<h3>Users info </h3>
				</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
						    <table class="table table-bordered" id="myTable">
							    <thead>
							        <th>Id</th>
							        <th>username</th>
							        <th>first_name</th>
							        <th>last_name At</th>
							        <th>gender</th>
							        <th>status</th>
							    </thead>				
							</table>

						</div>
					</div>
                </div>
            </div>
            <!--end::Section-->
            



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>

<script type="text/javascript">



	 $(document).ready(function () {
        $('#myTable').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "ajax":{
                     "url": "{{ url('/details') }}",
                     "dataType": "json",
                     "type": "GET",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
            	{ "data": "user_id" },
                { "data": "username" },
                { "data": "first_name" },
                { "data": "last_name" },
                { "data": "gender" },
                { "data": "status" }
            ]	 

        });

	});
	
	


</script>


</body>
</html>