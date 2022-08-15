<?php
namespace App\Http\Controllers;
use App\QuestionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
class MainController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
public function displayWelcome(){
        if (!is_null(Auth::user()) &&  !Auth::user()->can('displayWelcome')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        $data['allquestion']= DB::table('question_models')
            ->leftjoin('users','users.id','question_models.quserId')
            ->leftjoin('categories','categories.id','question_models.qcategoryname')
            ->select('users.id as uid','categories.id as cmid','users.username','users.photo','question_models.id','question_models.updated_at','question_models.qtitle','categories.categoryname as categoryname','question_models.qcontent','question_models.ufile')
            ->orderBy('question_models.id','ASC')
            ->paginate(3);

            $data['ans_count']=DB::table('answer_models')
            ->leftjoin('question_models','question_models.id','answer_models.qid')
            ->where('question_models.id','answer_models.qid','=')
            ->count('answer_models.id');
//dd($data);

        return view('question.questionlist',$data); 

    }
    public function displayParticularCategory(Request $request){
        
                $data['allquestion']= DB::table('question_models')
                    ->leftjoin('users','users.id','question_models.quserId')
                    ->leftjoin('categories','categories.id','question_models.qcategoryname')
        
                    ->select('users.id as uid','categories.id as cmid','users.username','categories.categoryname','users.photo','question_models.id','question_models.updated_at','question_models.qtitle','question_models.qcategoryname','question_models.qcontent','question_models.ufile')
                    ->where('categories.id',$request->cid,'=')
                    ->orderBy('question_models.id','DESC')
                    ->get();
        
                $data['cat']=  DB::table('categories')
                    ->where('categories.id',$request->cid,'=')
                    ->first();
               
        
                $data['ans_count']=DB::table('answer_models')
                    ->leftjoin('question_models','question_models.id','answer_models.qid')
                    ->where('question_models.id','answer_models.qid','=')
                    ->count('answer_models.id');
        
        //dd($data);
        
                return view('category.particularCategory',$data);
            }

    public function downloadFile($id){
    // $id=decrypt($id);
    //     $file= storage_path()."/".$id;
    $file= storage_path()."/".decrypt($id);
      
           
//        return Response::make(file_get_contents($file), 200, [
//            'Content-Type' => 'application/pdf',
//            'Content-Disposition' => 'inline; filename="'.'dd'.'"'
//        ]);

        // return Response::download($file);
         return response()->file($file,[
            //'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="dd"'
        ]);
    }

    //search
    public function searchWelcome(Request $request)
    {
        //dd($request->search);
        $search = $request->search;
        // $date = $request->input('date');
        // $data=new User();
        if (empty($search))
            $data['allquestion']=null;
            //dd($search);

        if (isset($search) && !empty($search)) {
            $data['allquestion'] = DB::table('question_models')
            ->leftjoin('users','users.id','question_models.quserId')
            ->leftjoin('categories','categories.id','question_models.qcategoryname')
            ->select('*','users.id as uid','categories.id as cmid','users.username','users.photo','question_models.id','question_models.updated_at','question_models.qtitle','categories.categoryname as categoryname','question_models.qcontent','question_models.ufile')
            ->orderBy('question_models.id','ASC')
                ->where('qcategoryname', 'like binary', '%' . $search . '%')
                ->orwhere('users.username', 'like binary', '%' . $search . '%')
                ->orwhere('question_models.updated_at', 'like binary', '%' . $search . '%')
                ->orWhere('qtitle', 'like binary', '%' . $search . '%')
                ->orWhere('qcontent', 'like binary', '%' . $search . '%')
                ->paginate(3);
                
        }

        //dd($data);

         return view('question.questionlist', $data);
        // return redirect()->back()->with(['data'=>$data]);
    }


}
