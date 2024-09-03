<?php 
require_once("includes/initialize.php");
$usermail = User::field_by_id(1,email);
$ccusermail = User::field_by_id(1,optional_email);
$sitename = Config::getField('sitename',true);

if(isset($_POST['txn_id']) and !empty($_POST['txn_id'])):

  $transRec = Bookingmaster::find_by_token($_POST['item_number']);

  $transchild = Bookingchild::get_info_by($transRec->id);

  $body = '
    <h3>Room Information</h3>
    <table class="table-form">
      <tbody>
        <tr>
          <td>
            <label>CheckIn Date</label>
            <div>'.$transRec->checkin_date.'</div>
          </td>
          <td>
            <label>CheckOut Date</label>
            <div>'.$transRec->checkout_date.'</div>
          </td>
          <td>
            <label>No.of Nights</label>
            <div>'.$transRec->totnight.'</div>
          </td>
        </tr>
      </tbody>      
    </table>
    <table class="table-form">
      <thead>
        <tr>
          <th>S.No.</th>
          <th>Type of Room</th>
          <th>No of Room</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>';
      if($transchild){
        $sn=1;
        foreach($transchild as $row):
        $prc = !empty($row->no_of_room)?$row->no_of_room:"";  
        $sntp = !empty($row->no_of_room)?$sn:"";  
        $body.='<tr>
                  <td>'.$sntp.'</td>
                  <td>'.$row->room_type.' '.$row->room_label.'</td>
                  <td>'.$prc.'</td>
                  <td>'.$row->currency.' '.$row->price.'</td>
                </tr>';
        $sn++;        
        endforeach;
      }     

  $body.='
    </tbody>      
  </table>
  <h3>Personal Information</h3>
  <table class="table-form">
    <tbody>
      <tr>
        <td>
          <label>Access ID</label> : '.$transRec->txtnid.'          
        </td>
      </tr>
      <tr>
        <td><label>First Name</label>: '.$transRec->first_name.'</td>
        <td><label>Last Name</label>: '.$transRec->last_name.'</td>
      </tr>
      <tr>
        <td><label>Address</label>: '.$transRec->address.'</td>
        <td><label>City</label>: '.$transRec->city.'</td>       
      </tr>
      <tr>
        <td><label>Zip Code</label>: '.$transRec->zipcode.'</td>
        <td><label>Country</label>: '.$transRec->country.'</td>
      </tr>   
      <tr>
        <td><label>Mail Address</label>: '.$transRec->mailaddress.'</td>
        <td><label>Contact Number</label>: '.$transRec->contact.'</td>
      </tr>     
      <tr>
        <td><label>Booking Date</label>: '.$transRec->booking_date.'</td>
      </tr>
    </tbody>
  </table>';

  $body.='<h3>Payment Information</h3>
          <table class="table-form">
            <tbody>';
            foreach($_POST as $ky=>$vals){
              $body.='<tr>
                        <td><label>'.$ky.'</label>: '.$vals.'</td>
                      </tr>';
            }
  $body.='  </tbody>
          </table>';



  /*
  * mail info
  */
  
  $mail = new PHPMailer(); // defaults to using php "mail()"
   
  $mail->SetFrom($transRec->mailaddress, $fullname);
  $mail->AddReplyTo($transRec->mailaddress,$fullname);
  
  $mail->AddAddress($usermail, $sitename);
  // if add extra email address on back end
  if(!empty($ccusermail)){
    $rec = explode(';', $ccusermail);
    if($rec){
      foreach($rec as $row){
        $mail->AddCC($row,$sitename);
      }   
    }
  }
  
  $mail->Subject    = $sitename. " Rooms : Booking Inquery";
  
  $mail->MsgHTML($body);
  
  if(!$mail->Send()) {
    redirect_to(BASE_URL.'unsuccess.php');
  }else{
    $recUpdate->save();
    redirect_to(BASE_URL.'success.php');
  }

endif; 
  
?>