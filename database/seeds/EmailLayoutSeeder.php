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
        //
        DB::table('email_layouts')->insert([
            [
                'email_layout'=>'
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Email Verification</title>
                </head>
                <body>
                    <table>
                 <tr><td><a href="https://trk.klclick.com/ls/click?upn=4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D" style="max-width:100%;word-wrap:break-word" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://trk.klclick.com/ls/click?upn%3D4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D&amp;source=gmail&amp;ust=1615527471022000&amp;usg=AFQjCNF6y2D7mNmODNkvX0iTdDZYNBsdJA" align="left">
                    <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
                </a></td>
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
                </html>
                ',
                'name'=>'license_trial',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
        ],
        [
            'email_layout'=>'
            
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <table>
 <tr><td><a href="https://trk.klclick.com/ls/click?upn=4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D" style="max-width:100%;word-wrap:break-word" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://trk.klclick.com/ls/click?upn%3D4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D&amp;source=gmail&amp;ust=1615527471022000&amp;usg=AFQjCNF6y2D7mNmODNkvX0iTdDZYNBsdJA" align="left">
    <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
</a></td>
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
</html>

            ',
            'name'=>'create_new_user',
            'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
        ],[
            'email_layout'=>'
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Email Verification</title>
            </head>
            <body>
                <table>
             <tr><td><a href="https://trk.klclick.com/ls/click?upn=4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D" style="max-width:100%;word-wrap:break-word" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://trk.klclick.com/ls/click?upn%3D4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D&amp;source=gmail&amp;ust=1615527471022000&amp;usg=AFQjCNF6y2D7mNmODNkvX0iTdDZYNBsdJA" align="left">
                <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
            </a></td>
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
            </html>
            ',
            'name'=>'license_expired',
            'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
        ],[
            'email_layout' =>'
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Email Verification</title>
            </head>
            <body>
                <table>
             <tr><td><a href="https://trk.klclick.com/ls/click?upn=4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D" style="max-width:100%;word-wrap:break-word" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://trk.klclick.com/ls/click?upn%3D4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D&amp;source=gmail&amp;ust=1615527471022000&amp;usg=AFQjCNF6y2D7mNmODNkvX0iTdDZYNBsdJA" align="left">
                <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
            </a></td>
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
            </html>
            ',
            'name'=> 'license_purchased',
            'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
        ],[
            'email_layout' =>'
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Email Verification</title>
            </head>
            <body>
                <table>
             <tr><td><a href="https://trk.klclick.com/ls/click?upn=4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D" style="max-width:100%;word-wrap:break-word" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://trk.klclick.com/ls/click?upn%3D4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D&amp;source=gmail&amp;ust=1615527471022000&amp;usg=AFQjCNF6y2D7mNmODNkvX0iTdDZYNBsdJA" align="left">
                <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
            </a></td>
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
            </html>
            ',
            'name'=>'license_renewal',
            'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
        ],[
            'email_layout' =>'
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Email Verification</title>
            </head>
            <body>
                <table>
             <tr><td><a href="https://trk.klclick.com/ls/click?upn=4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D" style="max-width:100%;word-wrap:break-word" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://trk.klclick.com/ls/click?upn%3D4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D&amp;source=gmail&amp;ust=1615527471022000&amp;usg=AFQjCNF6y2D7mNmODNkvX0iTdDZYNBsdJA" align="left">
                <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
            </a></td>
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
            </html>
            ',
            'name'=>'new_user_added',
            'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
        ],[

            'email_layout'=>'
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Email Verification</title>
            </head>
            <body>
                <table>
             <tr><td><a href="https://trk.klclick.com/ls/click?upn=4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D" style="max-width:100%;word-wrap:break-word" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://trk.klclick.com/ls/click?upn%3D4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D&amp;source=gmail&amp;ust=1615527471022000&amp;usg=AFQjCNF6y2D7mNmODNkvX0iTdDZYNBsdJA" align="left">
                <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
            </a></td>
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
            </html>
            ',
            'name'=>'trial_activated',
            'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
        ],[
            'email_layout' =>'
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Email Verification</title>
            </head>
            <body>
                <table>
             <tr><td><a href="https://trk.klclick.com/ls/click?upn=4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D" style="max-width:100%;word-wrap:break-word" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://trk.klclick.com/ls/click?upn%3D4YSMqmvc67C9CMBc1YvS1WBLbnd8AqYXfO3lXkj-2FqYnQc6fEDWTv24r0YaNpx6-2FfWfjgXcWjZJfBkF2QikjA7DWxRkP4FxrVYJDnI8Pfu3IHaOsgz92veiDtkDmIz52wBpTedjIgv-2F3YOQOi20ovnLnAdr3JeyoXzN8AN9s1XiD2B2zEKLOjqlei5iQEC-2BWWROkh_bta0-2Bx57NmQKAPzaYguakD4nbPgzE2t-2BfNGS6H2FeDPSOFqkKDnNjd1P9VGG4Yrev0xiZpIKmdcanhEQMnlPISBbYI-2BGywEoNBQF3y-2BrPoLla231YbWLHj5ATHRWm9yvNd8u6R5mwFihSc2XpcsvqFQ6EiWO3cJaelAPTL1jShU4oSt1VAYczS-2FTWZW7rbbdx3InyhYacrWLJaT9I0bJxRoy1DjRv5xk5QzR5A3dq62YtoYIR1YrYw5yLnwXKL8sWfXT1oqmVx3CalujgtLWCjWz3ykBj1jHWefwArt4Cn0Ww8-2FQhW0brES-2Fcrjfds1NzcHChk-2F0809t0tN-2B1eB1C9apIqMtMUZU2HYrAnmFYoBv4dd2uZQLYeVE7kzHLkjUa-2FMIgTNFq3dpCnkfX73-2Bsg-3D-3D&amp;source=gmail&amp;ust=1615527471022000&amp;usg=AFQjCNF6y2D7mNmODNkvX0iTdDZYNBsdJA" align="left">
                <img alt="" class="m_8109138844662692330kmImage CToWUd" src="https://ci6.googleusercontent.com/proxy/Jg_hezNibtI6-dbA3FUg99ARvUIISqrEabkykyVzCaXYFgkDEGnz8yVtXZrCxuZPDUG5R-ucPG8ZErg8veo0qczHRMrJwwKI94VuWOEjXWKxzv_GGj2zxGf1j3570olQ-MbJZ_umMP6xXPAJy0Eww09uUNyn7HUN=s0-d-e1-ft#https://d3k81ch9hvuctc.cloudfront.net/company/PxmUQt/images/b52e98eb-dbe2-4bfc-9b6d-663f7dd70406.jpeg" style="border:0;height:auto;line-height:100%;max-width:1200px;outline:none;text-decoration:none;font-size:12px;padding-bottom:0;vertical-align:top;width:100%;display:inline;padding:0;background-color:#eee" width="600" align="left">
            </a></td>
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
            </html>
            ',
            'name'=>'user_created_from_app',
            'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
        ]]
            
        );
    }
}
