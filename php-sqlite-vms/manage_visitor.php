<?php 
if(isset($_GET['id']) && $_GET['id'] > 0){
   
    $sql = "SELECT * FROM `visitor_list` where `visitor_id` = '{$_GET['id']}' ";
    $query = $conn->query($sql);
    $data = $query->fetchArray();

}

// Generate Manage visitor Form Token
$_SESSION['formToken']['visitor-form'] = password_hash(uniqid(),PASSWORD_DEFAULT);
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

<h1 class="text-center fw-bolder"><?= isset($data['visitor_id']) ? "Update visitor Details" : "Add New visitor" ?></h1>
<hr class="mx-auto opacity-100" style="width:50px;height:3px">
<div class="col-lg-6 col-md-8 col-sm-12 col-12 mx-auto">
    <div class="card rounded-0">
        <div class="card-body">
            <div class="container-fluid">
                <div class="errormes"></div>
                <form action="" id="visitor-form">
                    <input type="hidden" name="formToken" value="<?= $_SESSION['formToken']['visitor-form'] ?>">
                    <input type="hidden" name="visitor_id" value="<?= $data['visitor_id'] ?? '' ?>">
                    <div class="mb-3">
                        <label for="id_number" class="text-body-tertiary">Contact No.</label>
                        <input type="text" class="form-control contactnumber rounded-0" id="id_number" name="id_number" required="required" autofocus value="<?= $data['id_number'] ?? "" ?>" maxlength="10"> 
                        <div class="checklist"></div>
                    </div>
                    <div class="mb-3">
                        <label for="fullname" class="text-body-tertiary">Fullname</label>
                        <input type="text" class="form-control rounded-0" id="fullname" name="fullname" required="required"  value="<?= $data['fullname'] ?? "" ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="text-body-tertiary">Email</label>
                        <input type="email" class="form-control rounded-0" id="email" name="email" value="<?= $data['email'] ?? "" ?>">
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="text-body-tertiary">Floor</label>
                        <select name="contact" id="contact" class="form-select rounded-0" requried>
                            <option value="1" <?= isset($data['contact']) && $data['contact'] == 1 ? "selected" : "" ?>
                            >1</option>
                            <option value="2" <?= isset($data['contact']) && $data['contact'] == 2 ? "selected" : "" ?>>2</option>
                            <option value="4" <?= isset($data['contact']) && $data['contact'] == 4 ? "selected" : "" ?>>4</option>
                            <option value="5" <?= isset($data['contact']) && $data['contact'] == 5 ? "selected" : "" ?>>5</option>
                          
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="remarks" class="text-body-tertiary">Whom To Meet</label>
                        <textarea rows="2" class="form-control rounded-0" id="remarks" name="remarks" ><?= $data['remarks'] ?? "" ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="reason" class="text-body-tertiary">Purpose</label>
                        <textarea rows="5" class="form-control rounded-0" id="reason" name="reason" required="required" ><?= $data['reason'] ?? "" ?></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex">
                             <div class="d-inline-block"><div id="my_camera" class="rounded"></div></div>
                             <div class="d-inline-block mr-3" id="results"> Your captured image will appear here...</div>
                            </div>
                        <input type="hidden" name="image" class="image-tag">
                        <input type="hidden" id="dbimage" name="dbimage" value="<?= $data['userimgurl'] ?? "" ?>">
                        <input type=button id='Snapshot' value="Take Snapshot" onClick="take_snapshot()">
                     </div>
                </form>
            </div>
        </div>
        <div class="card-footer">
            <div class="row justify-content-evenly">
                <button class="btn col-lg-4 col-md-5 col-sm-12 col-12 btn-primary rounded-0 savebutton" form="visitor-form">Save</button>
                <a class="btn col-lg-4 col-md-5 col-sm-12 col-12 btn-secondary rounded-0" href='./?page=visitor'>Cancel</a>
            </div>
        </div>
    </div>
