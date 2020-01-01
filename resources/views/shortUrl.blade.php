<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>短網址產生器</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
</head>
<body>
   
<div class="container">
    <h4 class="font-weight-bold mb-3 text-success text-center">短網址產生器：請勿置入違法或有危險性的連結。</h4>
    <div class="card">
      <div class="card-header">
        <form method="POST" action="{{ route('short-url.generate.post') }}">
            @csrf
            <div class="input-group mb-3">
              <input type="text" name="url" class="form-control" placeholder="目標網址">
              <div class="input-group-append">
                <button class="btn btn-success" type="submit">產生</button>
              </div>
            </div>
        </form>
      </div>
      <div class="card-body">
   
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
   
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>短網址</th>
                        <th>目標網址</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shortUrls as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td><a href="{{ route('short-url.redirect', $row->code) }}" target="_blank">{{ route('short-url.redirect', $row->code) }}</a></td>
                            <td>{{ $row->url }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
    </div>
</div> 
</body>
</html>