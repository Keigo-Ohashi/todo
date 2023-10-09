@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="todo__alert">

        {{-- 進捗メッセージ --}}
        @if (session('message'))
            <div class="todo__alert--success">
                {{ session('message') }}
            </div>
        @endif

        {{-- エラーメッセージ --}}
        @if ($errors->any())
            <div class="todo__alert--danger">
                <ul class="">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

    <div class="todo__content">

        {{-- Todoに追加 --}}
        <form class="create-form" method="post" action="/todos">
            @csrf

            <div class="create-form__item">
                <input class="create-form__item-input" type="text" name="content">
            </div>

            <div class="create-form__button">
                <button class="create-form__button-submit" type="submit">作成</button>
            </div>

        </form>

        {{-- Todo一覧 --}}
        <div class="todo-table">

            <table class="todo-table__inner">

                <tr class="todo-table__row">
                    <th class="todo-table__header">Todo</th>
                </tr>

                @foreach ($todos as $todo)
                    <tr class="todo-table__row">

                        {{-- 表示・更新 --}}
                        <td class="todo-table__item">

                            <form class="update-form" action="/todos/update" method="post">
                                @method('patch')
                                @csrf

                                <div class="update-form__item">
                                    <input class="update-form__item-input" type="text" name="content"
                                        value="{{ $todo['content'] }}">
                                    <input type="hidden" name='id' value="{{ $todo['id'] }}">
                                </div>

                                <div class="update-form__button">
                                    <button class="update-form__button-submit" type="submit">更新</button>
                                </div>

                            </form>
                        </td>

                        {{-- 削除 --}}
                        <td class="todo-table__item">
                            <form class="delete-form" action="/todos/delete" method="post">
                                @method('delete')
                                @csrf
                                <div class="delete-form__button">
                                    <input type="hidden" name='id' value="{{ $todo['id'] }}">
                                    <button class="delete-form__button-submit" type="submit">削除</button>
                                </div>
                            </form>
                        </td>

                    </tr>
                @endforeach

            </table>

        </div>
    @endsection
