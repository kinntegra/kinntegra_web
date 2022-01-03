@extends('layouts.master')

@section('style')

<style>
    .center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 2rem;
  width: 10%;
}
            #loading{
/* margin: 0px;
padding: 0px; */
position: fixed;
right: 0px;
top: 0px;
width: 100%;
height: 100%;
/* opacity: 0.9; */
z-index: 9999;

background: rgba(255,255,255,1.0);
backdrop-filter: blur(5px);
}

#loading .loader{position: absolute; color: 000; top: 40%; left: 35%;font-size: 25px;text-align: center;}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="col d-flex justify-content-center align-item-center">
        <div class="card col-12">

            <div class="card-body text-center">
                <div class="row">
                    <div class="col-12">
                            <img class="card-img-top center" src="/assets/images/right.png" alt="Card image">

                        <h1 class="card-title">Hooray!</h1>
                        <p class="card-text">Associate account is setup and ready to use</p>
                        {{-- <p class="card-text">Download below Associate BSE File and Upload it on BSE</p>
                        <button type="button" class="btn btn-primary">Download Associate BSE File</button> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
$('input[type=radio][name=bse_upload]').change(function() {
    if (this.value == 1) {
        $("#bse_upload_yes").attr('checked',true);
        $("#bse_upload_no").attr('checked',false);
    }
    else if (this.value == 0) {
        $("#bse_upload_no").attr('checked',true);
        $("#bse_upload_yes").attr('checked',false);
    }
});

$(".send_email").on("click", function (e) {
    let bse_upload = $('input[name="bse_upload"]:checked').val();
    let id = $('input[name="id"]').val();
    let type = "POST";
    let url = "/associate/"+id+"/message";
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: url,
        type:type,
        data:{
          id:id,
          bse_upload:bse_upload,
          _token: _token
        },
        success:function(response){
          console.log(response);
        //   if(response) {
        //     $('.success').text(response.success);
        //     $("#ajaxform")[0].reset();
        //   }
        },
    });
});
</script>
@endsection
