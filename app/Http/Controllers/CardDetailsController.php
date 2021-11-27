<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use  App\Models\CardDetailsModel;
use DateTime;
use DB;
use Validator;

class CardDetailsController extends Controller
{
    public function index()
    {
        $FetchRecord=DB::select('SELECT CardId,PersonName,EmailID,ShortDescription,Contacts,SingleAddress,CreatedDate FROM CardManagement.card_details');
        return view('card-details')->with('FetchRecord',$FetchRecord);
    }
 
    //function to store valu in table
   public function store(Request $request)
   {

            $rules=[
               
                'PersonName'=>'required|regex:/^[a-zA-Z ]+$/u',
                'ShortDescription'=>'required|regex:/^[a-zA-Z ]+$/u',
                'Contacts'=>'required|max:10|regex:/^[0-9 ]+$/u',
                'SingleAddress'=>'required'
        ];
        $validator=Validator::make($request->all() ,$rules);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors(),'statusCode'=>'400']);
        }
        else
        {
            $CardDetails=new CardDetailsModel();
            $CardDetails->PersonName=$request->PersonName;
            $CardDetails->EmailID=$request->EmailId;
            $CardDetails->ShortDescription=$request->ShortDescription;
            $CardDetails->Contacts=$request->Contacts;
            $CardDetails->SingleAddress=$request->SingleAddress;
            $CardDetails->CreatedDate=new DateTime();
            $CardDetails->LastUpdatedDate=new DateTime();
            
            if($CardDetails->save())
            {
                return redirect()->back() ->with('alert', 'Value Inserted Successfully..!');
            }
            else
            {
                return redirect()->back() ->with('alert', 'Value Not Inserted..!');
                
            }

        }
       
   }

   //function to update value in table
   public function update(Request $request, $CardId)
    {
    	$CardUpdate=CardDetailsModel::find($CardId);
     
        $CardUpdate->PersonName=$request->pname;
        $CardUpdate->EmailID=$request->pemail;
        $CardUpdate->ShortDescription=$request->pdescription;
        $CardUpdate->Contacts=$request->pcontacts;
        $CardUpdate->SingleAddress=$request->paddress;
        $CardUpdate->LastUpdatedDate=new DateTime();

        if($CardUpdate->save()){
            return redirect('card-details') ->with('alert', 'Data Update Successfully..!');;
        }else{

            echo "Data not updated";
        }
    }

    //function to destroy value in table
    public function destroy($CardId)
    {
        $DelCard = DB::table('card_details')->where('CardId', $CardId)->delete();
		if($DelCard){
			return redirect()->back() ->with('alert', 'Record Deleted Successfully..!','card-details');
		}else{
			return redirect()->back() ->with('alert', 'Record Not Deleted..!','card-details');
		}
    }
}
