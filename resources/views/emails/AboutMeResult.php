<html>
   <head>
      <style type="text/css">
         a:focus, a:hover {
             color: #23527c;
             text-decoration: underline;
         }
      </style>
   </head>
   <body>
      <table class="wrapper" style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box ; background-color: #f5f8fa ; margin: 0 ; padding: 0 ; width: 100%" width="100%" cellspacing="0" cellpadding="0">
         <tbody>
            <tr>
               <td style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box" align="center">
                  <table class="content" style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box ; margin: 0 ; padding: 0 ; width: 100%" width="100%" cellspacing="0" cellpadding="0">
                     <tbody>
                        <tr>
                           <td class="header" style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box ; padding: 25px 0 ; text-align: center">
                              <a href="https://www.mailinator.com/key/url?url=http%3A//ifoundyou.com" style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box ; color: #bbbfc3 ; font-size: 19px ; font-weight: bold ; text-decoration: none ; text-shadow: 0 1px 0 white" target="_other" rel="nofollow">
                              <img src="http://ifoundyou.com/public/img/logo.png" style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box ; max-width: 100% ; border: none" width="210">
                              </a>
                           </td>
                        </tr>
                        <tr>
                           <td class="body" style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box ; background-color: #ffffff ; border-bottom: 1px solid #edeff2 ; border-top: 1px solid #edeff2 ; margin: 0 ; padding: 0 ; width: 100%" width="100%">
                              <table class="inner-body" style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box ; background-color: #ffffff ; margin: 0 auto ; padding: 0 ; width: 570px" width="570" cellspacing="0" cellpadding="0" align="center">
                                 <tbody>
                                    <tr>
                                       <td class="content-cell" style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box ; padding: 35px">
                                          <p style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box ; color: #74787e ; font-size: 16px ; line-height: 1.5em ; margin-top: 0 ; text-align: left"><b style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box">Welcome to ifoundyou</b><br><br>
                                             <?php if(count($users) > 0){?>
                                                We found some matching results according to your details.<br><br>
                                                The search results are as follows:- <br>
                                             <?php }else{ ?>
                                                No matching results are found related with your details.<br><br>
                                             <?php } ?> 
                                          </p>
                                          <table class="action" style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box ; margin: 30px auto ; padding: 0 ; width: 100%" width="100%" cellspacing="0" cellpadding="0">
                                             <tbody>
                                                <?php
                                                   if(isset($users) && !empty($users)){
                                                      foreach($users as $user){
                                                ?>
                                                      <tr>
                                                         <td style=" padding-bottom:20px; font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box">
                                                            <h5 style="margin-bottom: 5px;"><a class="view" href="<?php echo $data['url'].'/'.$user->id ?>" style="color:#1a0dab;font-weight: 400;font-size: 18px;text-transform: capitalize; text-decoration: none;" onMouseOver="this.style.text-decoration='underline'" onMouseOut="this.style.text-decoration='none'"> <?php echo $user->name; ?> </a></h5>
                                                            <a href="<?php echo $data['url'].'/'.$user->id; ?>" class="htt" style="color:#006621;font-size: 14px;"> <?php echo $data['user_url'].'/'.$user->name; ?></a>
                                                         </td>
                                                      </tr>
                                                <?php
                                                   }}
                                                ?>
                                             </tbody>
                                          </table>
                                          We hope you enjoy your stay at <a href="https://www.mailinator.com/key/url?url=http%3A//ifoundyou.com" style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box ; color: #3869d4" target="_other" rel="nofollow">ifoundyou</a><br><br>
                                          <b style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box">Warm Regards</b>,<br>
                                          ifoundyou
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box">
                              <table class="footer" style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box ; margin: 0 auto ; padding: 0 ; text-align: center ; width: 570px" width="570" cellspacing="0" cellpadding="0" align="center">
                                 <tbody>
                                    <tr>
                                       <td class="content-cell" style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box ; padding: 35px" align="center">
                                          <pre style="font-family: &quot;avenir&quot; , &quot;helvetica&quot; , sans-serif ; box-sizing: border-box"><code>        © <?php echo date('Y'); ?> ifoundyou. All rights reserved.</code></pre>
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
      <br><br><br><br><br><br><br>
   </body>
</html>

