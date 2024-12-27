@extends('layouts.master')
@section('profile')
<section style="background-color: #121214;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                            alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <h2 class="my-3">{{$user->name}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Tên</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-white mb-0" style="color: white;">{{$user->name}}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-white mb-0">{{$user->email}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">SĐT</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" class="text-black mb-0"
                                        value="{{ old('phone', $user->phone) }}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Địa Chỉ</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="address" class="text-black mb-0"
                                        value="{{ old('address', $user->address) }}">
                                </div>
                            </div>
                            <hr>
                            <div class="text-end"><button type="submit" class="btn btn-primary">Cập nhật thông tin</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection