let currentstep = current.attr('data-step');
            let currentid = current.attr('id');

            let currentLink = "[data-form=" + currentid + "]";
            let currentCount = parseInt(currentstep);
            let entitytype = $('#entitytype_id').val();
            let profession = $('#profession_id').val();
            let minor = $('#is_minor').val();
            let next = '';
            if(currentstep == 7)
            {
                if(profession == 1 || profession == 2 || profession == 3)
                {
                    if(entitytype == 1 || entitytype == 2 || entitytype ==3)
                    {
                        next = $(".trial[data-step=" + (currentCount + 4) + "]");
                    }
                    else{
                        next = $(".trial[data-step=" + (currentCount + 1) + "]");
                    }
                }else{
                    next = $(".trial[data-step=" + (currentCount + 1) + "]");
                }
            }else if(currentstep == 8)
            {
                if(entitytype == 1 || entitytype == 2 || entitytype ==3)
                {
                    next = $(".trial[data-step=" + (currentCount + 3) + "]");
                }
                else{
                    next = $(".trial[data-step=" + (currentCount + 1) + "]");
                }
            }else if(currentstep == 9)
            {
                if(minor == 0)
                {
                    next = $(".trial[data-step=" + (currentCount + 2) + "]");
                }
                else{
                    next = $(".trial[data-step=" + (currentCount + 1) + "]");
                }
            }else if(currentstep == 11)
            {
                $.get("/encrypt?data="+data.id, function(data, status){
                    //window.location.href = '/associate/'+data;
                    window.location.replace('/associate/'+data);
                });
                return true;
            }
            else{
                next = $(".trial[data-step=" + (currentCount + 1) + "]");
            }

            // let height = next.height();

            let nextstep = next.attr('data-step');
            let nextid = next.attr('id');

            let nextLink = "[data-form=" + nextid + "]";
            let circleAttr = $('.circle').attr('stroke-dasharray');
            let percentage = parseInt(circleAttr.substr(0, circleAttr.indexOf(',')));

            current.removeClass('active');
            current.addClass('completed');
            $('.step-forms form').removeClass('active');
            $(".form-lists li:not(.isParent)").removeClass('active');
            // $('.step-forms').css('height', height + 'px');

            if (isAccount) {
                $(nextLink).addClass('skip');
                $("#account-opening").addClass('active');
                $("[data-form=account-opening]").addClass('active');
                $(currentLink).addClass('completed');
            } else {
                next.addClass('active');
                $('#'+nextid+' select').select2({
                    width: '100%',
                    minimumResultsForSearch: 5
                });
                //Login to change the Step Value
                $('input[name=step]').val(nextstep);
                //End to Change Logic
                if ($(currentLink).hasClass('isParent')) {
                    $(nextLink).addClass('sub-active');
                } else if ($(currentLink).hasClass('isChild') && !($(nextLink).hasClass('isChild'))) {
                    $(currentLink).parent().parent().addClass('completed');
                    $(currentLink).parent().parent().removeClass('active');
                    $(nextLink).addClass('active');

                } else if ($(currentLink).hasClass('isChild') && ($(nextLink).hasClass('isChild'))) {
                    $(nextLink).addClass('sub-active');
                    $(currentLink).addClass("sub-completed");
                }
                else {
                    $(nextLink).addClass('active');
                    $(currentLink).addClass('completed');
                }
                $('.circle').attr('stroke-dasharray', Math.round((currentCount / formLength) * 100) + ', 100');
                $('.percentage').html(Math.round((currentCount / formLength) * 100) + '%');
            }
            //console.log(current.serializeArray());
            setTimeout(() => {
                current.hide();

                $('#loading').hide();
                $('select').select2({
                    width: '100%',
                    minimumResultsForSearch: 5
                });
                $('input[name="birth_incorp_date"],input[name="nominee_birth_date"],input[name="gst_validity"],input[name="shop_est_validity"]').datepicker({
                    autoclose: true
                });
                $('input[name="arn_validity"],input[name="euin_validity"],input[name="ria_validity"]').datepicker({
                    autoclose: true
                });
                $('input[name="nism_va_validity"],input[name="nism_xa_validity"],input[name="nism_xb_validity"],input[name="cfp_validity"],input[name="cwm_validity"]').datepicker({
                    autoclose: true
                });

                $('input[name="ca_validity"],input[name="cs_validity"],input[name="course_validity"]').datepicker({
                    autoclose: true
                });

                //cs_validity
                $('input[name="primary_color').ColorPicker();
                $('input[name="secondary_color').ColorPicker();

            }, 500);


            @if(isset($data->status))
                                @if($data->status == 2)
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button type="button" class="proceed btn btn-primary btn-lg" style="min-width: 11rem">Accept</button>
                                    </div>

                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#RejectModal" style="min-width: 11rem">Reject</button>
                                    </div>

                                    <div class="modal fade" id="RejectModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog"><!-- modal-lg-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Reason To Reject</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12 justify-content-center">
                                                            <div class="form-group">
                                                                <label for="reject-reason">Specify the Reject Reason in details</label>
                                                                <textarea class="form-control" id="reject-reason" name="reject-reason" rows="5"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="proceed btn btn-primary btn-lg" style="min-width: 11rem">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @elseif($data->status == 4 || $data->status == 7)
                                <button type="button" class="proceed btn btn-primary btn-lg">Submit</button>
                                @else
                                <button type="button" class="btnedit proceed btn btn-primary btn-lg">Submit</button>
                                @endif

                            @else
                                <button type="button" class="proceed btn btn-primary btn-lg">Confirm</button>
                            @endif
