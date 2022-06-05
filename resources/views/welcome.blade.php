@extends('layout.userLayout.app')
@section('content')
<div class="container">
    <div class="row height d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="text-center">
                {{-- <div class="row">
                    <div class="col-md-6 offset-md-3 pl-5 pr-5 pb-0 ">
                        <img src="{{ asset('img/welcome-logo.png') }}" class=" img-fluid" width="35%" alt="">
                    </div>
                  </div> --}}
                
                <h1 class="display-1 text-center mb-5 welcome-title">Sukat<span style="color: green;">Bahay</span></h1>
            </div>
            <div class="search"> <i class="fa fa-search"></i> <input type="text" name="search" class="form-control" placeholder="Have a question? Ask Now"> <button class="btn btn-primary">Search</button> </div>
            <span id="search_result"></span>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $("input[name='search']").on('keyup',function(){
            let _html = `<div class="list-group">`;
            let q = $(this).val();
            if (parseInt(q.length)>=4) {
                $.ajax({
                    url:`search`,
                    type:'GET',
                    data:{
                        q
                    }
                }).done(function(data){
                    
                    if(data.length > 0){
                        data.forEach(element => {
                           
                                _html += '<a href="#" class="list-group-item list-group-item-action" style="font-size:14px" >'+
                             
                                    cleanDisplay(element,q)
                                    +'</a>';
                         
                        });
                    }else {
                        _html += '<a href="#" class="list-group-item list-group-item-action disabled">No Data Found</a>';
                    }

                    _html += '</div>';

                    $("#search_result").html(_html)
                }) .fail(function (jqxHR, textStatus, errorThrown) {
                    alert(textStatus)
                    console.log(textStatus)
                })
            }else{
                $("#search_result").html('')
                // recent_search
            }
        })

        const cleanDisplay = (value,search) =>{
            let pos = value.content.indexOf(search);
            let len = value.content.length
            return value.section+'<br>'+value.content.substr(0,(ranges(pos,len)/2));
        }
        const  ranges = (start, end) => {
            /* generate a range : [start, start+1, ..., end-1, end] */
            var len = end - start + 1;
            var a = new Array(len);
            for (let i = 0; i < len; i++) a[i] = start + i;
            return a.length;
        }
        console.log(ranges(5,10));

        const recent_search = () =>{
            // $.ajax({
            //     url:`recent/search`,
            //     type:'GET',
            //     data:{
            //         q
            //     }
            // }).done(function(data){
            //     data.forEach(element => {
            //         _html+=`
            //             <a href="#" class="list-group-item list-group-item-action">
            //                 <div class="d-flex w-100 justify-content-between">
            //                 <h6 class="mb-1">${element.title}</h6>
            //                 <small>3 days ago</small>
            //                 </div>
            //                 <p class="mb-1">Some placeholder content in a paragraph.</p>
            //                 <small>And some small print.</small>
            //             </a>
            //         `;

            //     });
            //     $(".list-group").html(_html)
            // }) .fail(function (jqxHR, textStatus, errorThrown) {
            //     alert(textStatus)
            //     console.log(textStatus)
            // })
        }
    </script>
@endsection