</div>
<script language="JavaScript">
<?php if(isset($_COOKIE['floornumberafterlogin'])){ ?>
    jQuery("#contact option").attr("disabled",true);
    jQuery("#contact option[value='<?php echo  $_COOKIE['floornumberafterlogin'] ;?>']").attr("disabled",false);
    jQuery("#contact").val("<?php echo  $_COOKIE['floornumberafterlogin'] ;?>");
<?php } ?>
Webcam.set({
        width: 200,
        height: 200,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>
<script>
 $(function(){
        $('#visitor-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            _this.find('button').attr('disabled',true)
            $.ajax({
                url:'./Master.php?a=save_visitor',
                method:'POST',
                data:$(this).serialize(),
                dataType:'JSON',
                error:err=>{
                    console.log(err)
                    _el.addClass('alert alert-danger')
                    _el.text("An error occurred.")
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled',false)
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        if('<?= $_GET['toview'] ?? "" ?>' == ""){
                            location.replace("./?page=visitors");
                        }else{
                            location.replace("./?page=view_visitor&id=<?= $data['visitor_id'] ?? "" ?>");
                        }
                    }else{
                        _el.addClass('alert alert-danger')
                    }
                    _el.text(resp.msg)

                    _el.hide()
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled',false)
                }
            })
        })


       


        $('.contactnumber').on('keyup', function() {
                clearTimeout($(this).data('timer'));
                var search = this.value;
                var nuumber = jQuery( ".contactnumber" ).val();
                
                if (search.length == 10) {
                    $(this).data('timer', setTimeout(function() {
                        $.ajax({
                        url:'find_uservp.php',
                        method:'POST',
                        beforeSend: function() {
                               jQuery("#fullname  ,#email ,#remarks, #reason").prop('readonly', true);
                        },
                        data: {'number' : nuumber},
                        success:function(resp){
                            console.log(resp);
                             if(resp !== "1"){
                               var result = $.parseJSON(resp);

                               if(result['checktodayin'] =="in"){
                                    jQuery(".checklist").html("<p style='color:red'>Checkout First this User<a href=?page=visitors>Click Me</a></p>"); 
                                    jQuery("#fullname  ,#email ,#remarks, #reason").prop('readonly', true);
                                    jQuery("#fullname").val(result['fullname']);
                                   jQuery("#contact").val(result['contact']);
                                   jQuery("#email").val(result['email']);
                                   jQuery("#remarks").val(result['remarks']);
                                   jQuery("#reason").val(result['reason']);
                                   document.getElementById('results').innerHTML = '<img name="image" src="upload/'+ result['userimgurl'] +'"/>';
                                   jQuery("#dbimage").val(result['userimgurl']);
                                   jQuery("#remarks, #reason").prop('readonly', false);
                                    jQuery("#my_camera").hide();
                                    jQuery("#Snapshot").hide();
                                    jQuery("#results").hide();
                                    jQuery(".savebutton").hide();
                               }else{
                                   jQuery("#fullname").val(result['fullname']);
                                   jQuery("#contact").val(result['contact']);
                                   jQuery("#email").val(result['email']);
                                   jQuery("#remarks").val(result['remarks']);
                                   jQuery("#reason").val(result['reason']);
                                   document.getElementById('results').innerHTML = '<img name="image" src="upload/'+ result['userimgurl'] +'"/>';
                                   jQuery("#dbimage").val(result['userimgurl']);
                                   jQuery("#remarks, #reason").prop('readonly', false);
                                   jQuery("#my_camera").hide();
                                   jQuery("#Snapshot").hide();
                              }
                            } 
                            else{
                              jQuery("#fullname  ,#email ,#remarks, #reason").prop('readonly', false);  
                            }
                        }

                        });
                    }, 1000));
                }
                else{
                    jQuery(".checklist").hide();
                    jQuery("#fullname  ,#email ,#remarks, #reason").prop('readonly', false);
                    jQuery("#my_camera").show();
                    jQuery("#Snapshot").show();
                    jQuery("#results").show();
                    jQuery(".savebutton").show(); 
                }
            
            });
    })
</script>