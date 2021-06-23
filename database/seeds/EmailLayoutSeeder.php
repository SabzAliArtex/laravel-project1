<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailLayoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_layouts')->insert([
            'email_layout' => '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Email Verification</title>
                </head>
                <body>
                    <table>
                 <tr><td>
                    <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
                </td>
                 </tr>
                    
                </table>
                    <p>Trial Activated Successfully<br /><br />
                    User Information is below:<br />
                    <br /><br /><br />
                    Activate given below License code on Your device <br>
                    <br><br><br>
                    
                 
                    First Name: [FIRST_NAME]<br />
                   Last Name: [LAST_NAME] <br />
                   Email: [EMAIL] <br />
                   Phone: [PHONE] <br />
                   Address: [ADDRESS] <br/>
                   City: [CITY] <br />
                   State: [STATE] <br />
                   Country: [COUNTRY] <br />
                   Company: [PHONE] <br />
                   License:  [LICENSE] <br />
                    </p>
                     <p>
                        
                        <a href="[URL]"> Verify </a>
                    </p>
                </body>
                </html>',
            'name'=>'license_trial',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('email_layouts')->insert([
            'email_layout' => '<!DOCTYPE html>
              <html lang="en">
              <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title>Email Verification</title>
              </head>
              <body>
                  <table>
               <tr><td>
                  <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
                  </td>
               </tr>
                  
              </table>
                  <p>License Created Successfully<br /><br />
                  User Information is below:<br />
                  <br /><br /><br />
                  Activate given below License code on Your device <br>
                  <br><br><br>
                  
               
                  First Name: [FIRST_NAME]<br />
                 Last Name: [LAST_NAME] <br />
                 Email: [EMAIL] <br />
                 Phone: [PHONE] <br />
                 Address: [ADDRESS] <br/>
                 City: [CITY] <br />
                 State: [STATE] <br />
                 Country: [COUNTRY] <br />
                 Company: [PHONE] <br />
                 License:  [LICENSE] <br />
                  </p>
                   <p>
                      
                      <a href="[URL]"> Verify </a>
                  </p>
              </body>
              </html>',
            'name'=>'create_new_user',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('email_layouts')->insert([
            'email_layout' => '<!DOCTYPE html>
              <html lang="en">
              <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title>Email Verification</title>
              </head>
              <body>
                  <table>
               <tr><td>
                  <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
                  </td>
               </tr>
                  
              </table>
                  <p>License Created Successfully<br /><br />
                  User Information is below:<br />
                  <br /><br /><br />
                  Activate given below License code on Your device <br>
                  <br><br><br>
                  
               
                  First Name: [FIRST_NAME]<br />
                 Last Name: [LAST_NAME] <br />
                 Email: [EMAIL] <br />
                 Phone: [PHONE] <br />
                 Address: [ADDRESS] <br/>
                 City: [CITY] <br />
                 State: [STATE] <br />
                 Country: [COUNTRY] <br />
                 Company: [PHONE] <br />
                 License:  [LICENSE] <br />
                  </p>
                   <p>
                      
                      <a href="[URL]"> Verify </a>
                  </p>
              </body>
              </html>',
            'name'=>'create_new_user',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('email_layouts')->insert([
            'email_layout' => '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Email Verification</title>
            </head>
            <body>
                <table>
             <tr><td>
                <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left"></td>
             </tr>
                
            </table>
                <p>Your License has Expired<br /><br />
                User Information is below:<br />
                <br /><br /><br />
                Activate given below License code on Your device <br>
                <br><br><br>
                
             
                First Name: [FIRST_NAME]<br />
               Last Name: [LAST_NAME] <br />
               Email: [EMAIL] <br />
               Phone: [PHONE] <br />
               Address: [ADDRESS] <br/>
               City: [CITY] <br />
               State: [STATE] <br />
               Country: [COUNTRY] <br />
               Company: [PHONE] <br />
               License:  [LICENSE] <br />
                </p>
                 <p>
                    
                    <a href="[URL]"> Verify </a>
                </p>
            </body>
            </html>',
            'name'=>'license_expired',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('email_layouts')->insert([
            'email_layout' => '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Email Verification</title>
            </head>
            <body>
                <table>
             <tr><td>
                <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
                </td>
             </tr>
                
            </table>
                <p>License Purchased Successfully<br /><br />
                User Information is below:<br />
                <br /><br /><br />
                Activate given below License code on Your device <br>
                <br><br><br>
                
             
                First Name: [FIRST_NAME]<br />
               Last Name: [LAST_NAME] <br />
               Email: [EMAIL] <br />
               Phone: [PHONE] <br />
               Address: [ADDRESS] <br/>
               City: [CITY] <br />
               State: [STATE] <br />
               Country: [COUNTRY] <br />
               Company: [PHONE] <br />
               License:  [LICENSE] <br />
                </p>
                 <p>
                    
                    <a href=" [URL] "> Verify </a>
                </p>
            </body>
            </html>',
            'name'=>'license_purchased',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('email_layouts')->insert([
            'email_layout' => '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Email Verification</title>
            </head>
            <body>
                <table>
             <tr><td>
                <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
                </td>
             </tr>
                
            </table>
                <p>License has been renewed Successfully<br /><br />
                User Information is below:<br />
                <br /><br /><br />
                Activate given below License code on Your device <br>
                <br><br><br>
                
             
                First Name: [FIRST_NAME]<br />
               Last Name: [LAST_NAME] <br />
               Email: [EMAIL] <br />
               Phone: [PHONE] <br />
               Address: [ADDRESS] <br/>
               City: [CITY] <br />
               State: [STATE] <br />
               Country: [COUNTRY] <br />
               Company: [PHONE] <br />
               License:  [LICENSE] <br />
                </p>
                 <p>
                    
                    <a href="[URL]"> Verify </a>
                </p>
            </body>
            </html>',
            'name'=>'license_renewal',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('email_layouts')->insert([
            'email_layout' => '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Email Verification</title>
            </head>
            <body>
                <table>
             <tr><td>
                <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
                </td>
             </tr>
                
            </table>
                <p>License has been renewed Successfully<br /><br />
                User Information is below:<br />
                <br /><br /><br />
                Activate given below License code on Your device <br>
                <br><br><br>
                
             
                First Name: [FIRST_NAME]<br />
               Last Name: [LAST_NAME] <br />
               Email: [EMAIL] <br />
               Phone: [PHONE] <br />
               Address: [ADDRESS] <br/>
               City: [CITY] <br />
               State: [STATE] <br />
               Country: [COUNTRY] <br />
               Company: [PHONE] <br />
               License:  [LICENSE] <br />
                </p>
                 <p>
                    
                    <a href="[URL]"> Verify </a>
                </p>
            </body>
            </html>',
            'name'=>'license_renewal',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('email_layouts')->insert([
            'email_layout' => '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Email Verification</title>
            </head>
            <body>
                <table>
             <tr><td>
                <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
            </td>
             </tr>
                
            </table>
                <p>A New User was added<br /><br />
                User Information is below:<br />
                <br /><br /><br />
                Activate given below License code on Your device <br>
                <br><br><br>
                
             
                First Name: [FIRST_NAME]<br />
               Last Name: [LAST_NAME] <br />
               Email: [EMAIL] <br />
               Phone: [PHONE] <br />
               Address: [ADDRESS] <br/>
               City: [CITY] <br />
               State: [STATE] <br />
               Country: [COUNTRY] <br />
               Company: [PHONE] <br />
               License:  [LICENSE] <br />
                </p>
                 <p>
                    
                    <a href="[URL]"> Verify </a>
                </p>
            </body>
            </html>',
            'name'=>'new_user_added',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('email_layouts')->insert([
            'email_layout' => '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Email Verification</title>
            </head>
            <body>
                <table>
             <tr><td>
                <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
                </td>
             </tr>
                
            </table>
                <p>Trial Activated Successfully<br /><br />
                User Information is below:<br />
                <br /><br /><br />
                Activate given below License code on Your device <br>
                <br><br><br>
                
             
                First Name: [FIRST_NAME]<br />
               Last Name: [LAST_NAME] <br />
               Email: [EMAIL] <br />
               Phone: [PHONE] <br />
               Address: [ADDRESS] <br/>
               City: [CITY] <br />
               State: [STATE] <br />
               Country: [COUNTRY] <br />
               Company: [PHONE] <br />
               License:  [LICENSE] <br />
                </p>
                 <p>
                    
                    <a href=" [URL] " id="verify"> Verify </a>
                </p>
            </body>
            </html>',
            'name'=>'trial_activated',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('email_layouts')->insert([
            'email_layout' => '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>License Activation</title>
            </head>
            <body>
                <table>
             <tr><td>
                <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
                </td>
             </tr>
                
            </table>
                <p>License Activated Successfully<br /><br />
                User Information is below:<br />
                <br /><br /><br />
                
             
                First Name: [FIRST_NAME]<br />
               Last Name: [LAST_NAME] <br />
               Email: [EMAIL] <br />
               Phone: [PHONE] <br />
               Address: [ADDRESS] <br/>
               City: [CITY] <br />
               State: [STATE] <br />
               Country: [COUNTRY] <br />
               Company: [PHONE] <br />
               License:  [LICENSE] <br />
            </body>
            </html>',
            'name'=>'license_activated',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('email_layouts')->insert([
            'email_layout' => '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Email Verification</title>
            </head>
            <body>
                <table>
             <tr><td>
                <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left"></td>
             </tr>
                
            </table>
                <p>A New User was Added<br /><br />
                User Information is below:<br />
                <br /><br /><br />
                Activate given below License code on Your device <br>
                <br><br><br>
                
             
                First Name: [FIRST_NAME]<br />
               Last Name: [LAST_NAME] <br />
               Email: [EMAIL] <br />
               Phone: [PHONE] <br />
               Address: [ADDRESS] <br/>
               City: [CITY] <br />
               State: [STATE] <br />
               Country: [COUNTRY] <br />
               Company: [PHONE] <br />
               License:  [LICENSE] <br />
                </p>
                 <p>
                    
                    <a href="[URL]"> Verify </a>
                </p>
            </body>
            </html>',
            'name'=>'user_created_from_app',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('email_layouts')->insert([
            'email_layout' => '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Email Verification</title>
            </head>
            <body>
                <table>
             <tr><td>
                <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
            </td>
             </tr>
                
            </table>
                <p>Subscription Expired<br /><br />
                User Information is below:<br />
                <br /><br /><br />
                You License Subscription has been expired <br>
                <br><br><br>
                
             
                First Name: [FIRST_NAME]<br />
               Last Name: [LAST_NAME] <br />
               Email: [EMAIL] <br />
               Phone: [PHONE] <br />
               Address: [ADDRESS] <br/>
               City: [CITY] <br />
               State: [STATE] <br />
               Country: [COUNTRY] <br />
               Company: [PHONE] <br />
               License:  [LICENSE] <br />
                </p>
                 <p>
                    <a href="[URL]"> Verify </a>
                </p>
            </body>
            </html>',
            'name'=>'subscription_alert',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
    
}
