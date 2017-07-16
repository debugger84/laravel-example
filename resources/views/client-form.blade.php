<form action="/clients" class="js-client-form">
    <div class="js-message-container"></div>
    <input type="hidden" name="id" id="id">
    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
    <div class="form-group">
        <label for="name">Name</label>
        <input name="name" class="form-control" required id="name" placeholder="Name">
    </div>
    <div class="form-group">
        <label for="surname">Surname</label>
        <input name="surname" class="form-control" required id="surname" placeholder="Surname">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" required id="email" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="code">Personal Code</label>
        <input name="code" class="form-control" required id="code" placeholder="Personal Code">
    </div>
    <div class="form-group">
        <label for="country">Country</label>
        <input name="country" class="form-control" required id="country" placeholder="Country">
    </div>
    <div class="form-group">
        <label for="city">City</label>
        <input name="city" class="form-control" required id="city" placeholder="City">
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input name="address" class="form-control" required id="address" placeholder="Address">
    </div>
</form>