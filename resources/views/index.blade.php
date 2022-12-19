<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- Styles -->

</head>

<body class="antialiased">

    <div class="p-2">
    @isset($message)
        <div class="alert alert-success alert-dismissible" role="alert">
            {{$message}}
        </div>
        @endif
        <div class="d-flex p-2 justify-items-around justify-content-between">
            <div class="col-lg-2">
                <h3>Transactions</h3>
            </div>
            <div class="col-lg-6">
                <form method="GET" action="/search">
                    @csrf
                    <div class="input-group flex-nowrap">

                        <input type="search" class="form-control" name="search" placeholder="Search address" aria-label="Username" aria-describedby="addon-wrapping">
                        <span class="input-group-text" id="addon-wrapping">
                            <button type="submit">Search</button></span>
                    </div>
                </form>

            </div>
            <div class="col-lg-2">
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal"> Import</button>
            </div>
        </div>
        <div>Total Amount: {{$total}}</div>
        <table class="table  table-hover">
            <thead class="table-dark">
                <!-- <th></th> -->
                <th>Hash</th>
                <th>Timestamp</th>
                <th>Address</th>
                <th>Amount</th>
            </thead>
            <tbody>
                @foreach($entries as $entry)
                <tr>
                    <!-- <td>{{$entry->id}}</td> -->
                    <td>{{$entry->txhash}}</td>
                    <td>{{$entry->datetime}}</td>
                    <td>{{$entry->address}}</td>
                    <td>{{$entry->amount}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/import" enctype='multipart/form-data'>
                        @csrf
                        <div class="input-group flex-nowrap">

                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="file" id="inputGroupFile02">
                                <!-- <label class="input-group-text" for="inputGroupFile02">Upload</label> -->
                            </div>
                            <!-- <button type="submit">Import</button> -->
                        </div>


                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <button type="submt" class="btn btn-primary">Import</button>

                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
 

</body>

</html>