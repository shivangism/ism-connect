<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisation;
use App\Models\Company;
use App\Models\User;
use App\Models\Feed;
use App\Models\School;
use App\Models\Connection;
use Carbon\Carbon;

class SearchController extends Controller
{
   

    function search_all(Request $q,Request $req){
        
        $req = base64_decode($q['q']);
        $req = json_decode($req);
        $user_id = $req->input('user_id');

        if($req->type == "all"){   
        $users = User::where('name','like','%'.$req->key.'%')->get();
        $companies = Company::where('name','like','%'.$req->key.'%')->get();
        $feeds = Feed::where('feed_heading','like','%'.$req->key.'%')->get();
        $school = School::where('school_name','like','%'.$req->key.'%')->get();
        return ["people"=>$users,"companies"=>$companies,"posts"=>$feeds,'schools'=>$school];
        }

        else if($req->type == "people"){
            $users = User::where('name','like','%'.$req->key.'%')->get();
            $companies = $req->sub_filters->companies;
            $batch = $req->sub_filters->batches;
            $connection = $req->sub_filters->connection;
            $final1=array();
            $final2=array();
            $final3=array();
            
            if(sizeof($companies)!=0){
                foreach($users as $user){
                    $company_id = User::find($user->id)->work_experience[0]->organisation_id;
                    global $company_name;
                    $cpy = "";
                    if(Company::find($company_id)){
                        $cpy = (Company::find($company_id))['name'];
                    }
                    if(in_array($cpy,$companies)){
                    
                        $user->company = $cpy;
                        array_push($final1,$user);
                        
                    }
                }
            }
            else{
                $final1 = $users;
            }
            

            if(sizeof($batch)!=0){
                foreach($final1 as $user){
                    $school_detail = User::find($user->id)->education_log;
                    if(sizeof($school_detail)!=0){
                        $school_id = $school_detail[0]->school_id;
                        $user_date = new Carbon($school_detail[0]->from_date);
                        $user_batch = $user_date->year;
                        if (in_array("$user_batch",$batch)){
                            $user->batch = $user_batch;
                            array_push($final2,$user);
                        }
                    }  
            }
         }
         else{
             $final2 = $final1;
         }

         if($connection=="1"){
            foreach($final2 as $user){
                $is = sizeof(Connection::where('user_1_id',$user['id'])->where('user_2_id',$user_id)->get());
                $is2 = sizeof(Connection::where('user_1_id',$user_id)->where('user_2_id',$user['id'])->get());
                if($is+$is2){
                    array_push($final3,$user);
                }
            }
         }
         else{
             $final3 = $final2;
         }


        return $final3;
        }



        else if($req->type == "posts"){
            $posts = Feed::where('feed_heading','like','%'.$req->key.'%')->get();
            $date_posted = $req->sub_filters->date_posted;
            $posted_by = $req->sub_filters->posted_by;
            $final1 = array();
            $final2 = array();
            
            if($date_posted == "last_day"){           
            foreach($posts as $post){ 
                        $allowed_date = date('Y-m-d H:i:s',strtotime('-24 hours'));
                        if($allowed_date < $post["created_at"]){
                            array_push($final1,$post);
                        }
                }
            }
          
            else if($date_posted == "last_week"){
                foreach($posts as $post){
                            $allowed_date = date('Y-m-d H:i:s',strtotime('-7 days'));            
                            if($allowed_date < $post["created_at"]){
                                array_push($final1,$post);
                            }       
                    }
            }

            else if($date_posted == "last_month"){
                foreach($posts as $post){
                            $allowed_date = date('Y-m-d H:i:s',strtotime('-30 days'));
                            if($allowed_date < $post["created_at"]){
                                array_push($final1,$post);
                            }                       
                    }
            }
            else{
                $final1=$posts;
            }

            if($posted_by=="me"){
                foreach($final1 as $post){
                    if($post["user_id"]=="2"){
                        array_push($final2,$post);
                    }
                }
            }
            else if($posted_by=="1st_connection"){
                foreach($final1 as $post){
                    $is = sizeof(Connection::where('user_1_id',$post['user_id'])->where('user_2_id',$user_id)->get());
                    $is2 = sizeof(Connection::where('user_1_id',$user_id)->where('user_2_id',$post['user_id'])->get());
                    if($is+$is2){
                        array_push($final2,$post);
                    }
                }
            }
            else{
                $final2=$final1;
            }
            return $final2;
        }



        else if($req->type == "schools"){
            $school = School::where('school_name','like','%'.$req->key.'%')->get();
            return ['schools'=>$school];
        }
        
        else if($req->type == "companies"){
            $companies = Company::where('name','like','%'.$req->key.'%')->get();
            return ["companies"=>$companies];
        }


}

}