<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dashboard</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        table tr td{
            text-align: center;
        }
        table tr th{
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12" style="padding: 15px">
            <div>
                <button class="btn btn-primary" onclick="logoutForm.submit()" style="float: right">logout</button>
            </div>
            <b>Report of sent message</b>
            <hr/>
        </div>
        <div class="col-md-12">
        <table class="table table-responsive table-hover">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">gateway</th>
                <th scope="col">message</th>
                <th scope="col">receiver</th>
                <th scope="col">status</th>
                <th scope="col">date and time</th>
                <th scope="col">other information</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $index=> $datum)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$datum->gateway}}</td>
                    <td>{{$datum->text}}</td>
                    <td>{{$datum->receiver}}</td>
                    <td>{{$datum->status_text}} @if(isset($datum->status_code)) ({{$datum->status_code}}) @endif</td>
                    <td>{{$datum->created_at}}</td>
                    <td>{{$datum->extra_information}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <div class="col-md-12" style="text-align: center">
            {{$data->links()}}
        </div>
    </div>

</div>
<form id="logoutForm" method="post" action="/logout">
    @csrf
</form>
</body>
</html>
