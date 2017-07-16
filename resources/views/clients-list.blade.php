<?php /** @var \App\Entity\Client[] $clients */ ?>
@if (count($clients))
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th>Surname</th>
                <th>Name</th>
                <th>Email</th>
                <th>Personal Code</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td><a href="#"><span class="glyphicon glyphicon-edit"
                              data-toggle="modal"
                              data-target="#clientEditModal"
                              data-title="Edit the Client {{ $client->getSurname() }}"
                              data-client="{{ json_encode($client) }}"></span></a>
                    </td>
                    <td><a href="#" class="js-remove-client"
                           data-client_id="{{ $client->getId() }}"
                           data-client_surname="{{ $client->getSurname() }}"><span class="glyphicon glyphicon-remove"></span></a>
                    </td>
                    <td>{{ $client->getSurname() }}</td>
                    <td>{{ $client->getName() }}</td>
                    <td>{{ $client->getEmail() }}</td>
                    <td>{{ $client->getCode() }}</td>
                    <td>{{ $client->getAddress() }}, {{ $client->getCity() }}, {{ $client->getCountry() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="alert alert-info">The clients list is empty. Use the adding button, to add clients.</div>
@endif