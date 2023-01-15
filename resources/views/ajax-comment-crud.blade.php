<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Comment Bank</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{mix ('css/app.css')}}" > 
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    @extends('base')
    @section('main')
    
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12 card-header text-center font-weight-bold">
                <h2>Comment Bank</h2>
            </div>

            <div id="message"></div>

            <div class="col-md-12 mt-1 mb-2"><button type="button" id="addNewComment" class="btn btn-success">Add Comment</button>
            </div>

            <div class="col-md-12">
                <table id="Table1" class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">#</th>
                            <th scope="col">Comment ID</th>
                            <th scope="col">Comment Name</th>
                            <th scope="col">Forename</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Validated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(empty($comments))
                        <tr>
                            <td>There are no comments</td>
                        </tr>
                        @else
                        @foreach ($comments as $comment)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $comment->comment_id }}</td>
                            <td>{{ $comment->comment_name }}</td>
                            <td>{{ $comment->forename }}</td>
                            <td>{{ $comment->surname }}</td>
                            <td>{{ $comment->email }}</td>
                            <td>{{ $comment->validated }}</td>
                            <td>
                                <button type="button" data-id="' + item.id + '" class="btn btn-primary edit btn-sm">Edit</button>\
                                <button type="button" data-id="' + item.id + '" class="btn btn-danger delete btn-sm"> Delete </button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

                <input id="btnGet" type="button" value="Get Selected" />

            </div>
        </div>

        <div>
            <textarea id="messageList" rows="10" cols="100">Selection</textarea>
            <button type="button" id="copy">Copy</button>
        </div>
    </div>


    <!-- boostrap model -->
    <div class="modal fade" id="ajax-comment-model" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ajaxCommentModel"></h4>
                </div>

                <div class="modal-body">
                    <ul id="msgList"></ul>
                    <form action="javascript:void(0)" id="addEditCommentForm" name="addEditCommentForm" class="form-horizontal" method="POST">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Comment ID</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="comment_id" name="comment_id" placeholder="Enter comment ID" value="" maxlength="5" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Comment Name</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="comment_name" name="comment_name" rows="4" cols="10">Enter comment Summary</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Forename</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="forename" name="forename" placeholder="Enter forename" value="" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Surname</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter surname" value="" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Validation</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="validation" name="validation" placeholder="Validated?" value="" required="">
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-add" value="addNewcomment">Save
                            </button>
                            <button type="submit" class="btn btn-primary" id="btn-save" value="Updatecomment">Save changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- end bootstrap model -->


<!-- <script src="{{asset('js/app.js')}}"></script> -->
</body>

</html>