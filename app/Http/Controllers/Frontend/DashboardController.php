<?php

namespace SundaySim\Http\Controllers\Frontend;

use SundaySim\Models\Opinion;
use SundaySim\Models\OpinionAcceptance;
use Illuminate\Http\Request;
use SundaySim\Http\Requests;
use SundaySim\User;
use SundaySim\Models\Usermeta;
use SundaySim\Models\Tag;
use Auth;

use Illuminate\Support\Facades\Input;


class DashboardController extends Controller
{
    public function index(Opinion $Opinions, User $users)    {
       
        $opinions = array();
        $opinionObj = $Opinions->with('user')->with('category')->with('tag')->with('acceptance')->where('status',1)->orderBy('updated_at', 'desc')->take(5)->get();
        if(is_object($opinionObj)){
            $opinions = $opinionObj->toArray();
        } 
        foreach ($opinions as $key => $opinion) {
            $usermeta=Usermeta::where('user_id','=',$opinion['created_by'])->get()->toArray();      
            foreach($usermeta as $user){
                $opinions[$key]['usermeta'][$user['key']]=$user['value'];          
            }
            
            $total=OpinionAcceptance::where('opinion_id','=',$opinion['acceptance']['opinion_id'])->count();            
            $agree=OpinionAcceptance::where('opinion_id','=',$opinion['acceptance']['opinion_id'])->where('is_agree','=',1)->count();           
            $disagree=OpinionAcceptance::where('opinion_id','=',$opinion['acceptance']['opinion_id'])->where('is_agree','=',2)->count();
            if($agree>0 && $total>0){
                $percentageAgree=$agree/$total*100;
            }else{
             $percentageAgree=0;   
            }
            if($disagree>0 && $total>0){
                $percentageDisagree=$disagree/$total*100;
            }else{
              $percentageDisagree=0;  
            }
            $opinions[$key]['acceptance_calculation'] = array('agree'=>$percentageAgree,'disagree'=>$percentageDisagree,'total'=>$total);            
        }        
        $users = $users->whereNotNull('last_login_at')->orderBy('last_login_at', 'desc')->take(5)->get();
        return view('frontend.dashboard', compact('opinions','users'));
    }
    
    public function tag(){        
        $tag= new Tag();
        $allTags=$tag->getAllTag();
        return json_encode($allTags);exit;
    }    
    
    public function updateOpinionAcceptance() {     
        $oa = OpinionAcceptance::create([
            'opinion_id'=>Input::get('oid'),
            'user_id'=>Input::get('userid'),
            'is_agree'=>Input::get('val')
        ]);        
    }
    
    public function profile(){        
        return view('frontend.profile');
    }
    
    public function profileEdit(){
        $userArray=array();
        $usermeta=Usermeta::where('user_id','=',Auth::User()->id)->get()->toArray();      
        foreach($usermeta as $user){
            $userArray[$user['key']]=$user['value'];          
        }
        $userArray['user_id']=Auth::User()->id;
        $userArray['email']=Auth::User()->email;        
        return view('frontend.useredit',compact('userArray'));
    }
}
