                    <section class="wprt-section">
                        <div class="container">
                        <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                        <h2>Latest Demand</h2>
                                    <div class="wprt-lines style-1 custom-3">
                                        <div class="line-1"></div>
                                        <div class="line-2"></div>
                                    </div>
                                    <div class="wprt-spacer" data-desktop="40" data-mobi="40" data-smobi="40"></div>
<table class="table table-bordered table-striped">
          <thead>
            <tr>
                 <th width="6%">S.N</th>
                 <th width="6%">Job id</th>
                 <th width="18%">Job Positon</th>
                 <th>Salary</th>
                 <th>Type</th>
                 <th width="6%">Req No.</th>
                 <th>Fooding</th>
                <th>Accommodation</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
            {{--*/$i=1/*--}}
          @forelse($demands as $d)
                         <tr>
                            <td>{{$i++ }}</td>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->job_position }}</td>
                            <td>{{ $d->salary }}</td>
                            <td>{{ $d->type }}</td>
                            <td>{{ $d->request_number }}</td>
                            <td>{{ $d->fooding }}</td>
                            <td>{{ $d->accomodation}}</td>
                            <td>{{ $d->published_date}}</td>
                            <td><a href="{{ route('applicants.add',$d->id) }}" target="_blank">Apply Online</a>
                                </td>
                        </tr>
                         @empty
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
         @endforelse

        
               
               
      


         <script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
  </script>

    <script>
    
    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#myModal').modal('show');
    });
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        var stuff = $(this).data('info').split(',');
        $('.did').text(stuff[0]);
        $('.dname').html(stuff[1] +" "+stuff[2]);
        $('#myModal').modal('show');
    });

function fillmodalData(details){
    $('#fid').val(details[0]);
    $('#fname').val(details[1]);
    $('#lname').val(details[2]);
    $('#email').val(details[3]);
    $('#gender').val(details[4]);
    $('#country').val(details[5]);
    $('#salary').val(details[6]);
}

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'fname': $('#fname').val(),
                'lname': $('#lname').val(),
                'email': $('#email').val(),
                'gender': $('#gender').val(),
                'country': $('#country').val(),
                'salary': $('#salary').val()
            },
            success: function(data) {
                if (data.errors){
                    $('#myModal').modal('show');
                    if(data.errors.fname) {
                        $('.fname_error').removeClass('hidden');
                        $('.fname_error').text("First name can't be empty !");
                    }
                    if(data.errors.lname) {
                        $('.lname_error').removeClass('hidden');
                        $('.lname_error').text("Last name can't be empty !");
                    }
                    if(data.errors.email) {
                        $('.email_error').removeClass('hidden');
                        $('.email_error').text("Email must be a valid one !");
                    }
                    if(data.errors.country) {
                        $('.country_error').removeClass('hidden');
                        $('.country_error').text("Country must be a valid one !");
                    }
                    if(data.errors.salary) {
                        $('.salary_error').removeClass('hidden');
                        $('.salary_error').text("Salary must be a valid format ! (ex: #.##)");
                    }
                }
                 else {
                     
                     $('.error').addClass('hidden');
                $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" +
                        data.id + "</td><td>" + data.first_name +
                        "</td><td>" + data.last_name + "</td><td>" + data.email + "</td><td>" +
                         data.gender + "</td><td>" + data.country + "</td><td>" + data.salary +
                          "</td><td><button class='edit-modal btn btn-info' data-info='" + data.id+","+data.first_name+","+data.last_name+","+data.email+","+data.gender+","+data.country+","+data.salary+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='" + data.id+","+data.first_name+","+data.last_name+","+data.email+","+data.gender+","+data.country+","+data.salary+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                 }}
        });
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('.item' + $('.did').text()).remove();
            }
        });
    });
</script>

</tbody>

</table>
<div align="center">
                   {!! $demands->render() !!}
               </div>



                 <!--    </tbody>

                    <script>
$(document).ready(function() {
  $('#table').DataTable({
"bStateSave": true
});
} );
</script>
                </table>
               
               <div align="center">
                   {!! $demands->render() !!}
               </div>
      -->





















