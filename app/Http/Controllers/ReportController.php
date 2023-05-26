<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\report;
use Illuminate\Http\Request;
use App\Mail\ReportDepartment;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Notifications\formSubmit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ReportController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = DB::table('departments')->get();
        $types = DB::table('types')->get();
        return view('reports.add',compact('departments','types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->blood =0; 
        if($request->blood == "on"){
            $request->blood =1; 
        }
        request()->validate([
            'MRN' => ['required', 'max:50'],
            'MRP' => ['required', 'max:50'],

            'department' => ['required'],
            'age'     => ['required', 'numeric'],
            'sex' => ['required'],
            'type'    => ['required'],
            'admissionDate'    => ['required','date'],
            'dischargeDate'=>['required','date'],
            'note'=>['nullable']
        ]);
        
        $createdReport=report::create([

            'mrn'  => $request->MRN,
            'department_id' => $request->department,
            'mrp'  => $request->MRP,
            'note'  => $request->note,
            'age' => $request->age,
            'type'    => $request->type,
            'blood'    => $request->blood,
            'status'     => ($request->stage == "CDI")?"complete":"not completed",
            'stage'     => $request->stage,
            'user_created_id'=> Auth()->id(),
            'sex'=>$request->sex,
            'dateofadmission'=>$request->admissionDate,
            'dateofdischarge'=>$request->dischargeDate
        ]);

        $users = User::where("id","!=",auth()->user()->id)->where("department_id",$request->department)->get();

       Notification::send($users,new formSubmit($createdReport->mrn,$createdReport->note));


        return back()->with('success','New user added successfully');
 
    }
    public function irrTableDoc(Request $request){
        $irr_data = DB::table('reports')
        ->where('stage','=','IRR')
        ->where('department_id',auth()->user()->department_id)
        ->whereNull('status')
        ->orWhere('status','not completed');
        if(! empty($request->search)){
            $irr_data = $irr_data ->where('mrn',$request->search);

        }
        $irr_data=$irr_data->paginate(15);
        foreach($irr_data as $key=>$irr){
             $irr_data[$key]->department = DB::table('departments')->where('id',$irr->department_id)->first()->name;
             $irr_data[$key]->userName = DB::table("users")->where('id',$irr->user_created_id)->first()->name;

             if(! empty($irr->user_updated_id)){
                $irr_data[$key]->userName = DB::table("users")->where('id',$irr->user_updated_id )->first()->name;
            }
        }
        return view('tables.irrDoc',compact('irr_data'));

    }
    public function irrTable(Request $request){
        $irr_data = DB::table('reports')->where('stage','IRR');
        if(! empty($request->search)){
            $irr_data = $irr_data->where('mrn',$request->search);

        }
        $irr_data=$irr_data->paginate(15);
        foreach($irr_data as $key=>$irr){
             $irr_data[$key]->department = DB::table('departments')->where('id',$irr->department_id)->first()->name;
             $irr_data[$key]->userName = DB::table("users")->where('id',$irr->user_created_id)->first()->name;

             if(! empty($irr->user_updated_id)){
                $irr_data[$key]->userName = DB::table("users")->where('id',$irr->user_updated_id )->first()->name;
            }
        }
        return view('tables.irr',compact('irr_data'));
    }
    public function cdiTable(Request $request){

        $irr_data = DB::table('reports')->where('stage','CDI');
        if(! empty($request->search)){
            $irr_data = $irr_data ->where('mrn',$request->search);

        }
        $irr_data=$irr_data->paginate(15);
        $types=DB::table('types')->get();
        foreach($irr_data as $key=>$irr){
             $irr_data[$key]->department = DB::table('departments')->where('id',$irr->department_id)->first()->name;
             $irr_data[$key]->userName = DB::table("users")->where('id',$irr->user_created_id)->first()->name;
             $irr_data[$key]->type_name = DB::table("types")->where('id',$irr->type)->first()->name;
             if(! empty($irr->user_updated_id)){
                $irr_data[$key]->userName = DB::table("users")->where('id',$irr->user_updated_id )->first()->name;
            }
        }
        return view('tables.cdi',compact('irr_data','types'));
    }
    public function codingTable(Request $request){

        $irr_data = DB::table('reports')->where('stage','CODING');
        if(! empty($request->search)){
            $irr_data = $irr_data ->where('mrn',$request->search);

        }
        $irr_data=$irr_data->paginate(15);
   
        $types=DB::table('types')->get();
        foreach($irr_data as $key=>$irr){
             $irr_data[$key]->department = DB::table('departments')->where('id',$irr->department_id)->first()->name;
             $irr_data[$key]->userName = DB::table("users")->where('id',$irr->user_created_id)->first()->name;
             $irr_data[$key]->type_name = DB::table("types")->where('id',$irr->type)->first()->name;
             if(! empty($irr->user_updated_id)){
                $irr_data[$key]->userName = DB::table("users")->where('id',$irr->user_updated_id )->first()->name;
            }
        }
        return view('tables.coding',compact('irr_data','types'));
    }
    public function esrTable(Request $request){
        $irr_data = DB::table('reports')->where('stage','ESR');
        if(! empty($request->search)){
            $irr_data = $irr_data ->where('mrn',$request->search);

        }
        $irr_data=$irr_data->paginate(15);
        foreach($irr_data as $key=>$irr){
             $irr_data[$key]->department = DB::table('departments')->where('id',$irr->department_id)->first()->name;
             $irr_data[$key]->userName = DB::table("users")->where('id',$irr->user_created_id)->first()->name;
             $irr_data[$key]->type_name = DB::table("types")->where('id',$irr->type)->first()->name;
             if(! empty($irr->user_updated_id)){
                $irr_data[$key]->userName = DB::table("users")->where('id',$irr->user_updated_id )->first()->name;
            }
        }
        return view('tables.esr',compact('irr_data'));
    }
    public function general(Request $request){
        $irr_data = DB::table('reports');
        if(! empty($request->search)){
            $irr_data = $irr_data ->where('mrn',$request->search);

        }
        $irr_data=$irr_data->paginate(15);
        foreach($irr_data as $key=>$irr){
             $irr_data[$key]->department = DB::table('departments')->where('id',$irr->department_id)->first()->name;
             $irr_data[$key]->userName = DB::table("users")->where('id',$irr->user_created_id)->first()->name;
             $irr_data[$key]->type_name = DB::table("types")->where('id',$irr->type)->first()->name;
             if(! empty($irr->user_updated_id)){
                $irr_data[$key]->userName = DB::table("users")->where('id',$irr->user_updated_id )->first()->name;
            }
        }
        return view('tables.general',compact('irr_data'));
    }
public function pdf_creator(){

        $usersMail= DB::table('users')->select('email','department_id')->get();
        $department=DB::table('departments')->get();
        $report = DB::table('reports')->select('department_id')->where("status","not completed")->pluck('department_id');
        $report_new = [];
        foreach($report as $n){
           array_push($report_new,$n);
        }
        $emails = [];
        foreach($department as $part){
            $emails[$part->id]=[];
    
            foreach($usersMail as $user){
            if($user->department_id == $part->id && in_array($user->department_id,$report_new)){
            
                array_push($emails[$part->id],$user->email);
            }}
    
        }
    $arrayOfPart =array_keys($emails);
   
    foreach($arrayOfPart as $part){
       
     $file_name = 'file.pdf';
     $html_special = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">';
     $html_special .= $this->fetch_customer_data($part);
     $pdf = App::make('dompdf.wrapper');
     $pdf->loadHTML($html_special);
     $pdf->render();
     $file = $pdf->output();
     file_put_contents( $file_name, $file); 
     foreach($emails[$part] as $email){
     Mail::to($email)->send(new ReportDepartment);
    }
 
    }
     
    
  return back(); 
      
}
    
public function fetch_customer_data($partion)
{
    $result = DB::table('reports')->where('department_id',$partion)->get();
    $departments = DB::table('departments')->get();
 
    $output = '
    <div class="table-responsive">
    <table class="table table-striped table-bordered">
    <tr>
        <th>MRN</th>
        <th>MRP</th>
        <th>Department</th>
        <th>Note</th>
        <th>Date</th>
    </tr>
    ';
        foreach($result as $row)
        {
            foreach($departments as $part){
            
            if($row->department_id == $part->id){
                $row->department =  $part->name;
            }  
            }
            
        $output .= '
        <tr>
            <td>'.$row->mrn.'</td>
            <td>'.$row->mrp.'</td>
            <td>'.$row->department.'</td>
            <td>'.$row->note.'</td>
            <td>'.$row->dateofdischarge.'</td>
        </tr>
        ';
        }
        $output .= '
        </table>
        </div>
        ';
        return $output;
}
public function cdi(Request $request){
        DB::table('reports')->where("id",$request->id)->update(["status"=>"complete","stage"=>"CDI","user_updated_id"=>auth()->user()->id]);
        return back();
}
public function irr(Request $request){
        $id=$request->id ?? session('id');
      
        if(isset($request->note) && (!empty($request->note)))
        {
            DB::table('reports')->where("id",$id)->update(["status"=>"not completed","stage"=>"IRR","user_updated_id"=>auth()->user()->id,"note"=>$request->note]);
        }else{
            DB::table('reports')->where("id",$id)->update(["stage"=>"IRR","user_updated_id"=>auth()->user()->id]);
        }
        return redirect()->route('dashboard');
    }
    public function coding(Request $request){
        DB::table('reports')->where("id",$request->id)->update(["stage"=>"CODING","user_updated_id"=>auth()->user()->id]);
        return back();
    }
    public function notCompleted(Request $request){
        DB::table('reports')->where("id",$request->id)->update(["status"=>"not completed","user_updated_id"=>auth()->user()->id]);
        return back();
}
    public function coding_done($id){
        session(['id' => $id]);
        return view('done');

    }
    public function coding_irr($id){
        session(['id' => $id]);
        return view('irr-note');

    }
    public function diagnosis(Request $request){
        request()->validate([
            'Diagnosis' => ['required'],
            'surgicalProcedure' => ['required']
        ]);
        DB::table('reports')->where("id",session('id'))->update(["stage"=>"ESR","SurgicalProcedure"=>$request->surgicalProcedure,"diagnosis"=>$request->Diagnosis]);

        return redirect()->route("coding-table");
    }
    public function completed(Request $request){
        DB::table('reports')->where("id",$request->id)->update(["status"=>"complete","user_updated_id"=>auth()->user()->id]);
        return back();
    }
    public function updateType(Request $request){
        DB::table('reports')->where("id",$request->report_id)->update(["type"=>$request->type]);
        return back();
    }
}