<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AjaxCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ajax-comment-crud');
    }
    
    public function fetchComments()
    {
        $comments = Comment::all();
        return response()->json([
            'comments'=>$comments,
        ]);
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment_id'=> 'required',
            'comment_name'=>'required',
            'forename'=>'required',
            'surname'=>'required',
            'email'=>'required',
            'validated'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $comment = new Comment;
            $comment->comment_id = $request->input('comment_id');
            $comment->comment_name = $request->input('comment_name');
            $comment->forename = $request->input('forename');
            $comment->surname = $request->input('surname');
            $comment->email = $request->input('email');
            $comment->validated = $request->input('validated');
            
            $comment->save();
            return response()->json([
                'status'=>200,
                'message'=>'Comment Added Successfully.'
            ]);
        }
    }
      
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $comment = Comment::find($id);
        if($comment)
        {
            return response()->json([
                'status'=>200,
                'comment'=> $comment,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Comment Found.'
            ]);
        }
    }

    /**
     * Update an existing resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'comment_id'=> 'required',
            'comment_name'=>'required',
            'forename'=>'required',
            'surname'=>'required',
            'email'=>'required',
            'validated'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $comment = Comment::find($id);
            if($comment)
            {
                $comment->comment_id = $request->input('comment_id');
                $comment->comment_name = $request->input('comment_name');
                $comment->forename = $request->input('forename');
                $comment->surname= $request->input('surname');
                $comment->email= $request->input('email');
                $comment->validated= $request->input('validated');
                $comment->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Comment with id:'.$id. ' Updated Successfully.'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'No Comment Found.'
                ]);
            }

        }
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if($comment)
        {
            $comment->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Comment Deleted Successfully.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Comment Found.'
            ]);
        }
    }
}