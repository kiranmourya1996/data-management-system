<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use SendGrid\Mail\From;
use SendGrid\Mail\HtmlContent;
use SendGrid\Mail\Mail;
use SendGrid\Mail\PlainTextContent;
use SendGrid\Mail\Subject;
use SendGrid\Mail\To;

class HelperController extends Controller
{
    //
    public function sendMail($email,$case,$data) {

      
     
        if($case=='Registration'){
         $html="<div style='background-color:rgb(255,255,255);margin:0;font:12px/16px Arial,sans-serif;'>
           <table dir='ltr' style='width:640px;color:rgb(51,51,51);margin:0 auto;border-collapse:collapse;border:solid #ddddddb5 2px;'>
              <tbody>
                 <tr>
                    <td style='vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif'>
                       <table id='m_-7134114449099840045m_5739355418147783239main' style='width:100%;border-collapse:collapse'>
                          <tbody>
                           
                             <tr>
                                <td style='vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif'>
                                   <table style='width:100%;border-collapse:collapse'>
                                      <tbody>
                                         <tr style='background-color:#5bbb47'>
                                            <td style='font-size:20px;padding:11px 18px 18px 18px;width:100%;vertical-align:top;line-height:20px;font-family:Arial,sans-serif; text-align:center'>
                                               <p style='margin:2px 0 9px 0;font:20px Arial,sans-serif'> <b style='color:#fff'> Thank you for signing up with ".getenv('APP_NAME').". Here is everything you need to know.</b> </p>
                                            </td>
                                         </tr>
                                         <tr>
                                           <td>
                                             <h2 style='color:#206080;line-height: 1;padding-top: 20px;text-align: center;'>Welcome to the ".getenv('APP_NAME')." Family!</h2>
                                           </td>
                                         </tr>
                                      </tbody>
                                   </table>
                                </td>
                             </tr>
                             <tr>
                                <td style='vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif'>
                                   <table style='width:100%;border-collapse:collapse'>
                                   </table>
                                </td>
                             </tr>
                                <tr>
                                <td style='vertical-align:top;font-size:12px;padding:0 0 20px 20px; line-height:16px;font-family:Arial,sans-serif'>
                                   <table style='width:100%;border-collapse:collapse'>
                                      <tbody>
                                         <tr>
                                            <td style='vertical-align:top;padding-bottom: 21px !important;font-size:12px;line-height:16px;font-family:Arial,sans-serif'>
                                               <h3 style='font-size:18px;color:#206080;margin:15px 0 0 0;font-weight:normal'> Hello - ".$data['name']."</h3>
                                               <p style='margin:5px 0 0 0;font:12px/16px Arial,sans-serif'></p>
                                            </td>
                                         </tr>
                                         <tr>
                                            <td style='vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif'> </td>
                                         </tr>
                                         <tr>
                                            <td style='vertical-align:top;font-size:14px;line-height:16px;font-family:Arial,sans-serif'><p style='color:#206080;margin:0;'><b>Email:</b>".$data['email']." </p> </td>
                                         </tr>
                                         <tr>
                                            <td style='vertical-align:top;font-size:14px;line-height:16px;font-family:Arial,sans-serif'><p style='color:#206080;'><b>Password: </b> ".$data['password']."</p> </td>
                                         </tr>
                                      </tbody>
                                   </table>
                                </td>
                             </tr>
                             </tr>                    
                             <tr>
                                <td style='vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif'>
                                   <table style='width:100%;padding:0 0 0 0;border-collapse:collapse'>
                                      <tbody>
                                         <tr>
                                           <td style='vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif'>
                                             <p style='padding:0 0 20px 15px;margin:10px 0 0 0;font:14px Arial,sans-serif'><span style='font-size:14px;font-weight:bold'> <a style='color: #206080; text-decoration: none;' href='#'><strong>The ".getenv('APP_NAME')." Team</strong> </a></span>
                                          </td>
                                         </tr>
                                         
                                      </tbody>
                                   </table>
                                </td>
                             </tr>
                          
                          </tbody>
                       </table>
                    </td>
                 </tr>
              </tbody>
           </table>
        </div>";
        }else{
         $html="<div style='background-color:rgb(255,255,255);margin:0;font:12px/16px Arial,sans-serif;'>
           <table dir='ltr' style='width:640px;color:rgb(51,51,51);margin:0 auto;border-collapse:collapse;border:solid #ddddddb5 2px;'>
              <tbody>
                 <tr>
                    <td style='vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif'>
                       <table id='m_-7134114449099840045m_5739355418147783239main' style='width:100%;border-collapse:collapse'>
                          <tbody>
                             <tr>
                                <td style='vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif'>
                                   <table style='width:100%;border-collapse:collapse'>
                                      <tbody>
                                         <tr style='background-color:#5bbb47'>
                                            <td style='font-size:20px;padding:11px 18px 18px 18px;width:100%;vertical-align:top;line-height:20px;font-family:Arial,sans-serif; text-align:center'>
                                               <p style='margin:2px 0 9px 0;font:20px Arial,sans-serif'> <b style='color:#fff'> Forgot Password</b> </p>
                                            </td>
                                         </tr>
                                         
                                      </tbody>
                                   </table>
                                </td>
                             </tr>
                             <tr>
                                <td style='vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif'>
                                   <table style='width:100%;border-collapse:collapse'>
                                   </table>
                                </td>
                             </tr>
                                <tr>
                                <td style='vertical-align:top;font-size:12px;padding:0 0 20px 20px; line-height:16px;font-family:Arial,sans-serif'>
                                   <table style='width:100%;border-collapse:collapse'>
                                      <tbody>
                                         <tr>
                                            <td style='vertical-align:top;padding-bottom: 21px !important;font-size:12px;line-height:16px;font-family:Arial,sans-serif'>
                                               <h3 style='font-size:18px;color:#206080;margin:15px 0 0 0;font-weight:normal'> Hello - ".$data['name']."</h3>
                                               <p style='margin:5px 0 0 0;font:12px/16px Arial,sans-serif'></p>
                                            </td>
                                         </tr>
                                         <tr>
                                            <td style='vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif'> </td>
                                         </tr>
                                         <tr>
                                            <td style='vertical-align:top;font-size:14px;line-height:16px;font-family:Arial,sans-serif'><p style='color:#206080;margin:0;'>We received a request to reset the password for your account <b>".$data['email']." </b></p> </td>
                                         </tr>
                                          <tr>
                                            <td style='vertical-align:top;font-size:14px;line-height:16px;font-family:Arial,sans-serif'><p style='color:#206080;margin:0;'>Here is your new password : <b>".$data['password']." </b></p> </td>
                                         </tr>
                                      </tbody>
                                   </table>
                                </td>
                             </tr>
                             </tr>                    
                             <tr>
                                <td style='vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif'>
                                   <table style='width:100%;padding:0 0 0 0;border-collapse:collapse'>
                                      <tbody>
                                         <tr>
                                           <td style='vertical-align:top;font-size:12px;line-height:16px;font-family:Arial,sans-serif'>
                                             <p style='padding:0 0 20px 15px;margin:10px 0 0 0;font:14px Arial,sans-serif'><span style='font-size:14px;font-weight:bold'> <a style='color: #206080; text-decoration: none;' href='#'><strong>The ".getenv('APP_NAME')." Team</strong> </a></span>
                                          </td>
                                         </tr>
                                         
                                      </tbody>
                                   </table>
                                </td>
                             </tr>
                          
                          </tbody>
                       </table>
                    </td>
                 </tr>
              </tbody>
           </table>
        </div>";

        }

         
        $emails=$email;
        $senderEmail = getenv('SENDGRID_EMAIL'); //SENDER_EMAIL
       
        $senderName = getenv('APP_NAME'); //SENDER_NAME
        $sendgrid_key = getenv('SENDGRID_API_KEY'); //SENDER_NAME
        $subject =$case;
       
        $from = new From($senderEmail, $senderName);
        $subject = new Subject($subject);
        $to = new To($emails, "");
        $plainTextContent = new PlainTextContent(
            "and easy to do anywhere, even with PHP"
        );
        $htmlContent = new HtmlContent($html);
        $email = new Mail(
            $from,
            $to,
            $subject,
            $htmlContent
        );
        $sendgrid = new \SendGrid($sendgrid_key);
        try {
            $response = $sendgrid->send($email);
           
            return $response;
        }catch (Exception $e) {
          
            echo 'Caught exception: '.  $e->getMessage(). "\n";
        }
    	

        
       
        

       
    }

}


