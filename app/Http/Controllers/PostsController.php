<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Posts;
use App\Categories;
use Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();

        return view('posts.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:60',
            'fileExam' => 'mimes:pdf'
        ]);

        $total = $request['_total'];
        $result = array();
        for($i=1; $i<=$total; $i++) {
            $result[$i] = $request['check-'.$i];
        }

        if($request->hasFile('fileExam')){

            // $path = Storage::putFileAs('uploads', $request->file('fileExam'), $request->title.'.'.$request->fileExam->extension());
            // 
            // $file_exten = $request->file('fileExam')->getClientOriginalExtension();
            
            // $file_name = $request->file('fileExam')->getClientOriginalName();

            $file_name = $this->convert_string($request->title).'.'.$request->file('fileExam')->getClientOriginalExtension();
            // $path = 'files_upload/'.$this->convert_string($file_name);
        
            $request->file('fileExam')->move(public_path('files_upload'), $file_name);
            $path = 'files_upload/'.$file_name;

            $post = new Posts();

            $post->title = $request->title;
            $post->path_file = $path;
            $post->result = json_encode($result);
            $post->time = $request->time;
            $post->total = $total;
            $post->cat_id = $request->category;
            $post->user_id = \Auth::user()->id;

            $post->save();


            return redirect()->route('posts.show', ['id' => $post->id]);

        } else {
            return 'Lỗi';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = Posts::find($id);

        $cat = $post->categories;

        $results = json_decode($post->result, true);

        $userExams = \Auth::user()->id;

        return view('posts.show')->with(['post'=> $post, 'results'=> $results, 'cat' => $cat, 'userExams' => $userExams]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function to_utf8($in)
    {
        if (is_array($in)) {
            foreach ($in as $key => $value) {
                $out[to_utf8($key)] = to_utf8($value);
            }
        } elseif(is_string($in)) {
            if(mb_detect_encoding($in) != "UTF-8")
                return utf8_encode($in);
            else
                return $in;
        } else {
            return $in;
        }
        return $out;
    }

    private function convert_string($str)
    {
        $str = $this->to_utf8($str);
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );

        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }

        $str = strtolower($str);
        $str = str_replace(' ','-',$str);

        return $str;
    }
}
