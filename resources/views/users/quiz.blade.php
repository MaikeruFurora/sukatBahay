@extends('layout.userLayout.app')
@section('moreCss')
    <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/chartjs/chart.min.js') }}">
@endsection
@section('content')

<div class="container mt-5">  
    <div class="row gx-5 gy-3">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <h3 class="fw-bolder mb-3 mt-3" style="color:#1A3066">Test your Knowledge</h3>
            <div class="card mb-5 shadow-sm">
                <div class="card-header">
                
                    <select class="form-select" name="selectRule" aria-label="Default select example">
                        <option selected value="NoSelect">Select Rule</option>
                        @foreach ($menu as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                      </select>

                </div>
                <div class="card-body">
                    <form action="" id="formQuiz">@csrf
                        <span class="showQuiz">
                            <div class="text-center my-5">
                                <h3 class="fw-bolder">
                                    <img src="{{ asset('img/logo/question.svg') }}" width="50%">
                                </h3>
                                <small style="font-size: 15px" class="lead fw-normal text-muted mt-5 p-5">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi ipsam inventore alias
                                </small>
                            </div>
                        </span>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <h3 class="fw-bolder mb-3 mt-3" style="color:#1A3066">Your Progress</h3>
            <div class="card">
                <div class="card-header">
                    Your Progress
                </div>
                <div class="card-body">
                    sasa
                </div>
            </div>
        </div>
    </div><!-- row -->
</div><!-- container -->
@endsection
@section('js')
    <script>

        const answer_db={}

        const spreadAnswers = (answers) =>{
            let _answers=''
            for ([index,value] of answers.entries()) {  _answers +=`<li class="list-group-item">${++index}. ${value}</li>` }

            return _answers
        }

        const checkAnswer = (our_answer,your_answer) =>{
            // alert(your_answer)
            for ([index,value] of our_answer.entries()) { 
                console.log(your_answer);
             }

        }

        

        const loadQuestion = (data) => {
            let _html=``;

            for ([index, val] of data.entries()) {
                _html+=`
                <div class="card mt-3 mb-3 shadow-sm">
                    <div class="card-body">
                        <span style="font-size:13px">
                            ${val.question}
                        </span>
                    </div>  
                    <div class="card-footer p-2">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3" style="font-size:13px">Write your answer here:</span>
                            <input type="text" name="answer[]" style="font-size:13px" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                        <ul class="list-group mt-2" style="font-size:13px">
                        
                        ${ spreadAnswers(val.answers) }
                        
                        </ul>
                    </div>
                </div>
                `   
            }

            _html+=`<button type="submit" class="btn btn-primary">Submit</button>`;


            if (Array.isArray(data) && !data.length) {
                _html=`
                <div class="text-center my-5">
                    <h3 class="fw-bolder">No quiz available</h3>
                    <small style="font-size: 15px" class="lead fw-normal text-muted mb-0">How can we help you?</small>
                </div>
                `;
            }

            $(".showQuiz").html(_html)

        }

        $("select[name='selectRule']").on('change',function(){
            
            if ($(this).val()=="NoSelect") {
                _html=`
                <div class="text-center my-5">
                    <h3 class="fw-bolder">
                        <img src="{{ asset('img/logo/question.svg') }}" width="50%">
                    </h3>
                    <small style="font-size: 15px" class="lead fw-normal text-muted mt-5 p-5">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi ipsam inventore alias
                    </small>
                </div>
                `;
                $(".showQuiz").html(_html)
            }else{

                $.ajax({
                    url:`quiz/list/${$(this).val()}`,
                    type:'GET',
                    beforeSend:function(){
                        $(".showQuiz").html(`
                        <div class="text-center my-5">
                            <h3 class="fw-bolder">Loading...</h3>
                            <small style="font-size: 15px" class="lead fw-normal text-muted mb-0">Please wait</small>
                        </div>
                        `)
                    },
                }).done(function(data){
                    loadQuestion(data)
                }).fail(function(jqxHR, textStatus, errorThrown){
                    alert(jqxHR, textStatus, errorThrown)
                });
                
            }

        })


        $('#formQuiz').on('submit',function(e){
            e.preventDefault()
            $.ajax({
                url:'quiz/store',
                type:'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
               
           }) .done(function (data) {
                console.log(data);
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                alert(jqxHR, textStatus, errorThrown)
            });
       })
    </script>
@endsection