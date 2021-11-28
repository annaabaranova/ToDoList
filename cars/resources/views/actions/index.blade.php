<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDoList</title>
    <link rel="stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <div class="container my-4">
      <h3 class="text-center">{{$subHeading}}</h3>
      @if(session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
      @endif
      <form method="get" action="{{$route}}">
            @csrf
           <button type="submit" class="btn btn-info">Создать</button>
      </form>



       @foreach($actions as $action)
        <div class="row">
           <div class="col-md-2  m-2 border-info p-4 border-2 border" style="background-color: #FFE900">
              <p>{{$action->name}}</p>
              <form method="post" action="{{$action->routeDelete}}">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn"><i class="fas fa-trash"></i></button>
              </form>
              <a class="btn" href="{{$action->routeEdit}}"><i class="fas fa-pen-square"></i></a>
              
           </div>           
       </div>
       @endforeach
    </div>
</body>
</html>




























