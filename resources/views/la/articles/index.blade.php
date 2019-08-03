@extends("la.layouts.app")

@section("contentheader_title", "Articles")
@section("contentheader_description", "Articles listing")
@section("section", "Articles")
@section("sub_section", "Listing")
@section("htmlheader_title", "Articles Listing")

@section("headerElems")
@la_access("Organizations", "create")
@endla_access
@endsection

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			<h1>Total Articles : <a href="{{ url(config('laraadmin.adminRoute') . '/articles') }}">{{$total_articles}}</a></h1>
		</tr>
		</thead>
		<tbody>
		</tbody>
		</table>
	</div>
</div>
@la_access("Organizations", "create")

@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
@endpush