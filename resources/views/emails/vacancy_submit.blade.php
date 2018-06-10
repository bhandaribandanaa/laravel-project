<!DOCTYPE html>
                      <html lang="en">
                      <head>
                      <meta charset="utf-8">
                      <meta name="viewport" content="width=device-width, initial-scale=1.0">
                      <meta name="description" content="">
                      <meta name="author" content="">
                      <link href="" type="images/png" rel="icon" />
                      <title>Job Application </title>

                      </head>
                      <body >
                      <table border="0" style="width:650px; background:#f2f2f2; color:#333; margin:auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:1.6">
                      <tr><td style=" text-align:center;  padding-top:15px ;"><a target="_blank"><img src="{{ asset('assets/img/logo.png') }}" style="width:300px;"></a></td></tr>


                        <tr>
                          <td style="padding:15px; ">
                          
                          <table border="0" style="background:#fff; padding:20px; width:100%">
                      <tr>
                        <td >Applicant <strong>'. {{ $name ?? "" }} . ',  

                      </td>
                      </tr>

                      <tr>

                      <table border="0" cellpadding="5" cellspacing="1" style=" padding:0px 20px 20px 20px; width:100%; background:#fff; ">

                      <tr>

                      <td width="25%">Full Name</td>
                      <td width="75%">'. {{ $name ?? "" }} .'</td>
                      </tr>
                      <tr>

                      <td>Address</td>
                      <td>'. {{ $address ?? "" }} .'</td>
                      </tr>
                      <tr>
                      <tr>

                      <td>Mobile</td>
                      <td>'. {{ $phone ?? "" }} .'</td>
                      </tr>
                      <tr>

                      <td>Email Address</td>
                      <td>'. {{ $email ?? "" }} .'</td>
                      </tr>
                      
                      <tr>

                      
                      </tr>
                      
                      <tr>

                      <td>Job Position</td>
                      <td>'. {{ $job_position ?? "" }} .'</td>
                      </tr>
                      <td ></td>

                      </table>
                      </tr>
                        <tr>
                        
                        </tr>
                      </table> <!--content table end-->

                          </td>
                        </tr>
                      </table>

                      </body>
                      </html>