<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <header>
        @include('layouts.app')
    </header>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Задача</th>
                    <th scope="col">Время</th>
                    <th scope="col">Статус</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">{{ $list->name }}</th>
                    <th>{{ $list->time }}</th>
                    <th>
                        @if ($list->status === 'В процессе')
                            <form action="{{ route('list.update', $list->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()">
                                    <option value="В процессе" selected>В процессе</option>
                                    <option value="Выполнено">Выполнено</option>
                                </select>
                            </form>
                        @else
                            <span
                                class="status-color {{ $list->status === 'Выполнено' ? 'status-completed' : 'status-time-expired' }}">
                                {{ $list->status }}
                            </span>
                        @endif
                    </th>
                    <th>
                        <form action="{{ route('list.destroy', $list->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <Button type="submit">Удалить</Button>
                        </form>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
