@extends('front.layouts.master')
@section('title', 'iletişim')
@section('bg','https://d2vision.com/blog/img/contact-bg.jpg')
@section('content')

    <div class="col-md-8 mx-auto">
        @if(session('success'))

         <div class="alert alert-success">
                    {{session('success')}}

        </div>
        @endif
            @if($errors->any())
                <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>
                            {{$error}}
                        </li>
                        @endforeach
                </ul>
                </div>
            @endif

        <p>Bizimle iletişime geçebilirsiniz</p>

        <form method="post" action="{{route('contact.post')}}">
            @csrf
            <div class="control-group">
                <div class="form-group  controls">
                    <label>Ad Soyad</label>
                    <input type="text" class="form-control" value="{{old('name')}}" placeholder="Adınız Soyadınız" name="name" required>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group  controls">
                    <label>Email Addresi</label>
                    <input type="email" class="form-control" value="{{old('email')}}" placeholder="Email Addresiniz" name="email" required >
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group col-xs-12  controls">
                    <label>Konu</label>
                    <select class="form-control" name="topic" >
                        <option @if(old('message')=='Bilgi') selected @endif> Bilgi</option>
                        <option @if(old('message')=='Destek') selected @endif>Destek</option>
                        <option @if(old('message')=='Genel') selected @endif>Genel</option>
                    </select>
                       </div>
            </div>
            <div class="control-group">
                <div class="form-group  controls">
                    <label>Mesajınız</label>
                    <textarea rows="5" class="form-control"  placeholder="Mesajınız" name="message" required >{{old('message')}}</textarea>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
            </div>
        </form>
    </div>

<div class="col-md-4">


</div>
@endsection
