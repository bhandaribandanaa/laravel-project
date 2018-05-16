@extends('admin.layout.app')
@section('title', 'Newsletter Management')
@section('main')
    <div class="container">
        <div class="block-header">
            <h2>Subscribed Emails</h2>
        </div>

        <div class="card">
            <div class="card-header">
            </div>

            <?php $success = Session::get('success'); ?>
            @if($success)
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    {{ $success }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>S N</th>
                        <th>Email</th>
                        <th>Created at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($newsletters)>0)
                        @foreach($newsletters as $index=>$newsletter)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $newsletter->email }}</td>
                                <td>{{ $newsletter->created_at }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"><h5 style="text-align: center;">No newsletter subscriber.</h5></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {!! $newsletters->render() !!}
            </div>
        </div>
    </div>
@stop
@section('footer_js')
@stop