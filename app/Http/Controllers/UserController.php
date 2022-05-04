<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function karmaPosition($id){
        $total=5;
        $karma_positions=array();
        $results=array();
        $pos=User::where('id','=',$id)->with('image')->get();
        if(count($pos)>0){
            $low_karma=User::where('karma_score','<',$pos[0]->karma_score)->where('id','<>',$id)->with('image')->orderby('karma_score','desc')->limit(round(($total-1)/2))->get();
            $high_karma=User::where('karma_score','>',$pos[0]->karma_score)->where('id','<>',$id)->with('image')->orderby('karma_score','asc')->limit($total-count($low_karma)-1)->get();
    
            $in_value=array();
            for($i=0;$i<count($low_karma);$i++){
                array_push($in_value,$low_karma[$i]->id);
            }
            array_push($in_value,$pos[0]->id);
            for($i=0;$i<count($high_karma);$i++){
                array_push($in_value,$high_karma[$i]->id);
            }
            $karma_positions=User::with('image')->orderby('karma_score','desc')->orderby('id','asc')->get();
            for($i=0;$i<count($karma_positions);$i++){
                if(in_array($karma_positions[$i]->id,$in_value)){
                    array_push($results,[
                        'id'=>$karma_positions[$i]->id,
                        'position'=>$i+1,
                        'karma_score'=>$karma_positions[$i]->karma_score,
                        'image_url'=>$karma_positions[$i]->image->url]
                );
                }
            }
            return response()->json([
                'count'=>count($results),
                'data'=>$results,
                'success'=>true,
                'message'=>'List of 5 users',
                'low'=>count($low_karma),
                'high'=>count($high_karma),
                'h'=>$high_karma,
                'l'=>$low_karma
            ]);
        }
        return response()->json([
            'count'=>count($karma_positions),
            'data'=>$karma_positions,
            'success'=>false,
            'message'=>'User with ID '.$id.' not found in DB'
        ]);
        
    }

    public function karmaPositionBonus($id,$total=5){
        $karma_positions=array();
        $results=array();
        $pos=User::where('id','=',$id)->with('image')->get();
        if(count($pos)>0){
            $low_karma=User::where('karma_score','<',$pos[0]->karma_score)->where('id','<>',$id)->with('image')->orderby('karma_score','desc')->limit(round(($total-1)/2))->get();
            $high_karma=User::where('karma_score','>',$pos[0]->karma_score)->where('id','<>',$id)->with('image')->orderby('karma_score','asc')->limit($total-count($low_karma)-1)->get();
    
            $in_value=array();
            for($i=0;$i<count($low_karma);$i++){
                array_push($in_value,$low_karma[$i]->id);
            }
            array_push($in_value,$pos[0]->id);
            for($i=0;$i<count($high_karma);$i++){
                array_push($in_value,$high_karma[$i]->id);
            }
            $karma_positions=User::with('image')->orderby('karma_score','desc')->orderby('id','asc')->get();
            for($i=0;$i<count($karma_positions);$i++){
                if(in_array($karma_positions[$i]->id,$in_value)){
                    array_push($results,[
                        'id'=>$karma_positions[$i]->id,
                        'position'=>$i+1,
                        'karma_score'=>$karma_positions[$i]->karma_score,
                        'image_url'=>$karma_positions[$i]->image->url]
                );
                }
            }
            return response()->json([
                'count'=>count($results),
                'data'=>$results,
                'success'=>true,
                'message'=>'List of '.$total.' users'/* ,
                'low'=>count($low_karma),
                'high'=>count($high_karma),
                'h'=>$high_karma,
                'l'=>$low_karma */
            ]);
        }
        return response()->json([
            'count'=>count($karma_positions),
            'data'=>$karma_positions,
            'success'=>false,
            'message'=>'User with ID '.$id.' not found in DB'
        ]);
    }
}
