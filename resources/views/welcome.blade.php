@extends('layout.userLayout.app')
@section('content')
<div class="container">
    <div class="row height d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="text-center">
                <div class="row">
                    <div class="col-md-6 offset-md-3 pl-5 pr-5 pb-0 ">
                        <img src="{{ asset('img/welcome-logo.png') }}" class=" img-fluid" width="35%" alt="">
                    </div>
                  </div>
                
                <h1 class="display-1 text-center mb-5 welcome-title">Sukat<span style="color: green;">Bahay</span></h1>
            </div>
            <div class="search"> <i class="fa fa-search"></i> <input type="text" name="search" class="form-control" placeholder="Have a question? Ask Now"> <button class="btn btn-primary">Search</button> </div>
            <div class="list-group">
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $("input[name='search']").on('keyup',function(){
            let _html = ``;
            let q = $(this).val();
            if (parseInt(q.length)>=3) {
                $.ajax({
                    url:`search`,
                    type:'GET',
                    data:{
                        q
                    }
                }).done(function(data){
                    data.forEach(element => {
                        _html+=`
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">${element.title}</h6>
                                <small>3 days ago</small>
                                </div>
                                <p class="mb-1">Some placeholder content in a paragraph.</p>
                                <small>And some small print.</small>
                            </a>
                        `;

                    });
                    $(".list-group").html(_html)
                }) .fail(function (jqxHR, textStatus, errorThrown) {
                    alert(textStatus)
                    console.log(textStatus)
                })
            } 
        })
    </script>
@endsection