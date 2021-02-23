<select type="text" class="form-control multiselect multiselect-icon sizecheck search-filter" role="multiselect">

        <option value="0" disabled data-icon="glyphicon-picture" selected="selected">Select Sales Person</option>
        @foreach($users_sales as $row)
        <option value="{{$row->first_name}}" data-icon="glyphicon-link">{{$row->first_name. $row->last_name}}</option>
        @endforeach
</select>
