@extends('layout.master')

@section('title')
    New York Sanctuary
@endsection

@section('content')
<style>
    .images {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
</style>
<div class="container">
    <p></p>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Book Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Penalty</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Return</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrowbooks as $borrowed)
                            <tr>
                                <td>
                                    @foreach ($borrowed->books as $book)
                                        {{ $book->title }}
                                        <br /><br><br>
                                    @endforeach
                                </td>
                                <td class="images">
                                    @foreach ($borrowed->books as $book)
                                        <img src="{{ asset($book->imgpath) }}" alt="" width="50px" height="50px">
                                    @endforeach
                                </td>
                                <td>
                                    {{ $borrowed->due_date }}
                                </td>
                                <td>
                                    @if ($borrowed->penalty == null)
                                        -
                                    @else
                                        ${{ $borrowed->penalty }}
                                    @endif
                                </td>
                                <td>
                                @foreach ($borrowed->books as $book)
                                {{ $book->pivot->quantity }}
                                <br><br><br>

                            @endforeach
                                </td>
                                <td>
                                    {{ $borrowed->status }}
                                </td>
                                <td>
                                    <a href="{{ route('order.return', $borrowed->id) }}"><i class="fas fa-check"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
