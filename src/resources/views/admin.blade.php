@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin_content">
    <div class="admin_inner">
        <div class="user_name">
            <p>{{ Auth::user()->name }}</p>
        </div>
        <div class="admin_item">
            <div class="representative_info">
                <div class="representative_ttl">
                    <p>店舗代表者一覧</p>
                </div>
                <div class="representative_item">
                    <div class="representative_table">
                        <table>
                            <tr class="representative_table_row">
                                <td>Name</td>
                                <td>email</td>
                                <td></td>
                            </tr>
                            @foreach($representatives as $representative)
                            <tr class="representative_table_row">
                                <td>{{ $representative->name }}</td>
                                <td>{{ $representative->email }}</td>
                                <td>
                                    <div class="delete">
                                        <form action="/representative/delete" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $representative->id }}">
                                            <button type="submit">削除</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="paginate">
                        {{ $representatives->render('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection