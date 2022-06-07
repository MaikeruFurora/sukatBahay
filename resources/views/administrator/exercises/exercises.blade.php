@extends('layout.adminLayout.app')
@section('title','Exercises | Management')
@section('moreCss')
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/summernote/summernote-bs4.css') }}">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection
@section('content')
{{-- @include('administrator.rule_section.modalForm') --}}
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Exercises</h2>
        <p class="section-lead">
            {{ ucfirst(strtolower($rule->title)) }} / Exercises
        </p>
        <div class="row">
           <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <div id="accordion">
                            
                          
                        </div>

                    </div>
                </div>
           </div>
           <div class="col-lg-5 col-md-5 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form id="exerciseForm">@csrf
                      <input type="hidden" name="id">
                        <input type="hidden" name="rule_id" value="{{ $rule->id }}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category</label>
                            <input type="text" class="form-control" value="{{ ucfirst(strtolower($rule->title)) }}" readonly>
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Answer(s)</label>
                          <div class="input-group">
                           <input type="text" class="form-control" name="answers[]">
                            <div class="input-group-append">
                              <button name="btnInput" class="btn btn-outline-success" type="button"><i class="fas fa-plus-circle mt-2" style="font-size: 16px"></i></button>
                            </div>
                          </div>
                         <div id="moreInput"></div>
                         
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Question</label>
                          <textarea name="question" data-height="100" class="form-control summernote" required></textarea>
                        </div>
                      
                        <button type="submit" name="btnExercise" class="btn btn-primary btn-block">Submit</button>
                        <div class="reset"></div>
                      </form>
                </div>
            </div>
           
       </div>
        </div>
    </div>

</section>
@endsection

@section('moreJs')
  <script src="{{ asset('adminstyle/assets/modules/summernote/summernote-bs4.js') }}"></script> 
   <script src="{{ asset('adminstyle/assets/modules/datatables/datatables.min.js') }}"></script>
   <script src="{{ asset('adminstyle/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
      "use strict"
       $('.summernote').summernote({
            height: ($(window).height() - 700),
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                    e.preventDefault();

                    // Firefox fix
                    setTimeout(function () {
                        document.execCommand('insertText', false, bufferText);
                    }, 10);
                }
            }
        });
      let counter=1;
      let _html =``;
      $("button[name='btnInput']").on('click',function(){
        counter++;
        moreInput(counter)
      })

      const moreInput=(increment,value)=>{
        _html=` <div class="input-group mt-1 counter_${increment}">
                  <input type="text" class="form-control" name="answers[]" value="${value??''}">
                    <div class="input-group-append">
                      <button class="btn btn-outline-danger" name="btnMinus" type="button" value="${increment}"><i class="fas fa-minus-circle mt-2" style="font-size: 16px"></i></button>
                    </div>
                </div>`
        $("#moreInput").append(_html);
      }

      $(document).on('click','button[name="btnMinus"]', function(){
        console.log($(this).val());
          $(".counter_"+$(this).val()).remove()
      })


      $("#exerciseForm").on('submit',function(e){
      e.preventDefault();
      $.ajax({
            url: "store",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $("button[name='btnExercise']")
                    .html(`Saving ... `).attr("disabled", true);
            },
        })
            .done(function (data) {
                list($("#exerciseForm input[name='id']").val())
                clearForm()
                getToast("success", "Done", "Successsfuly Save new record");
                $("input[name='id']").val("");
                $("button[name='btnExercise']").html("Submit").attr("disabled", false);
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $("button[name='btnExercise']").html("Submit").attr("disabled", false);
            });
    })

    let rule = $("input[name='rule_id']").val();
   
    const list = (val=null) =>{
        let _question = ``;

        $.ajax({
        url: `list/${rule}`,
        type: "GET",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function(){
            $("#accordion").html(` 
            Loading...`);
        }
       })
        .done(function (response) {
          if (response.exercises.length>0) {   
            response.exercises.forEach((element,i) => {
                i++
                _question+=`
                <div class="accordion">
                              <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-${i}" aria-expanded="${ val==element.id?'true':'' }">
                               
                                <h4>Quesion ${ i }</h4>
                                
                              </div>
                              <div class="accordion-body collapse ${ val==element.id?'show':'' }" id="panel-body-${i}" data-parent="#accordion">
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                  ${ element.question }
                                </p>
                                <br>
                                <small><b>Answer(s):</b> </small>
                                ${ element.answers.map(e=>`<span class="badge badge-success pt-1 pb-1">${e}</span>`) }
                                <div class="float-right">
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-secodnary btn-sm edit_${element.id}" name="btnEdit" value="${element.id}"><i class="fas fa-edit"></i> Edit</button>
                                    <button type="button" class="btn btn-secodnary btn-sm" delete_${element.id} name="btnDelete" value="${element.id}"><i class="fas fa-trash"></i> Delete</button>
                                  </div>
                                </div>
                              </div>
                            </div>
               `
            });
          }else{
            _question=`<small class="text-center">No data available</small>`
          }
          $("#accordion").html(_question);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
        });
    }

    list()


    $(document).on('click','button[name="btnEdit"]',function(){
      let id_edit = $(this).val();
      clearForm()
        $("#exerciseForm button[type='submit']").text("Update");
        $(".edit_"+id_edit).attr("disabled",true)
        $.ajax({
                url:`edit/${id_edit}`,
                type:'GET',
                beforeSend: function(){
                    $(".edit_"+id_edit).html(`Loading...`); 
                }
            }).done(function(data){
              $(".edit_"+id_edit).html(`<i class="fas fa-edit"></i> Edit`); 
                $('#exerciseForm input[name="id"]').val(data.id)
                $('#exerciseForm input[name="rule_id"]').val(data.rule_id)
                // $('#exerciseForm textarea[name="question"]').val(data.question)
                $('.summernote').summernote('code',data.question)
                $("input[name='answers[]']").val(data.answers[0])
                data.answers.map((e,i)=>(i!=0)?moreInput(i,e):'')
                _cancelButton()
            }) .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $("#exerciseForm button[type='submit']").text("Update").attr("disabled", false);
            });
       })


       const _cancelButton = () =>{
        let _cancelButton=` <button type="button" name="reset" class="btn btn-warning btn-block mt-2">Cancel</button>`;
        $("#exerciseForm .reset").html(_cancelButton)
       }

       $(document).on('click','button[name="reset"]',function(){
         clearForm()
         $(this).hide();
       })

       const clearForm = () =>{
          $('#exerciseForm input[name="id"]').val('')
          $('#exerciseForm input[name="rule_id"]').val('')
          // $('#exerciseForm textarea[name="question"]').val('')
          $('.summernote').summernote('reset')
          $('#exerciseForm input[name="answers[]"]').val('')
          $("#moreInput").html('')
          $('button[name="reset"]').hide();
          $('button[name="btnEdit"]').attr('disabled',false);
       }



      $(document).on('click','button[name="btnDelete"]',function(){
        let deletedID = $(this).val();
        if (confirm("Are you sure?")) {
          $.ajax({
          url: `delete/${deletedID}`,
          type: "DELETE",
          data: { _token: $('input[name="_token"]').val() },
          beforeSend: function(){
              $('.delete_'+deletedID).html(` Deleting... `).attr("disabled", true);
              list()
          }
        })
          .done(function (response) {
            $('.delete_'+deletedID).html(`<i class="fa fa-trash"></i> Delete`).attr('disabled',false)
            getToast("success", "Success", "Data has been successfully deleted!");
            content(selectedTag.filter(":selected").val())
          })
          .fail(function (jqxHR, textStatus, errorThrown) {
            $('.delete_'+deletedID).html(`<i class="fa fa-trash"></i> Delete`).attr('disabled',false)
              getToast("error", "Eror", errorThrown);
          });
        }

        return false;
      })

    </script>
@endsection