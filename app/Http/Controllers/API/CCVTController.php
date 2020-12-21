<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User;
use App\CCVTPassport; 
use Illuminate\Support\Facades\Auth; 
use Validator;
class CCVTController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 

        Auth::attempt(['email' => request('email'), 'password' => request('password')]); 
            $user = Auth::CCVTPassport(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        
    
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 

     
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        
           try {
                $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = CCVTPassport::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
return response()->json(['success'=>$success], $this-> successStatus); 
      
            } catch (\Exception $e) {
                return response()->json(['error'=>$e],); 
                
            } 

    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        try {
             $user = Auth::CCVTPassport(); 
        return response()->json(['success' => $user], $this-> successStatus); 
        } catch (\Exception $e) {
            return response()->json(['error' => $e]); 
        }
        
    } 
}