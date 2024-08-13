<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row flex-column flex-md-row w-100">
            <!-- Todo Form -->
            <div class="col-12 col-md-4 todo-input mb-3 mb-md-0">
                <form action="{{ route('add-todo') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">What do you want to do today?</label>
                        <input type="text" class="form-control" id="description" aria-describedby="descriptionHelper"
                            name="description">
                    </div>
                    <div class="d-flex gap-1">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('logout') }}" class="btn btn-warning">Logout</a>
                    </div>
                </form>
            </div>

            <!-- Todo Table -->
            <div class="col-12 col-md-8 todo-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th style="width: 50%">Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todos as $todo)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td
                                    class="{{ $todo->status == 'done' ? 'text-decoration-line-through text-muted' : '' }}">
                                    {{ $todo->description }}
                                </td>
                                <td>{{ $todo->status }}</td>
                                <td class="d-flex gap-1">
                                    <a href="{{ route('edit-todo', $todo->id) }}" class="btn btn-primary">
                                        <i class="bi bi-check-circle"></i>
                                    </a>
                                    <form action="{{ route('delete-todo', $todo->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger"><i class="bi bi-x-circle"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
