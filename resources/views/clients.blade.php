@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <button id="js-add-client" type="button" class="btn btn-action"
                    data-toggle="modal"
                    data-target="#clientEditModal"
                    data-title="Add a Client"
                    data-client="{}">Add a Client</button>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 js-clients-list-container">
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="clientEditModal" tabindex="-1" role="dialog" aria-labelledby="clientEditModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="clientEditModalLabel">Edit client</h4>
                </div>
                <div class="modal-body">
                    @include('client-form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary js-save-client">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('bottomScript')
    <script src="js/clients.js"></script>
    <script src="libraries/jquery/jquery-validation/dist/jquery.validate.min.js"></script>
@stop