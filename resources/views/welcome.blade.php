@extends('layout.userLayout.app')
@section('content')
<div class="container">
    <div class="row height d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="text-center">
                <h1 class="display-1 text-center my-5 welcome-title">Sukat <span style="color: #004d39;">Bahay</span></h1>
            </div>
            <form action="{{ route('search.force') }}" method="GET">
                <div class="search"> <i class="fa fa-search"></i> <input type="text" name="search" class="form-control" placeholder="Have a question? Ask Now" required> <button class="btn btn-primary">Search</button> </div>
            </form>
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
                    url:`search/auto-suggest`,
                    type:'GET',
                    data:{
                        q
                    }
                }).done(function(data){
                    
                    if(data.length > 0){
                        data.forEach(element => {
                           
                                _html += `<a href="/rule-content/${removeTags(element.rule_slug)}/${removeTags(element.section_slug) }/${q}" class="list-group-item list-group-item-action" style="font-size:14px" onclick="" >${cleanDisplay(element,q)}</a>`;
                         
                        });
                    }else {
                        // _html += '<a href="#" class="list-group-item list-group-item-action disabled">No Data Found</a>';
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

        const removeTags = (str) => {
                if ((str===null) || (str===''))
                    return false;
                else
                    str = str.toString();
                    
                // Regular expression to identify HTML tags in 
                // the input string. Replacing the identified 
                // HTML tag with a null string.
                return str.replace( /(<([^>]+)>)/ig, '');
            }
        const cleanDisplay = (value,search) =>{
            let pos = value.content.indexOf(search);
            let len = value.content.length

            return value.section
            +'<br>&nbsp;<i class="fas fa-search"></i>&nbsp;'+value.content.substr(ranges(0,pos-4),ranges(pos,len))+' ...';
        }
        const  ranges = (start, end) => {
            /* generate a range : [start, start+1, ..., end-1, end] */
            let len = end - start + 1;
            let a = new Array(len);
            let val;
            for (let i = 0; i < len; i++) a[i] = start + i;
            console.log(a);

            while (parseInt(a.length+1)>=20) {    
                return (a.length%2!=1)?(a.length-1):(a.length/2)
            }

            
        }
        


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